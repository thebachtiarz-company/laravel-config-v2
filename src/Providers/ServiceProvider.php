<?php

namespace TheBachtiarz\Config\Providers;

use TheBachtiarz\Config\Interfaces\Models\ConfigInterface;
use TheBachtiarz\Config\Interfaces\Repositories\ConfigRepositoryInterface;
use TheBachtiarz\Config\Interfaces\Services\ConfigServiceInterface;
use TheBachtiarz\Config\Models\Config;
use TheBachtiarz\Config\Repositories\ConfigRepository;
use TheBachtiarz\Config\Services\ConfigService;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(abstract: ConfigInterface::class, concrete: Config::class);
        $this->app->bind(abstract: ConfigRepositoryInterface::class, concrete: ConfigRepository::class);
        $this->app->bind(abstract: ConfigServiceInterface::class, concrete: ConfigService::class);

        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            \TheBachtiarz\Config\Console\Commands\ConfigGeneratorCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $configName  = 'tbconfig';
        $publishName = 'thebachtiarz-config';

        $this->publishes([__DIR__ . "/../../configs/$configName.php" => config_path("$configName.php")], "$publishName-config");
        $this->publishes([__DIR__ . '/../../database/migrations' => database_path('migrations')], "$publishName-migrations");
    }
}
