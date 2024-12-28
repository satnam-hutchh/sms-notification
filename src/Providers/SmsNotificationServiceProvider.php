<?php
namespace Hutchh\SmsNotification\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Hutchh\SmsNotification\Managers;

class SmsNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/smsnotification.php', 'smsnotification');

        $this->app->singleton(
            abstract: Managers\SmsNotificationManager::class,
            concrete: fn (Application $app) => new Managers\SmsNotificationManager($app),
        );
    }

    /**
     * Bootstrap services. 
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/smsnotification.php' => config_path('smsnotification.php'),
            ],'config');
        }
    }
}
