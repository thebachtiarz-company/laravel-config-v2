<?php

use Illuminate\Support\Facades\Route;
use TheBachtiarz\Config\Http\Controllers\ConfigController;

/**
 * Group    : Config.
 * URI      : {{base_url}}/system/config/---
 */
Route::prefix('config')->controller(ConfigController::class)->group(function () {
    /**
     * Name     : Get config.
     * Method   : GET.
     * URL      : {{base_url}}/system/config/get
     */
    Route::get('get', 'getConfig');

    /**
     * Name     : Create or update config.
     * Method   : POST.
     * URL      : {{base_url}}/system/config/create
     */
    Route::post('create', 'createOrUpdate');
});
