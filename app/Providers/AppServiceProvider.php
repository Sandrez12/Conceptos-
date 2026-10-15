<?php

namespace App\Providers;

use App\Contracts\ContentSource;
use App\Services\FileContentSource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Inversión de dependencias aplicada en este mismo sitio:
        // los controladores piden la interfaz y aquí se decide la implementación.
        $this->app->singleton(ContentSource::class, fn () => new FileContentSource(resource_path('content')));
    }

    public function boot(): void
    {
        //
    }
}
