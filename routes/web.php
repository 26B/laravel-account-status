<?php

use Illuminate\Support\Facades\Route;

// FIXME: When using the route from here, the authentication doesn't work.
Route::get('/account-status', fn() => view('account-status::status'))
    ->name(config('account-status.view_name'))
    ->middleware(['auth:sanctum', 'verified']);
