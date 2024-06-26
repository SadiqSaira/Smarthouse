<?php

namespace App\Providers;
use App\Services\LocationService;
use App\Services\LocationServiceInterface;
use App\Services\RoomService;
use App\Services\RoomServiceInterface;
use App\Repositories\LocationRepository;
use App\Repositories\LocationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RoomServiceInterface::class, RoomService::class);
        $this->app->bind(LocationServiceInterface::class, LocationService::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
