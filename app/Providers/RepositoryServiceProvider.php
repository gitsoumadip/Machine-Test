<?php

namespace App\Providers;

use App\Contracts\UserManagment\UserManagmentContract;
use App\Services\UserManagment\UserManagmentService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $repositories = [
        UserManagmentContract::class => UserManagmentService::class
    ];

    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
