<?php

namespace App\Providers;

use App\Helpers\PluginInitialiser;
use App\Renderers\BlockRenderer;
use App\Renderers\FooterRenderer;
use App\Renderers\HeaderRenderer;
use App\Renderers\PageRenderer;
use App\Renderers\SectionRenderer;
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
            return new PageRenderer(
                new HeaderRenderer(),
                new SectionRenderer(new BlockRenderer()),
                new FooterRenderer());
        });

        $this->app->singleton(PluginInitialiser::class, function ($app) {
            return new PluginInitialiser;
        });
    }
}
