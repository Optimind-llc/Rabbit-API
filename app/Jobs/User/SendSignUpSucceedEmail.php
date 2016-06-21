<?php

namespace App\Jobs\User;

use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Access\User\User;

class SendSignUpSucceedEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $user = $this->user;
        $mailer->send(
            'user.emails.signup',
            [
                'token' => $user->confirmation_code,
                'name' => $user->family_name.' '.$user->given_name,
                'email' => $user->email,
            ],
            function ($message) use ($user) {
                $message->to(
                    $user->email,
                    $user->family_name
                )->subject('Rabbit: 登録完了');
            }
        );
    }
}
