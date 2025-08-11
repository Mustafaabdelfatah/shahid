<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\Jobs\JobController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Land\LandController;
use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\Team\TeamController;
use App\Http\Controllers\Admin\Unit\UnitController;
use App\Http\Controllers\Admin\user\UserController;
use App\Http\Controllers\Admin\user\AdminController;
use App\Http\Controllers\Admin\Gates\GatesController;
// use App\Http\Controllers\Admin\Product\UnitController;
use App\Http\Controllers\Admin\imageUploadController;
use App\Http\Controllers\Admin\JobRegisterController;
use App\Http\Controllers\Admin\user\AgencyController;
use App\Http\Controllers\Admin\user\BrokerController;
use App\Http\Controllers\Admin\News\TagNewsController;
use App\Http\Controllers\Admin\Offers\OffersController;
use App\Http\Controllers\Admin\Feature\FeatureController;
use App\Http\Controllers\Admin\HomeSettingpageController;
use App\Http\Controllers\Admin\Package\PackageController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Project\ProjectController;
use App\Http\Controllers\Admin\Service\ServiceController;
use App\Http\Controllers\Admin\Unit\PrimumUnitController;
use App\Http\Controllers\Admin\user\UnitOwnersController;
use App\Http\Controllers\Admin\Catgeory\CategoryController;
use App\Http\Controllers\Admin\District\DistrictController;
use App\Http\Controllers\Admin\News\CategroyNewsController;
use App\Http\Controllers\Admin\Property\PropertyController;
use App\Http\Controllers\Admin\WishList\WishListController;
use App\Http\Controllers\Admin\Setting\SettingWebController;
use App\Http\Controllers\Admin\user_view\UserViewController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\Authorizations\RoleController;
use App\Http\Controllers\Admin\Commint\NewsCommintController;
use App\Http\Controllers\Admin\Commint\UnitCommintController;
use App\Http\Controllers\Admin\Unit\UnitInstallmentController;
use App\Http\Controllers\Admin\CategoryJob\CategoryJobController;
use App\Http\Controllers\Admin\Project\ProjectTypeUnitController;
use App\Http\Controllers\Admin\Setting\SettingDashboardController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Project\ProjectInstallmentController;
use App\Http\Controllers\Admin\CategoryService\CategoryServiceController;
use App\Http\Controllers\Admin\ServiceProvided\ServiceProvidedController;
use App\Http\Controllers\Admin\ContactUs\ContactUsController as ContactUsContactUsController;

