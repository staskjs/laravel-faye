<?php

namespace Staskjs\LaravelFaye;

use Illuminate\Support\ServiceProvider;
use Illuminate\Broadcasting\BroadcastManager;

class LaravelFayeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(BroadcastManager $broadcastManager) {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-faye');
        $broadcastManager->extend('faye', function ($app, array $config) {
            return new Faye;
        });

    }
}
