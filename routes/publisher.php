<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Publisher\Advertisement\AdvertisementController;
use App\Http\Controllers\Publisher\Authorizations\RoleController;
use App\Http\Controllers\Publisher\DashboardController;
use App\Http\Controllers\Publisher\OrderController;
use App\Http\Controllers\Publisher\Package\PackageController;
use App\Http\Controllers\Publisher\Package\PricePackageController;
use App\Http\Controllers\Publisher\Project\ProjectController;
use App\Http\Controllers\Publisher\Team\TeamController;
use App\Http\Controllers\Publisher\Unit\UnitController;
use App\Http\Controllers\Publisher\User\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::group(['middleware' => ['RedirectDashboard']], function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('store.login');
    });
    Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'publisher', 'as' => 'publisher.'], function () {
        //######################################### Route Dashboard #################################################
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        //######################################### Route users #################################################
        Route::resource('users', UserController::class);
        Route::get('users/update-status/{id}', [UserController::class, 'update_status'])->name('users.update-status');
        //######################################### Route users #################################################
        Route::resource('teams', TeamController::class);
        Route::get('teams/employee/projects/{id}', [TeamController::class, 'employee_projects'])->name('teams.employee_projects');
        Route::delete('teams/delete_member/{id}', [TeamController::class, 'delete_mebmers'])->name('teams.delete_member');
        //######################################### Route roles #################################################
        Route::resource('roles', RoleController::class);
        //######################################### Route Products #################################################
        Route::resource('units', UnitController::class);

        Route::controller(UnitController::class)->group(function () {
            Route::get('units/update_approve/{id}', 'update_approve')->name('units.update_approve');
            Route::get('units/delete_single/{id}', 'delete_single_image')->name('units.delete_single.image');
            Route::get('units/teams/units', 'all_unit_teams')->name('units.all_unit_teams');
            Route::get('unit_active', 'prodcut_active')->name('units.prodcut_active');
            Route::get('unit_inactive', 'prodcut_inactive')->name('units.prodcut_inactive');
            Route::post('units/actions', 'actions')->name('units.actions');
            Route::get('units/for_sale/{id}', 'for_sale')->name('units.for_sale');
        });
        //######################################### Route PricePackageController #################################################
        Route::controller(PackageController::class)->group(function () {
            Route::get('packages/{id}', 'choose_package')->name('package.choose_package');
            Route::post('packages', 'store')->name('packages.store');
            Route::get('my_ads', 'my_ads')->name('my_ads');
        });
        //######################################### Route OrderCOntroller  #################################################
        Route::controller(OrderController::class)->group(function () {
            Route::get('orders', 'index')->name('orders.index');
            Route::post('orders', 'store')->name('orders.store');
        });
        //######################################### Route project #################################################
        Route::resource('projects', ProjectController::class);

        //######################################### Route AdvertisementController #################################################
        Route::controller(AdvertisementController::class)->group(function () {
            Route::get('advertisements', 'index')->name('advertisements.index');
            // Route::post('advertisements', 'store')->name('advertisements.store');
        });
        //######################################### Route notincations #################################################
        Route::post('/notifications/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/readAll', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    });
});
require __DIR__.'/auth.php';
