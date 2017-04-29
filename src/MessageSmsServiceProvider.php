<?php

namespace Simon801109\MessageSms;

use Illuminate\Support\ServiceProvider;

class MessageSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/sms.php' => config_path('sms.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('message-sms', function() {
            return new Sms;
        });
        $this->mergeConfigFrom(
            __DIR__.'/config/sms.php', 'sms'
        );
    }
}
