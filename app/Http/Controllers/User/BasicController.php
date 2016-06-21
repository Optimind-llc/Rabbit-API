<?php

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
// Models
use App\Models\Access\User\User;
use App\Models\History\Rabbit;
// Exceptions
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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

    public function forein()
    {
        $user = $this->getUser();

        $now = Carbon::now();

        $forein = new Rabbit;
        $forein->rabbit_type_id = 1;
        $forein->created_at = 1;
        $forein->created_at = 1;

        return $user->rabbits;
    }

    public function foreout()
    {
    	$user = $this->getUser();

        return $decode;
    }
}