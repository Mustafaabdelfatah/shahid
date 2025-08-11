<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Setting;
use App\Models\TagNews;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(Schema::hasTable('settings')){
            $setting_dashboard = Setting::query()->where('type','dashboard')->first();
            if($setting_dashboard){
                view()->share('setting_dashboard', $setting_dashboard);
            }
        }
    }


}
