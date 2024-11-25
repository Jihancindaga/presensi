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
     * Register services.
     * 
     * @var string
     */
    public const HOME = '/dashboard';
    public const HOMEADMIN = '/panel/dashboardadmin';

   

    /**
     * Bootstrap services.
     * 
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    
    /**
     * Bootstrap services.
     * 
     * @return void
     */

    protected function configureRateLimiting()
    {
        RateLimiter::for('api',function(Request $request){
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
