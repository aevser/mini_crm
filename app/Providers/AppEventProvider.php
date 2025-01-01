<?php

namespace App\Providers;

use App\Events\LeadCount;
use App\Listeners\CountLeadsListener;
use Illuminate\Support\ServiceProvider;

class AppEventProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $listen = [
        LeadCount::class => [
            CountLeadsListener::class,
        ],
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
