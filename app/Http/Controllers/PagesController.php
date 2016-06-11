<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Dingo\Api\Routing\Helpers;

use App\Models\Access\User\User;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class RoomController
 * @package App\Http\Controllers
 */
class PagesController extends Controller
{
	use Helpers;

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

    public function front2()
    {
    	JWTAuth::parseToken();
    	$user = JWTAuth::parseToken()->authenticate();

    	return $user;
    }


    public function back()
    {
        $user = User::findOrFail(1);
        return $this->response->array($user->toArray());
    }
}