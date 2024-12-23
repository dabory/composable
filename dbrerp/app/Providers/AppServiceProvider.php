<?php

namespace App\Providers;

use App\Exceptions\ParameterException;
use App\Foundation\ElasticsearchClient;
use App\Helpers\File;
use App\Helpers\Utils;
use App\Helpers\DataConverter;
use App\Services\CallApiService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    private $whiteList = ['front.dabory.erp.list-type.type1', 'front.dabory.erp.list-type.genesis-type1', 'front.dabory.pro.my-app.list-type.type1', 'front.dabory.erp.list-type.list-media1',
        'front.dabory.erp.list-type.setup-type1', 'front.dabory.erp.list-type.struct-type1', 'front.dabory.erp.list-type.search-type1', 'front.dabory.erp.list-type.cal-type1', 'msg.dabory.pro.*',];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ElasticsearchClient::class, function ($app) {
            $config = $app['config']->get('elasticsearch');
            return new ElasticsearchClient($config['hosts']);
        });

        $this->app->bind('App\Interfaces\WithdrawInterface', 'App\Services\WithdrawService');
        $this->app->bind('App\Interfaces\DormantInterface', 'App\Services\DormantService');

        $this->app->singleton(CallApiService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (isSecure()) {
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS','on');
        }

        Paginator::useBootstrap();

        View::composer($this->whiteList, function ($view) {
            $bpa = Utils::bpaDecoding(request('bpa'));
            if ($bpa) {
                $themeDir = $bpa['theme_dir'];

                if ($themeDir) {
                    DataConverter::$codeTitle['theme-directories'] = collect(File::getThemeCodeTitleDirectories($themeDir))->toArray();
                    foreach (DataConverter::$codeTitle['theme-directories'] as $key => $directory) {
                        DataConverter::$codeTitle[$directory] = File::getThemeCodeTitleFiles($directory, $themeDir);
                    }
                }
            }

            try {
                DataConverter::$codeTitle['directories'] = collect(File::getCodeTitleDirectories())->toArray();
                foreach (DataConverter::$codeTitle['directories'] as $key => $directory) {
                    if (isset(DataConverter::$codeTitle[$directory])) {
                        DataConverter::$codeTitle[$directory] = array_merge(DataConverter::$codeTitle[$directory], File::getCodeTitleFiles($directory));
                    } else {
                        DataConverter::$codeTitle[$directory] = File::getCodeTitleFiles($directory);
                    }
                }
            } catch (ParameterException $e) {

            }

            $view->with('codeTitle', DataConverter::$codeTitle);
        });

        View::composer('*', function ($view) {
            foreach ($this->whiteList as $list) {
                if (\Str::is($list, $view->getName())) return;
            }
//            if (\Str::contains($view->getName(), $this->whiteList)) return;

            if (isset($view['__env']) || !isset($view['codeTitle'])) return;

            DataConverter::$codeTitle = [];
            try {
                DataConverter::$codeTitle['directories'] = collect(File::getCodeTitleDirectories())->map(function ($name) { return Utils::snakeCase($name); })->toArray();
//                 dd(DataConverter::$codeTitle['directories']);

                foreach ($view['codeTitle'] as $key => $value) {
                    if (\Str::contains($value, DataConverter::$codeTitle['directories'])) {
                        try {
                            eval("DataConverter::get_{$value};");
                        } catch (\Throwable $th) { }
                    }
                }

            } catch (ParameterException $e) {

            }

            // dd(DataConverter::execute(null, "status('sorder','0')"));
//            dd(DataConverter::$codeTitle);
            $view->with('codeTitle', DataConverter::$codeTitle);
        });
    }
}
