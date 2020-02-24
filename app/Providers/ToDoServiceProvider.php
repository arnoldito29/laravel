<?php

namespace App\Providers;

use App\Models\ToDo;
use App\Services\ToDoService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ToDoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ToDoService::class, function ($app) {
            return new ToDoService($app->make(ToDo::class), $app->make(Config::class));
        });
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
}
