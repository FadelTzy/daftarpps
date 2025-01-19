<?php

namespace App\Providers;

use App\Models\pvsemester;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

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
        $semesaktif = pvsemester::where('status', 'Aktif')->first();
        view()->share('semesaktif', $semesaktif);


        // URL::forceScheme('https');

    }
}
