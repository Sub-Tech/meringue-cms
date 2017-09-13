<?php

namespace App\Providers;

use App\MenuOption;
use App\Plugin\PluginBase;
use App\Plugin\PluginInitialiser;
use Illuminate\Http\Request;
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
            View::share('menu', MenuOption::getParents());
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

        $this->app->bind(PluginBase::class, function () {
            $request = app(Request::class);

            return PluginInitialiser::getPlugin(
                class_path($request->vendor, $request->plugin)
            );
        });

        $this->app->bind('PluginInitialiser', PluginInitialiser::class);
    }

}
