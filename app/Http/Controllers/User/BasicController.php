<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
// Models
use App\Models\Access\User\User;
use App\Models\History\Rabbit;
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

    public function forein(Request $request)
    {
        $validator = app('validator')->make(
            $request->all(),
            [
                'time' => ['required', 'digits:10']
            ]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Validation error', $validator->errors());
        }

        $now = Carbon::now();
        $user = $this->getUser();

        $shouldCheckGPS = $user->rabbits()
        	->where('created_at', '>=', Carbon::today())
        	->where('rabbit_type_id', 1)
        	->count();

        if($shouldCheckGPS === 0) {
	        $validator = app('validator')->make(
	            $request->all(),
	            [
	                'lat'  => ['required', 'numeric'],
	                'lon'  => ['required', 'numeric']
	            ]
	        );

	        if ($validator->fails()) {
	            throw new StoreResourceFailedException('Validation error', $validator->errors());
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
                return $this->response->errorBadRequest('aaa');
            }

			return 'in campus';
        }

        // $event = new Rabbit;
        // $event->rabbit_type_id = 1;
        // $event->user_id = $user->id;
        // $event->local_time = $request->time;
        // $event->created_at = $now;
        // $event->created_at = $now;
        // $event->save();

        // Check forein history
        return $user->rabbits()->get()->toArray();

        // return ;
    }

    public function foreout()
    {
        $validator = app('validator')->make(
            $request->all(),
            [
                'interval' => ['required', 'integer'],
                'rate'     => ['required', 'integer'],
                'time'     => ['required', 'digits:10']
            ]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Validation error', $validator->errors());
        }

    	$user = $this->getUser();

        return $decode;
    }
}