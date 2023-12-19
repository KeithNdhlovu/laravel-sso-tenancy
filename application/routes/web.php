<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     dd(Auth::user());
//     // return "Welcome home";
// });

// Route::post('logout', [LoginController::class, 'logout'])->name('logout');    // Logout

// // Socialite - External Auth Server
// Route::get('login/passport', [LoginController::class, 'redirectToExternalAuthServer']);     // Login button pressed - Redirect to auth server
// Route::get('passport/callback', [LoginController::class, 'handleExternalAuthCallback']);    // Response from Auth Server
