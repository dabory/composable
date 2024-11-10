<?php

namespace App\Listeners;

use App\Events\PasswordRemindCreated;
use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UsersEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function subscribe($events)
    {
        $events->listen(
            PasswordRemindCreated::class,
            [UsersEventListener::class, 'onPasswordRemindCreated']
        );
    }

    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $route = $user['route'] ?? 'views.emails.auth.confirm';
        $redirectUrl = $user['redirectUrl'] ?? 'confirm';

        \Mail::send($route,
//            ['confirmUrl' => url('/') . '/pro/auth/confirm?code=' . $user['activate_code']],
            ['confirmUrl' => route($redirectUrl, [
                'code' => $user['activate_code']
            ])],
            function ($message) use ($user) {
                $message->to($user['email'], $user['id'] ?? $user['email']);

                $message->subject(
                    sprintf('[%s] 회원가입을 확인해주세요.', config('app.name'))
                );
            }
        );
    }

    public function onPasswordRemindCreated(PasswordRemindCreated $event)
    {
        $user = $event->user;
        $route = $user['route'] ?? 'views.emails.auth.passwords-reset';
        $redirectUrl = $user['redirectUrl'] ?? 'password-change.index';

        \Mail::send($route,
            ['resetUrl' => route($redirectUrl, [
                'code' => $user['reset_code']
            ])],
            function ($message) use ($user) {
                $message->to($user['email']);

                $message->subject(
                    sprintf('[%s] 비밀번호를 초기화하세요.', config('app.name'))
                );
            }
        );
    }
}
