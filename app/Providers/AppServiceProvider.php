<?php

namespace App\Providers;

use App\Events\LeadCount;
use App\Listeners\CountLeadsListener;
use App\Listeners\UpdateLeadCounters;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