// use App\Http\Controllers\ChangePasswordController;

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
    Route::group(['middleware' => ['RedirectDashboard'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('store.login');
    });
    Route::group(['middleware' => ['auth:admin', 'web'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        //Route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        //Route Profile
        Route::controller(ProfileController::class)->group(function () {
            Route::post('profile/change-password', 'updatePassword')->name('profile.change_password');
            Route::get('profile/edit', 'edit')->name('profile.edit');
            Route::patch('profile', 'update')->name('profile.update');
        });

        //Route Users
        Route::resource('admins', AdminController::class);
        Route::get('admins/update_status/{id}', [AdminController::class, 'update_status'])->name('admins.update-status');
        Route::post('admins/actions', [AdminController::class, 'actions'])->name('admins.actions');
        Route::get('admins/{admin}/units', [AdminController::class, 'showUnits'])->name('admins.units');

        //######################################### Route roles #################################################
        Route::resource('roles', RoleController::class);
        Route::post('roles.actions', [RoleController::class, 'actions'])->name('roles.actions');
        //######################################### Route Home Setting  #################################################
        Route::controller(HomeSettingpageController::class)->group(function () {
            Route::get('home_pages', 'index')->name('page.index');
            Route::get('home_pages/edit/{id}', 'edit')->name('page.edit');
            Route::put('home_pages/update/{id}', 'update')->name('page.update');
            Route::get('home_pages/update_status/{id}', 'update_status')->name('page.update-status');
        });
        Route::controller(SettingDashboardController::class)->group(function () {
            Route::get('setting_dashboard', 'index')->name('setting.dashboard.index');
            Route::put('setting_dashboard/update/{setting}', 'update')->name('setting.dashboard.update');
        });
        Route::controller(SettingWebController::class)->group(function () {
            Route::get('setting_website', 'index')->name('setting.website.index');
            Route::put('setting_website/update/{setting}', 'update')->name('setting.website.update');
        });
        //#########################################  buildings Controller  #################################################
        Route::controller(ProjectController::class)->group(function () {
            Route::resource('buildings', ProjectController::class);
            Route::get('buildings/{projectId}/type-units/create', [ProjectController::class, 'create'])->name('admin.type-units.create');
            Route::post('buildings/actions', 'actions')->name('buildings.actions');
            Route::get('buildings/update_status/{id}', 'update_status')->name('buildings.update-status');
            Route::get('buildings/delete_sigle/{id}', 'delete_sigle_image')->name('buildings.delete_sigle.image');
            Route::get('deleted/buildings', 'showDeleted')->name('buildings.deleted');
            Route::post('/delete/buildings/restore/{id}', 'restore')->name('buildings.restore');
            Route::delete('delete/buildings/force-delete/{id}', 'forceDelete')->name('buildings.force-delete');
        });
        //#########################################  FinishingTypeController  #################################################
        Route::prefix('buildings_installments')->name('buildings_installments.')->controller(ProjectInstallmentController::class)->group(function () {
            Route::get('/{id}', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/update/{id}', 'destroy')->name('destroy');
        });
        //#########################################  ProjectTypeUnitController  #################################################
        Route::prefix('type-units')->name('type-units.')->controller(ProjectTypeUnitController::class)->group(function () {
            Route::get('/{id}', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/update/{id}', 'destroy')->name('destroy');
        });
        //######################################### Route broker #################################################
        Route::resource('users', UserController::class);
        Route::get('users/update_status/{id}', [UserController::class, 'update_status'])->name('users.update-status');
        Route::post('users/actions', [UserController::class, 'actions'])->name('users.actions');
        Route::get('users/{user}/units', [UserController::class, 'showUnits'])->name('users.units');
        Route::get('users/search', [UserController::class, 'search'])->name('users.search');

        //######################################### Route broker #################################################

        Route::resource('districts', DistrictController::class);
        Route::post('districts/actions', [DistrictController::class, 'actions'])->name('districts.actions');

        //######################################### Gates Route #################################################
        Route::resource('gates', GatesController::class);
        Route::get('gates/update_status/{id}', [GatesController::class, 'update_status'])->name('gates.update-status');
        // Route::post('gates/actions', [GatesController::class, 'actions'])->name('gates.actions');

        //######################################### Route NEWS #################################################
        Route::resource('news', NewsController::class);
        Route::resource('categories_news', CategroyNewsController::class);
        Route::resource('tegs_news', TagNewsController::class);
        Route::post('news/actions', [NewsController::class, 'actions'])->name('news.actions');
        Route::post('categories_news/actions', [CategroyNewsController::class, 'actions'])->name('categories_news.actions');
        Route::post('tegs_news/actions', [TagNewsController::class, 'actions'])->name('tegs_news.actions');

        //######################################### Route categories #################################################
        Route::controller(CategoryController::class)->group(function () {
            Route::resource('categories', CategoryController::class);
            Route::get('categories/update_status/{id}', 'update_status')->name('categories.update-status');
            Route::post('categories/actions', 'actions')->name('categories.actions');
            Route::get('categories/edit/{id}', 'edit')->name('categories.edit');
            Route::get('deleted/categories', 'showDeleted')->name('categories.deleted');
            Route::post('/delete/categories/restore/{id}', 'restore')->name('categories.restore');
            Route::delete('delete/categories/force-delete/{id}', 'forceDelete')->name('categories.force-delete');
        });
        //######################################### Route Prodcuts #################################################
        Route::controller(UnitController::class)->group(function () {
            Route::resource('units', UnitController::class);
            Route::post('units/rejected', 'rejected')->name('product.rejected');
            Route::post('units/actions', 'actions')->name('units.actions');
            Route::get('units/for_sale/{id}', 'for_sale')->name('units.for_sale');
            Route::get('units/edit/{id}', 'edit')->name('units.edit');
            Route::get('units/update_status/{id}', 'update_status')->name('units.update-status');
            Route::get('units/delete_sigle/{id}', 'delete_sigle_image')->name('units.delete_sigle.image');
            Route::get('active_product', 'active_product')->name('units.prodcut_active');
            Route::get('inactiv_product', 'in_active_product')->name('units.prodcut_inactive');
            Route::get('deleted/units', 'showDeleted')->name('units.deleted');
            Route::post('/delete/units/restore/{id}', 'restore')->name('units.restore');
            Route::delete('delete/units/force-delete/{id}', 'forceDelete')->name('units.force-delete');
        });

        //######################################### primum units #################################################
        Route::get('primum', [PrimumUnitController::class, 'index'])->name('units.primum.index');
        Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('password.change');
        Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('password.update');

        //#########################################  properties  #################################################
        Route::resource('properties', PropertyController::class);
        Route::get('properties/update_status/{id}', [PropertyController::class, 'update_status'])->name('properties.update-status');
        Route::post('properties.actions', [PropertyController::class, 'actions'])->name('properties.actions');

        //#########################################  teams  #################################################
        Route::resource('teams', TeamController::class);
        Route::delete('teams/delete_member/{id}', [TeamController::class, 'delete_mebmers'])->name('teams.delete_member');

        //#########################################  wish list  #################################################
        Route::resource('wish-list', WishListController::class);

        //#########################################  View  #################################################
        Route::resource('user_view', UserViewController::class);

        //#########################################  View  #################################################
        Route::resource('unit-commint', UnitCommintController::class);
        Route::get('unit-commint/delete_data/{id}', [UnitCommintController::class, 'delete_data'])->name('unit-commint.delete_data');

        //#########################################  View  #################################################
        Route::resource('news-commint', NewsCommintController::class);
        Route::get('news-commint/delete_data/{id}', [NewsCommintController::class, 'delete_data'])->name('news-commint.delete_data');

        //#########################################  package  #################################################
        Route::resource('packages', PackageController::class);
        Route::get('packages/delete_data/{id}', [PackageController::class, 'delete_data'])->name('packages.delete_data');

        //#########################################  offers  #################################################
        Route::resource('offers', OffersController::class);
        Route::get('offers/update_status/{id}', [OffersController::class, 'update_status'])->name('offers.update-status');
        Route::post('offers/actions', [OffersController::class, 'actions'])->name('offers.actions');
        //#########################################  Lands  #################################################
        Route::resource('lands', LandController::class);
        Route::get('lands/update_status/{id}', [LandController::class, 'update_status'])->name('lands.update-status');
        Route::post('lands/actions', [LandController::class, 'actions'])->name('lands.actions');

        //#########################################  package  #################################################
        Route::resource('service_providers', ServiceProvidedController::class);
        Route::resource('contacts', ContactUsContactUsController::class);

        //#########################################  popular  #################################################
        Route::controller(BrokerController::class)->group(function () {
            Route::get('brokers', 'index')->name('brokers.index');
            Route::get('brokers/{id}/show', 'show')->name('brokers.show');
        });

        //#########################################  agency  #################################################
        Route::controller(AgencyController::class)->group(function () {
            Route::get('agency', 'index')->name('agency.index');
            Route::get('agency/{id}/show', 'show')->name('agency.show');
        });

        //#########################################  UnitOwners  #################################################
        Route::controller(UnitOwnersController::class)->group(function () {
            Route::get('unit_owners', 'index')->name('unit_owners.index');
            Route::get('unit_owners/{id}/show', 'show')->name('unit_owners.show');
        });

        //#########################################  Category-Service  #################################################
        Route::resource('category_service', CategoryServiceController::class);

        Route::resource('jobs', JobController::class);
        Route::prefix('jobs-register')->name('jobs-register.')->controller(JobRegisterController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::delete('/delete{id}', 'destroy')->name('delete');
        });

        //#########################################  Category-Job  #################################################
        Route::controller(CategoryJobController::class)->group(function () {
            Route::resource('category_job', CategoryJobController::class);
            Route::get('deleted/category_job', 'showDeleted')->name('category_job.deleted');
            Route::post('/delete/category_job/restore/{id}', 'restore')->name('category_job.restore');
            Route::delete('delete/category_job/force-delete/{id}', 'forceDelete')->name('category_job.force-delete');
        });

        //#########################################  services  #################################################
        Route::controller(ServiceController::class)->group(function () {
            Route::resource('services', ServiceController::class);
            Route::get('services/update_status/{id}', 'update_status')->name('services.update-status');
            Route::get('services/delete_sigle/{id}', 'delete_sigle_image')->name('services.delete_sigle.image');
        });
        //#########################################  FeatureController  #################################################
        Route::controller(FeatureController::class)->group(function () {
            Route::resource('features', FeatureController::class);
        });
        //#########################################  UnitInstallmentController  #################################################

        Route::prefix('unit-installments')->name('unit-installments.')->controller(UnitInstallmentController::class)->group(function () {
            Route::get('/{id}', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/update/{id}', 'destroy')->name('destroy');
        });
    });
    Route::post('/admin/upload', [imageUploadController::class, 'upload'])->name('admin.upload');
});
