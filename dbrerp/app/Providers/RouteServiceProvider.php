<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('dabory-app')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/dabory.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/myapp.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/my-app.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/shop.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/msg.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/local/file.php'));

            $this->mapWebRoutes();
        });
    }

    protected function mapWebRoutes()
    {
        // pro
        $langPath = public_path('themes/pro/' . env('DBR_THEME') . '/resources/lang');
        $this->loadTranslationsFrom($langPath, env('DBR_THEME'));
        $this->loadJsonTranslationsFrom($langPath);

        if (env('DBR_THEME')) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(daboryPath('themes/' . env('DBR_THEME') . '/pro/routes/web.php'));

            $erpRoutePath = 'themes/' . env('DBR_THEME') . '/erp/routes/web.php';
            if (file_exists(daboryPath($erpRoutePath))) {
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(daboryPath($erpRoutePath));
            }

            $strongErpRoutePath = 'themes/' . env('DBR_THEME') . '/strong/frontend/erp/routes/web.php';
            if (file_exists(daboryPath($strongErpRoutePath))) {
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(daboryPath($strongErpRoutePath));
            }
            $strongProRoutePath = 'themes/' . env('DBR_THEME') . '/strong/frontend/pro/routes/web.php';
            if (file_exists(daboryPath($strongProRoutePath))) {
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(daboryPath($strongProRoutePath));
            }
            $strongMyappRoutePath = 'themes/' . env('DBR_THEME') . '/strong/frontend/myapp/routes/web.php';
            if (file_exists(daboryPath($strongMyappRoutePath))) {
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(daboryPath($strongMyappRoutePath));
            }
        }

        // erp
//        $erpThemes = preg_replace('/\s+/', '', explode(',', env('ERP_THEMES')));
//        foreach ($erpThemes as $theme) {
//            if (empty($theme)) { continue; }
//            Route::middleware('web')
//                ->namespace($this->namespace)
//                ->group(daboryPath("themes/$theme/erp/routes/web.php"));
//        }
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
