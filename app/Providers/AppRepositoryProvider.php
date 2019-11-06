<?php

declare(strict_types = 1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppRepositoryProvider
 *
 * @package App\Providers
 */
class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repositories\FileRepositoryInterface',
            'App\Repositories\FileRepository'
        );

        $this->app->bind(
            'App\Repositories\FileStorageRepositoryInterface',
            'App\Repositories\FileStorageRepository'
        );
    }
}
