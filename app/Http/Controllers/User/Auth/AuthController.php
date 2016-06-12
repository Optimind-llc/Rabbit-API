<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use JWTAuth;
// Models
use App\Models\Access\User\User;
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
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function signup(SignupRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($student instanceof Student) {
            throw new StoreResourceFailedException('email.already_exist');
        }

        $student = new Student;
        $student->family_name = $request->family_name;
        $student->given_name = $request->given_name;
        $student->email = $request->email;
        $student->password = bcrypt($request->password);
        $student->api_token = sha1(uniqid(mt_rand(), true));
        $student->confirmation_code = md5(uniqid(mt_rand(), true));
        $student->confirmed = config('access.users.confirm_email') ? 0 : 1;
        $student->status = 1;
        $student->save();

        // Queue jobを使ってメール送信
        // $this->dispatch(new SendSignUpSucceedEmail($student));

        $token = JWTAuth::fromUser($user);

        return $token;
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
}
