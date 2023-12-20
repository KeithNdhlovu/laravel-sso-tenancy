<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');    // Logout

    // Socialite - External Auth Server
    Route::get('login/passport', [LoginController::class, 'redirectToExternalAuthServer'])->name('login');     // Login button pressed - Redirect to auth server
    Route::get('passport/callback', [LoginController::class, 'handleExternalAuthCallback']);    // Response from Auth Server

    // Resources
    Route::middleware(['auth'])->group(function () {
        
    });
});
