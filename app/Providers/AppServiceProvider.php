<?php

namespace App\Providers;

use App\Contracts\FlightReservationRepositoryInterface;
use App\Repositories\FlightReservationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        FlightReservationRepositoryInterface::class => FlightReservationRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
