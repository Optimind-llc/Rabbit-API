<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
// Models
use App\Models\Access\User\User;
use App\Models\History\Rabbit;
use App\Models\History\Point;
// Exceptions
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Exception\StoreResourceFailedException;
/**
 * Class BasicController
 * @package App\Http\Controllers
 */
class BasicController extends Controller
{
    /**
     * Get user from JWT token
     */
    public function getUser()
    {
        try {
            $user = JWTAuth::parseToken()->toUser();

            if (!$user) {
                return $this->response->errorNotFound('User Not Found');
            }
        } catch (JWTException $e) {
            return $this->response->error('something went wrong');
        }

        return $user;
    }

    /**
     * Get hold points
     */
    public function points(Request $request)
    {
        $user = $this->getUser();

        return $this->response->array([
            'hold_points' => $user->totalPoints()
        ]);        
    }

    /**
     * Fore in enent
     */
    public function start(Request $request)
    {
        $validator = app('validator')->make(
            $request->all(),
            [
                'time' => ['required', 'digits:10'],
                'lat' => ['numeric'],
                'lon' => ['numeric']
            ]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Validation error', $validator->errors());
        }

        $now = Carbon::now();
        $today = Carbon::today();
        $user = $this->getUser();

        $count_start_events = $user->rabbits()
        	->where('created_at', '>=', $today)
        	->where('rabbit_type_id', 1)
        	->count();

        if($count_start_events === 0) {
	        $validator = app('validator')->make(
	            $request->all(),
	            [
	                'lat' => ['required'],
	                'lon' => ['required']
	            ]
	        );

	        if ($validator->fails()) {
	            throw new StoreResourceFailedException('Require location information', $validator->errors());
	        }

	        $campuses = $user->school->campuses()->get(['geo_lat', 'geo_lon']);

            $is_in_campus = false;

            foreach($campuses as $campus)
            {
                if($campus->inside($request->lat, $request->lon))
                {
                    $is_in_campus = true;
                    break;
                }
            }

            if(!$is_in_campus) {
                return $this->response->errorBadRequest('Not in campuse');
            }
        }

        if ($now->lte($today->copy()->addHours(config('rabbit.start_time')))) {
            return $this->response->errorBadRequest('Still cannot fore in');
        }

        if ($now->gte($today->copy()->addHours(config('rabbit.end_time')))) {
            return $this->response->errorBadRequest('Already cannot fore in');
        }

        $latest_event = $user->rabbits()->orderBy('created_at', 'desc')->first();

        // Check latest event, and throw error if latest is start event.
        if ($latest_event instanceof Rabbit && $latest_event->rabbit_type_id == 1) {
            $latest_event->delete();
            $message = 'Not finished normally';
        }

        $event = new Rabbit;
        $event->rabbit_type_id = 1;
        $event->user_id = $user->id;
        $event->device_interval = null; 
        $event->device_time = Carbon::createFromTimestamp($request->time);
        $event->created_at = $now;
        $event->updated_at = $now;
        $event->save();

        return $this->response->array([
            'message' => isset($message) ? $message : 'Finished normally',
            'rate' => config('rabbit.default_rate')
        ]);
    }

    /**
     * End enent
     */
    public function end(Request $request)
    {
        $validator = app('validator')->make(
            $request->all(),
            [
                'points' => ['required', 'integer'],
                'rate' => ['required', 'integer'],
                'time' => ['required', 'digits:10']
            ]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Validation error', $validator->errors());
        }

        $now = Carbon::now();
        $end_time = Carbon::today()->addHours(config('rabbit.end_time'));

        $user = $this->getUser();

        $latest_event = $user->rabbits()->orderBy('created_at', 'desc')->first();

        // Check latest event, and throw error if event was not found.
        if (!$latest_event instanceof Rabbit) {
            return $this->response->errorBadRequest('No start event');
        }

        // Check latest event, and throw error if latest is end event.
        if ($latest_event->rabbit_type_id == 2) {
            return $this->response->errorBadRequest('No start event');
        }

        $diff = $latest_event->created_at->diffInSeconds($now);

        // Check injustice and cheating.
        if ($request->points*$request->rate - $diff > config('rabbit.allowable_error')) {
            return $this->response->errorBadRequest('Invalid data');
        }

        // Cut off points if it over time.
        $max_points = floor($latest_event->created_at->diffInSeconds($end_time)/$request->rate);
        $corrected_points = $request->points > $max_points ? $max_points : $request->points;

        $foreout_event = new Rabbit;
        $foreout_event->rabbit_type_id = 2;
        $foreout_event->user_id = $user->id;
        $foreout_event->device_interval = $request->interval;
        $foreout_event->device_time = Carbon::createFromTimestamp($request->time);
        $foreout_event->created_at = $now;
        $foreout_event->updated_at = $now;
        $foreout_event->save();

        $point_event = new Point;
        $point_event->point = $corrected_points;
        $point_event->user_id = $user->id;
        $point_event->history_type = 'rabbit';
        $point_event->rabbit_id = $foreout_event->id;
        $point_event->created_at = $now;
        $point_event->updated_at = $now;
        $point_event->save();

        if ($corrected_points !== $request->points) {
            return $this->response->array([
                'message' => 'Over max points',
                'corrected_points' => $corrected_points*config('rabbit.default_rate'),
                'hold_points' => $user->totalPoints()
            ]);
        } else {
            return $this->response->array([
                'message' => 'Add points successfully',
                'hold_points' => $user->totalPoints()
            ]);
        }
    }
}
