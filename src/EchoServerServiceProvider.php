<?php

namespace RenokiCo\EchoServer;

use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class EchoServerServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @param  \Illuminate\Broadcasting\BroadcastManager  $broadcastManager
     * @return void
     */
    public function boot(BroadcastManager $broadcastManager)
    {
        $this->registerConfig();

        $this->registerMigrations();

        $this->registerRoutes();

        $this->registerBroadcastDriver($broadcastManager);

        $this->registerAppsManager();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the migrations.
     *
     * @return void
     */
    protected function registerMigrations(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations/2021_01_14_000000_create_echo_apps_table.php' => database_path('migrations/2021_01_14_000000_create_echo_apps_table.php'),
        ], 'migrations');
    }

    /**
     * Register the configuration file.
     *
     * @return void
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            __DIR__.'/../config/echo-server.php' => config_path('echo-server.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../config/echo-server.php', 'echo-server'
        );
    }

    /**
     * Register the broadcast manager.
     *
     * @param  \Illuminate\Broadcasting\BroadcastManager  $broadcastManager
     * @return void
     */
    protected function registerBroadcastDriver(BroadcastManager $broadcastManager): void
    {
        $broadcastManager->extend('socketio', function ($app, $config) {
            $pusher = new EchoPusher(
                $config['key'],
                $config['secret'],
                $config['app_id'],
                $config['options'] ?? []
            );

            if ($config['log'] ?? false) {
                $pusher->setLogger($this->app->make(LoggerInterface::class));
            }

            return new Broadcasters\EchoServerBroadcaster($pusher);
        });
    }

    /**
     * Register the routes for API.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        if (! config('echo-server.api.enable', true)) {
            return;
        }

        Route::group([
            'as' => 'echo-server.',
            'domain' => config('echo-server.api.domain', null),
            'middleware' => config('echo-server.api.middleware'),
            'prefix' => config('echo-server.api.prefix'),
        ], function () {
            Route::get('/app', [\RenokiCo\EchoServer\Http\Controllers\AppsController::class, 'show'])->name('app.show');
        });
    }

    /**
     * Register the apps managers.
     *
     * @return void
     */
    protected function registerAppsManager(): void
    {
        $this->app->bind(Contracts\AppsManager::class, function () {
            $driver = config('echo-server.app-manager.driver');
            $class = config("echo-server.app-manager.{$driver}.manager");

            return new $class;
        });
    }
}
