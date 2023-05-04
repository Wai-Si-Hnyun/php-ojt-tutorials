<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Dao register
        $this->app->bind('App\Contracts\Dao\MajorDaoInterface', 'App\Dao\MajorDao');
        $this->app->bind('App\Contracts\Dao\StudentDaoInterface', 'App\Dao\StudentDao');
        $this->app->bind('App\Contracts\Dao\AuthDaoInterface', 'App\Dao\AuthDao');

        //Services register
        $this->app->bind('App\Contracts\Services\MajorServiceInterface', 'App\Services\MajorService');
        $this->app->bind('App\Contracts\Services\StudentServiceInterface', 'App\Services\StudentService');
        $this->app->bind('App\Contracts\Services\AuthServiceInterface', 'App\Services\AuthService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
