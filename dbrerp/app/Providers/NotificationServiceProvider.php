<?php

namespace App\Providers;

use App\Interfaces\NotificationServiceInterface;
use App\Services\CacheService;
use App\Services\Msg\AligoNotificationService;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(NotificationServiceInterface::class, function ($app) {
            // CacheService를 서비스 컨테이너에서 가져옵니다.
            $cacheService = $app->make(CacheService::class);

            // AligoNotificationService 인스턴스를 생성할 때 CacheService를 전달합니다.
            return new AligoNotificationService($cacheService);
        });
    }
}
