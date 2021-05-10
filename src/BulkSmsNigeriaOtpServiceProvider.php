<?php

namespace Gabbyti\BulkSmsNigeriaOtp;

use Illuminate\Support\ServiceProvider;

class BulkSmsNigeriaOtpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BulkSmsNigeriaOtp::class, function () {
            return new BulkSmsNigeriaOtp();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/bulksmsnigeriaotp.php' => config_path('bulksmsnigeriaotp.php'),
            __DIR__ . '/Http/Controllers/OtpController.php' => app_path('Http/Controllers/OtpController.php'),
        ]);
    }
}
