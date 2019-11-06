<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Services\Converter\Converter;
use Illuminate\Support\ServiceProvider;

/**
 * Class FileConverterProvider
 *
 * @package App\Providers
 */
class FileConverterProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(Converter::class, function () {
            return new Converter();
        });
    }
}
