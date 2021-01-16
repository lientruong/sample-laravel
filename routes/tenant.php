<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

use App\Http\Controllers\Tenant\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Central\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Central\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Central\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Central\Auth\NewPasswordController;
use App\Http\Controllers\Central\Auth\PasswordResetLinkController;
use App\Http\Controllers\Central\Auth\RegisteredUserController;
use App\Http\Controllers\Central\Auth\VerifyEmailController;
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
    \Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
    \Stancl\Tenancy\Middleware\ScopeSessions::class,
])->group(function () {
    //public routes
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('tenantLogin');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('tenantLogout');

    //tenant dashboard - authenticated
    Route::group(['middleware' => [
        'auth',
        ],], function() {
        Route::get('/',[\App\Http\Controllers\Tenant\WelcomeController::class, 'getIndex'])->name('tenantHome');
        Route::get('/tenant-dashboard', function() {
            return view('dashboard');
        })->name('tenant-dashboard');
    });
});
