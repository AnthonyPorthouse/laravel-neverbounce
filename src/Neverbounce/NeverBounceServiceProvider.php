<?php

namespace Groundsix\Neverbounce;

use Illuminate\Support\ServiceProvider;
use NeverBounce;
use NeverBounce\API\NB_Auth;
use NeverBounce\API\NB_Single;
use Validator;

class NeverBounceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/config/neverbounce.php' => $this->app->configPath().'/'.'neverbounce.php',
        ], 'config');

        $this->app->validator->extend('neverbounce', function ($attribute, $value, $parameters, $validator) {
            return NeverBounce::valid($value);
        },
        'It is not possible to send to this email address');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../resources/config/neverbounce.php', 'neverbounce');

        $this->registerBindings();
    }

    /**
     * Register the bindings.
     */
    public function registerBindings()
    {
        $config = $this->app->config['neverbounce'];

        $this->app->singleton(NB_Single::class, function ($app) use ($config) {
            NB_Auth::auth($config['secret_key'], $config['key'], $config['router'], $config['version']);

            return NB_Single::app();
        });
        $this->app->singleton(NeverBounce::class, function ($app) {
            return new NeverBounce($this->app->make(NB_Single::class));
        });
    }
}
