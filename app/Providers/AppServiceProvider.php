<?php

namespace App\Providers;

use App\Helpers\MenuBuilder;
use App\Plugin\PluginInitialiser;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menuBuilder = new MenuBuilder();
        View::share('menu', $menuBuilder->build());
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PluginInitialiser::class, function ($app) {
            return new PluginInitialiser;
        });
    }

}
