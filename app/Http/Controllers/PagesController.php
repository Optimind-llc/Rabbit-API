<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Access\User\User;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class RoomController
 * @package App\Http\Controllers
 */
class PagesController extends Controller
{
    public function front()
    {
    	// return 'aaa';
        // return User::all();

        $user = User::findOrFail(1);
        $token = JWTAuth::fromUser($user);

        // return $user;
        return $token;

        // return $this->response->array($user->toArray());
        // return $this->response->item($user, new UserTransformer);

        // return $this->response->created('http://yahoo.co.jp');
        // return $this->response->errorForbidden();
        // return $this->response->noContent();
    }

    public function show()
    {
        try {
            $user = JWTAuth::parseToken()->toUser();

            if (!$user) {
                return $this->response->errorNotFound('User Not Found');
            }
        } catch (JWTException $e) {
            return $this->response->error('something went wrong');
        }
    	
        return $this->response->array(compact('user'));
    }


    public function decode()
    {
        $token = JWTAuth::getToken();
        $decode = JWTAuth::decode($token);

        return $decode;
    }
}