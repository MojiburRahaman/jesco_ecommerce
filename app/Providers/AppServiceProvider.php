<?php

namespace App\Providers;

use App\Models\Catagory;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        if (Schema::hasTable('site_settings')) {
            
            view()->share('site_settings', SiteSetting::first());
        }
        if (Schema::hasTable('catagories')) {
            
            view()->share('category_home_view', Catagory::with('Subcatagory')->where('add_to_home',1)->get());
        }
    }
}
