<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\City\CityController;
use App\Http\Controllers\Api\News\NewsController;
use App\Http\Controllers\Api\Unit\UnitController;
use App\Http\Controllers\Api\Gate\GatesController;
use App\Http\Controllers\Api\Offer\OfferController;
use App\Http\Controllers\Api\State\StateController;
use App\Http\Controllers\Api\News\TagNewsController;
use App\Http\Controllers\Api\Agency\AgencyController;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;
use App\Http\Controllers\Api\Country\CountryController;
use App\Http\Controllers\Api\Deposit\DepositController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Project\ProjectController;
use App\Http\Controllers\Api\Service\ServiceController;
use App\Http\Controllers\Api\Setting\SettingController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\District\DistrictController;
use App\Http\Controllers\Api\News\CategroyNewsController;
use App\Http\Controllers\Api\Property\PropertyController;
use App\Http\Controllers\Api\WishList\WishListController;
use App\Http\Controllers\Api\Auth\UpdatePasswordController;
use App\Http\Controllers\Api\ContactUs\ContactUsController;
use App\Http\Controllers\Api\Auth\RegisterPublisherController;
use App\Http\Controllers\Api\SettingPage\SettingPageController;
use App\Http\Controllers\Api\Unit\Package\PackageUnitController;
use App\Http\Controllers\Api\Notification\NotificationController;
use App\Http\Controllers\Api\CategoryService\CategoryServiceController;
use App\Http\Controllers\Api\Jobs\JobController;
use App\Http\Controllers\Api\Jobs\JobRegisterController;
use App\Http\Controllers\Api\Land\LandController;
use App\Http\Controllers\Api\ServiceProvided\ServiceProvidedController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/register/publisher', [RegisterPublisherController::class, 'register']);


// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index');
        Route::get('/profile/info_user', 'info_user');
        Route::post('/profile/update', 'update');
    });
    Route::post('/user/update', [UpdatePasswordController::class, 'updatePassword']);
    Route::apiResource('/wishlists', WishListController::class);
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/user/notifications', 'index');
        Route::get('/user/notifications/count', 'unreadNotificationsCount');
        Route::get('/user/notifications/mark_all_asread', 'markAllAsRead');
    });
    //route create unit
    Route::post('/units', [UnitController::class, 'store']);
});

Route::controller(DistrictController::class)->group(function () {
    Route::get('/districts', 'index');
    Route::get('/districts/{id}', 'show');
});
Route::controller(PropertyController::class)->group(function () {
    Route::get('/properties', 'index');
    Route::get('/properties/{id}', 'show');
});


Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index');
    Route::get('/categories/{id}', 'show');
});

// Routes units
Route::controller(UnitController::class)->group(function () {
    Route::get('/units', 'index');
    Route::get('/units/{id}', 'show');
});

Route::controller(SettingPageController::class)->group(function () {
    Route::get('/setting_page/home', 'home');
    Route::get('/setting_page/about', 'about');
    Route::get('/setting_page/vission', 'vission');
    Route::get('/setting_page/mission', 'mission');
    Route::get('/setting_page/our_message', 'our_message');
    Route::get('/setting_page/why_choose_us', 'why_choose_us');
    Route::get('/setting_page/contact_us', 'contact_us');
    Route::get('/setting_page/footer', 'footer');
});
Route::get('setting', [SettingController::class, 'index']);

Route::post('services-provided', [ServiceProvidedController::class, 'store']);
Route::post('contact_us', [ContactUsController::class, 'store']);
// route agency
Route::controller(AgencyController::class)->group(function () {
    Route::get('agency', 'index');
    Route::get('agency/{id}', 'show');
});
Route::controller(GatesController::class)->group(function () {
    Route::get('gates', 'index');
    Route::get('gates/{id}', 'show');
});
Route::controller(CategoryServiceController::class)->group(function () {
    Route::get('category_service', 'index');
    Route::get('category_service/{id}', 'show');
});
Route::controller(ServiceController::class)->group(function () {
    Route::get('services', 'index');
    Route::get('services/{id}', 'show');
});
//#########################################  route offers  #################################################
Route::controller(OfferController::class)->group(function () {
    Route::get('offers', 'index');
    Route::get('offers/{id}', 'show');
});
//#########################################  route lands  #################################################
Route::controller(LandController::class)->group(function () {
    Route::get('lands', 'index');
    Route::get('lands/{id}', 'show');
});
//#########################################  route news  #################################################
Route::controller(NewsController::class)->group(function () {
    Route::get('news', 'index');
    Route::get('news/{id}', 'show');
});
//#########################################  route news  #################################################
Route::controller(CategroyNewsController::class)->group(function () {
    Route::get('category_news', 'index');
    Route::get('category_news/{id}', 'show');
});
//#########################################  route Jobs  #################################################
Route::controller(JobController::class)->group(function () {
    Route::get('jobs', 'index');
    Route::get('jobs/{id}', 'show');
    Route::post('/jobs/{id}/job_register', 'store');
});
// Route::post('/jobs/{id}/job_register', [JobRegisterController::class, 'store']);
//#########################################  route DepositController  #################################################
Route::controller(DepositController::class)->group(function () {
    Route::get('deposit', 'index');
    Route::post('deposit/{id}', 'show');
});

Route::controller(ProjectController::class)->group(function () {
    Route::get('/buildings', 'index');
    Route::get('/buildings/{id}', 'show');
});