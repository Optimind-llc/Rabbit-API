<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use JWTAuth;
// Models
use App\Models\Access\User\User;
use App\Models\Affiliation\School;
// Requests
use Illuminate\Http\Request;
use App\Http\Requests\User\Auth\SignupRequest;
use App\Http\Requests\User\Auth\SigninRequest;
use App\Http\Requests\User\Auth\SignoutRequest;
use App\Http\Requests\User\Auth\ResendConfirmationEmailRequest;
use App\Http\Requests\User\Auth\CheckApitokenRequest;
// Exceptions
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Exception\StoreResourceFailedException;

class AuthController extends Controller
{
    public function schools()
    {
        $schools = School::all('id','name');

        return $schools;
    }

    /**
     * Create a new user.
     */
    public function signup(SignupRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user instanceof User) {
            throw new StoreResourceFailedException('email.already_exist');
        }

        $user = new User;
        $user->family_name = $request->family_name;
        $user->given_name = $request->given_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->token = sha1(uniqid(mt_rand(), true));
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->confirmed = config('access.users.confirm_email') ? 0 : 1;
        $user->status = 1;
        $user->school_id = $request->school_id;      
        $user->save();

        // Queue jobを使ってメール送信
        // $this->dispatch(new SendSignUpSucceedEmail($student));

        $token = JWTAuth::fromUser($user);

        return ['token' => $token];
    }

    public function signin(SigninRequest $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                // return response()->json(['error' => 'invalid_credentials'], 401);
                return $this->response->errorUnauthorized();
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            // return response()->json(['error' => 'could_not_create_token'], 500);
            return $this->response->errorInternal();
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function refresh()
    {
        $token = JWTAuth::getToken();

        if (!$token) {
            return $this->response->errorUnauthorized();
        }

        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            return $this->response->error('something went wrong');
        }

        return $refreshedToken;
    }
}
