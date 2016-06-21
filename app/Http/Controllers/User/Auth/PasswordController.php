<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use JWTAuth;
// Models
use App\Models\Access\User\User;
// Jobs
use App\Jobs\User\SendInitializedPasswordEmail;
// Exceptions
use Dingo\Api\Exception\StoreResourceFailedException;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware($this->guestMiddleware());
    }

    /**
     * Get student from email
     */
    public function findByEmail($email) {
        $user = User::where('email', $email)->first();

        if (!$user instanceof User) {
            return $this->response->errorNotFound('User not found');
        }

        return $user;
    }

    public function initialize(Request $request)
    {
        $validator = app('validator')->make(
            $request->only(['email']),
            ['email' => ['required', 'email', 'max:255']]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Fail to create new user', $validator->errors());
        }

        $user = $this->findByEmail($request->email);

        $passsword = substr(base_convert(md5(uniqid()), 16, 36), 0, 8);

        $user->password = bcrypt($passsword);
        $user->save();

        // Queue jobを使ってメール送信
        $this->dispatch(new SendInitializedPasswordEmail($user, $passsword));

        $message = 'initializePassword.success';

        return \Response::json([
            'message' => 'Password initialized'
        ], 200);
    }

    public function change(Request $request)
    {
        $validator = app('validator')->make(
            $request->only(['password', 'new_password']),
            [
                'password' => ['required', 'min:6', 'max:32', 'alpha_num'],
                'new_password' => ['required', 'min:6', 'max:32', 'alpha_num']
            ]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Validation error', $validator->errors());
        }

        $credentials = [
            'email' => JWTAuth::parseToken()->toUser()->email,
            'password' => $request->password
        ];

        if (!\Auth::guard('user')->once($credentials)) {
            return $this->response->errorUnauthorized('Password incorrect');
        }

        $user = \Auth::guard('user')->user();

        if (!$user instanceof User) {
            return $this->response->errorNotFound('User not found');
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return \Response::json([
            'message' => 'Password changed'
        ], 200);
    }

    public function reset(Request $request)
    {
        return ['message' => 'Unimplemented'];
    }
}
