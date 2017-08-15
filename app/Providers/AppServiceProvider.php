<?php

namespace App\Providers;

use App\Helpers\BlockRenderer;
use App\Helpers\PageRenderer;
use App\Helpers\PluginInitialiser;
use App\Helpers\SectionRenderer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PageRenderer::class, function ($app) {
            return new PageRenderer(new SectionRenderer(new BlockRenderer()));
        });

        $this->app->singleton(PluginInitialiser::class, function ($app) {
            return new PluginInitialiser;
        });
    }
}
