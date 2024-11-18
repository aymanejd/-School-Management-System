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
        $this->app->bind(
            \App\Repository\StudentRepositoryInterface::class,
            \App\Repository\StudentRepository::class
        );
        $this->app->bind(
            \App\Repository\StudentPromotionRepositoryInterface::class,
            \App\Repository\StudentPromotionRepository::class
        ); $this->app->bind(
            \App\Repository\StudentGraduatedRepositoryInterface::class,
            \App\Repository\StudentGraduatedRepository::class
        );
        $this->app->bind(
            \App\Repository\AttendanceRepositoryInterface::class,
            \App\Repository\AttendanceRepository::class
        );
    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}