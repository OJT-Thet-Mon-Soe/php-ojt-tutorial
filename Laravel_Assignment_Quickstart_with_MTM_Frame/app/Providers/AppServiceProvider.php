<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Dao Registration
        $this->app->bind("App\Contracts\Dao\TaskDaoInterface","App\Dao\TaskDao");

        // Bussiness logic registration
        $this->app->bind("App\Contracts\Services\TaskServiceInterface","App\Services\TaskService");
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

