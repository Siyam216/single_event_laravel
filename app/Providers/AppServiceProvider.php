<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// pagination
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrap();

        $setting = Setting::where('id', 1)->first();
        View::share('setting_data', $setting);
    }
}
