<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Tentukan namespace untuk Controller
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Bootstrap layanan aplikasi.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // Daftarkan route untuk API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Daftarkan route untuk Web
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email);
        });
    }
}
