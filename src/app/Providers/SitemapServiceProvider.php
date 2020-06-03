<?php

namespace VCComponent\Laravel\Sitemap\Providers;

use Illuminate\Support\ServiceProvider;

class SitemapServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any package services
     *
     * @return void
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->publishes([
            __DIR__ . '/../../config/sitemap.php' => config_path('sitemap.php'),
        ]);
    }

    /**
     * Register any package services
     *
     * @return void
     */
    public function register() {
        //
    }
}
