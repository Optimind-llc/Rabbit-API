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
    /**
     * Get schools list
     */
    public function schools()
    {
        return $schools = School::all('id','name');
    }

    /**
     * Create a new user.
     */
    public function signup(Request $request)
    {
        $validator = app('validator')->make(
            $request->all(),
            [
                'family_name' => ['required', 'max:50'],
                'given_name'  => ['required', 'max:50'],
                'email'       => ['required', 'email', 'max:255'],
                'password'    => ['required', 'min:6', 'max:32', 'alpha_num'],
                'device_os'   => ['required'],
                'school_id'   => ['required', 'integer']
            ]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Validation error', $validator->errors());
        }

        $user = User::where('email', $request->email)->first();

        if ($user instanceof User) {
            throw new StoreResourceFailedException('Email already exist');
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

    /**
     * Sign in user and return API token.
     */
    public function signin(Request $request)
    {
        $validator = app('validator')->make(
            $request->all(),
            [
                'email'    => ['required', 'email', 'max:255'],
                'password' => ['required', 'min:6', 'max:32', 'alpha_num']
            ]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Validation error', $validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if (! $token = JWTAuth::attempt($credentials)) {
            return $this->response->errorUnauthorized();
        }

        $user = User::where('email', $request->email)
            ->with([
                'school' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->get();

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function signinThirdParty($provider, Request $request)
    {
        return ['message' => 'Sign in with ' . $provider . ' was Unimplemented'];
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
            return $this->response->errorUnauthorized();
        }

        return ['token' => $refreshedToken];
    }
}
