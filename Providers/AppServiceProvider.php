<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            \Illuminate\Support\Facades\View::share('global_categories', \App\Models\Category::all());
        } catch (\Exception $e) {
            // Avoid error if table doesn't exist yet (e.g. during migration)
        }
    }
}
