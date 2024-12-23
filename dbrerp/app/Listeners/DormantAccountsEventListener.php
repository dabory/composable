<?php

namespace App\Listeners;

use App\Events\DormantAccountNotify;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\View;

class DormantAccountsEventListener
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

    public function handle(DormantAccountNotify $event)
    {
        $account = $event->account;

        $route = 'views.emails.auth.dormant-account';
        if (! View::exists($route)) {
            $route = 'emails.auth.dormant-account';
        }

        try {
            \Mail::send($route,
                [
                    'loginUrl' => route('member-login'),
                    'account' => $account
                ],
                function ($message) use ($account) {
                    $message->to($account['email']);

                    $message->subject(
                        sprintf('[%s] 휴면 계정 전환 안내입니다.', config('app.name'))
                    );
                }
            );

            return [$account['email'] => true];
        } catch (Exception $e) {
            return [$account['email'] => false];
        }

    }
}
