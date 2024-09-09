<?php

namespace trepro\Weather\Providers;

use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
{
    // $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    $this->loadViewsFrom(__DIR__.'/../views', 'weather');
    $this->publishes([
        __DIR__.'/../Providers/config/weather.php' => config_path('weather.php'),
    ]);
}
}