<?php

namespace JumpTwentyFour\LaravelHttpLogger;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use JumpTwentyFour\LaravelHttpLogger\Contracts\RequestLoggerContract;
use JumpTwentyFour\LaravelHttpLogger\Contracts\ResponseLoggerContract;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/http-logger.php' => config_path('http-logger.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/http-logger.php', 'http-logger');
        $this->app->bind(ResponseLoggerContract::class, config_path('http-logger.response_logger'));
        $this->app->bind(RequestLoggerContract::class, config_path('http-logger.request_logger'));
    }
}