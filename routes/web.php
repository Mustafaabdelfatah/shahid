<?php

use Spatie\FlareClient\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\HomePageController;
use App\Http\Controllers\Broker\ProductController;
use App\Http\Controllers\Broker\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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



Route::get('/',function(){
    return view('admin.auth.login');
});

// Route::group([
//     'prefix' => LaravelLocalization::setLocale(),
//     'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
// ], function () {

//     Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'broker', 'as' => 'broker.'], function () {
//         // //Route dashboard
//         Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//         Route::resource('products',ProductController::class);
//         // //Route Profile
//     });
// });
require __DIR__.'/auth.php';
