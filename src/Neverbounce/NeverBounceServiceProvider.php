<?php

namespace Groundsix\Neverbounce;

use Illuminate\Support\ServiceProvider;
use Neverbounce\App\NB_Auth;
use Neverbounce\App\NB_Single;

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
    }

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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

        $this->app->singleton(NB_Single::class, function ($app) {
            NB_Auth::auth($config['key'], $config['id'], $config['router'], $config['version']);

            return NB_Single::app();
        });
        $this->app->singleton(NeverBounce::class, function ($app) {
            return new NeverBounce();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [NB_Single::class, NeverBounce::class];
    }
}
