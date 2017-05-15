<?php

namespace Roem\Media;

use Roem\Media\Console\Commands\DeleteImageCacheCommand;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/roem-media.php' => config_path('roem-media.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/roem-media.php', 'roem-media'
        );

        $this->app->register('Roem\\Media\\Providers\\EventServiceProvider');

        $this->registerCommands();
    }

    /**
     * Register the artisan commands
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->app['command.media.image.cache:delete'] = $this->app->share(function ($app) {
            return new DeleteImageCacheCommand();
        });

        $this->commands([
            'command.media.image.cache:delete'
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
