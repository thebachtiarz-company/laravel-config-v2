<?php

namespace TheBachtiarz\Config\Providers;

use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    public function boot(): void
    {
        Route::prefix('system')->middleware('api')->group(__DIR__ . '/../routes/api.php');
    }
}
