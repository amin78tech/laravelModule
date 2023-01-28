<?php
namespace Moldule\auth\providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace='Module\auth\http\controllers';
    public const HOME = '/home';
    public function boot()
    {
        $this->configureRateLimiting();
        $this->routes(function (){
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('module/auth/routes/web.php'));
        });
    }

    public function configureRateLimiting()
    {
        RateLimiter::for('web',function (Request $request){
            return Limit::perMinute('60')->by($request->user()?->id ?: $request->ip());
        });
    }
}
