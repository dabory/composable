<?php

namespace App\Providers;

use App\ThirdPartyApi\Aligo\Services\AligoSmsService;
use App\ThirdPartyApi\Barobill\Adapter\BarobillAccountAdapter;
use App\ThirdPartyApi\Barobill\Services\BarobillAccountService;
use App\ThirdPartyApi\Barobill\Services\BarobillSmsService;
use Illuminate\Support\ServiceProvider;

class ThirdPartyApiServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('App\ThirdPartyApi\Interfaces\AccountInterface', function() {
            $barobillAccountService = new BarobillAccountService(app()->make('App\Services\CallApiService'));
            return new BarobillAccountAdapter($barobillAccountService);
        });

        $this->app->singleton('App\ThirdPartyApi\Interfaces\SmsInterface', function() {
            return new AligoSmsService();
        });
    }
}
