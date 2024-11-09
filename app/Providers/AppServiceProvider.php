<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Models\Role;
use App\Services\SapService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\Inisiatif\WhatsappQontakPhp\ClientInterface::class, function () {
            return $this->app->runningUnitTests() ? \Inisiatif\WhatsappQontakPhp\ClientFactory::makeTestingClient() :  \Inisiatif\WhatsappQontakPhp\ClientFactory::makeFromArray(
                config('services.qontak')
            );
        });

        $this->app->singleton(SapService::class, function ($app) {
            return new SapService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });

        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
