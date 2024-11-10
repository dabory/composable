<?php

namespace App\Providers {

    use App\Gettext\Gettext;
    use Illuminate\Support\ServiceProvider;

    class GettextServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            return $this->load(config('gettext'));
        }

        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot()
        {
            //
        }

        public function load(array $config)
        {
            if (empty($config)) {
                return;
            }

            $config['storage'] = base_path($config['storage']);

            foreach ($config['directories'] as $key => $directory) {
                $config['directories'][$key] = base_path($directory);
            }

            $gettext = new Gettext($config);

            $this->app->singleton('gettext', function () use ($gettext) {
                return $gettext;
            });

            return $gettext;
        }

        /**
         * Get the services provided by the provider.
         *
         * @return array
         */
        public function provides()
        {
            return ['gettext'];
        }
    }
}

namespace {
    function _e($original)
    {
        static $translator;

        $countryCode = collect(config('constants.countries'))->filter(function ($country) {
            return \Str::contains($country, session('locale'));
        })->first();

        if (session('user.is_member')) {
            app('gettext')->setLocale(config('constants.countries')[0], session('user.CountryCode'));
        } else if (session('member.is_member')) {
            app('gettext')->setLocale(config('constants.countries')[0], $countryCode);
        } else {
            app('gettext')->setLocale(config('constants.countries')[0], session('user.CountryCode') ?? $countryCode);
        }

        app('gettext')->load();

        if (empty($translator)) {
            $translator = app('gettext')->getTranslator();
        }

        $text = $translator->gettext($original);

        if (func_num_args() === 1) {
            return $text;
        }

        $args = array_slice(func_get_args(), 1);

        return is_array($args[0]) ? strtr($text, $args[0]) : vsprintf($text, $args);
    }
}
