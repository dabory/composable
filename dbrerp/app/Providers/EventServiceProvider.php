<?php

namespace App\Providers;

use App\Listeners\UsersEventListener;
use Illuminate\Auth\Events\Registered;
use SocialiteProviders\Apple\AppleExtendSocialite;
use SocialiteProviders\Kakao\KakaoExtendSocialite;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Google\GoogleExtendSocialite;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Naver\NaverExtendSocialite;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\UserCreated::class => [
            \App\Listeners\UsersEventListener::class
        ],
        \App\Events\DormantAccountNotify::class => [
            \App\Listeners\DormantAccountsEventListener::class
        ],
        SocialiteWasCalled::class => [
            KakaoExtendSocialite::class,
            GoogleExtendSocialite::class,
            NaverExtendSocialite::class,
            AppleExtendSocialite::class
        ]
    ];

    protected $subscribe = [
        UsersEventListener::class
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
