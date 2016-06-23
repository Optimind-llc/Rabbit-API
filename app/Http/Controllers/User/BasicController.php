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
     * Fore in enent
     */
    public function forein(Request $request)
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

        $count_forein = $user->rabbits()
        	->where('created_at', '>=', $today)
        	->where('rabbit_type_id', 1)
        	->count();

        if($count_forein === 0) {
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

        $event = new Rabbit;
        $event->rabbit_type_id = 1;
        $event->user_id = $user->id;
        $event->device_interval = null; 
        $event->device_time = Carbon::createFromTimestamp($request->time);
        $event->created_at = $now;
        $event->updated_at = $now;
        $event->save();

        return $this->response->array(['rate' => config('rabbit.default_rate')]);
    }

    /**
     * Fore out enent
     */
    public function foreout(Request $request)
    {
        $validator = app('validator')->make(
            $request->all(),
            [
                'interval' => ['required', 'integer'],
                'rate' => ['required', 'integer'],
                'time' => ['required', 'digits:10']
            ]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Validation error', $validator->errors());
        }

        $now = Carbon::now();
        $today = Carbon::today();
        $max_points = (config('rabbit.end_time')-config('rabbit.start_time'))*60*60/config('rabbit.default_rate');
        $this_points = floor($request->interval/$request->rate);

        $user = $this->getUser();

        $points = $user->points()
            ->where('created_at', '>=', $today)
            ->where('history_type', 'rabbit')
            ->get(['point']);

        $total_points = $points->reduce(function ($carry, $item) {
            return $carry + $item->point;
        }, 0);

        $corrected_this_points = $total_points + $this_points > $max_points ?
            $max_points - $total_points :
            $this_points;

        $foreout_event = new Rabbit;
        $foreout_event->rabbit_type_id = 2;
        $foreout_event->user_id = $user->id;
        $foreout_event->device_interval = $request->interval;
        $foreout_event->device_time = Carbon::createFromTimestamp($request->time);
        $foreout_event->created_at = $now;
        $foreout_event->updated_at = $now;
        $foreout_event->save();

        $point_event = new Point;
        $point_event->point = $corrected_this_points;
        $point_event->user_id = $user->id;
        $point_event->history_type = 'rabbit';
        $point_event->history_id = $foreout_event->id;
        $point_event->created_at = $now;
        $point_event->updated_at = $now;
        $point_event->save();

        if ($corrected_this_points !== $this_points) {
            return $this->response->array([
                'message' => 'Over max points',
                'corrected_points' => $corrected_this_points
            ]);
        } else {
            return $this->response->array([
                'message' => 'add points successful',
                'corrected_points' => $corrected_this_points
            ]);
        }
    }
}
