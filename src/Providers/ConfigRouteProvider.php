<?php

namespace TheBachtiarz\Config\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class ConfigRouteProvider extends RouteServiceProvider
{
    public function boot(): void
    {
        Route::prefix('system')->group(__DIR__ . '/../routes/api.php');
    }
}
