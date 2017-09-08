<?php

namespace App\Providers;

use App\Helpers\MenuBuilder;
use App\Plugin\PluginInitialiser;
use Doctrine\DBAL\Driver\PDOException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        try {
            $menuBuilder = new MenuBuilder;
            View::share('menu', $menuBuilder->build());
        } catch (\Exception $exception) {
            // Catch `artisan` commands failing here
        }
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
