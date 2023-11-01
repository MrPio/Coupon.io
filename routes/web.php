<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;


//ALL -- section
Route::get('/', [HomeController::class, 'showHome'])
    ->name('home');
Route::get('/categorie', [PublicController::class, 'showCategories'])
    ->name('categories');
Route::view('/where', 'where')
    ->name('where');
Route::view('who', 'who')
    ->name('who');
Route::post('/acquisisci_coupon', [PublicController::class, 'storeCoupon'])
    ->name('takeCoupon');

//NON PUBLIC -- section
Route::middleware('auth')->group(function () {
    Route::get('/account', [ProfileController::class, 'showUserInfo'])
        ->name('account');
    Route::post('/account', [ProfileController::class, 'updateUser'])
        ->name('account');
    Route::post('/account/photo', [ProfileController::class, 'updatePhoto'])
        ->name('account.photo');
    Route::post('/account/password', [PasswordController::class, 'update'])
        ->name('change_password');
});

//USER only -- section
Route::middleware('can:isUser')->group(function () {
    Route::get('/coupon/{promotion_id}', [PublicController::class, 'showCoupon'])
        ->name('coupon');
});

//STAFF only -- section
Route::middleware('can:isStaff')->group(function () {
    Route::resource('promozioni', PromotionController::class)->only([
        'create', 'store', 'edit', 'update', 'destroy',
    ]);
    Route::post('/promozioni_abbinate/seleziona_id_azienda', [PromotionController::class, 'getSelectablePromotions'])->name('coupled_promotions.select_company_id');
});

Route::resource('promozioni', PromotionController::class)->only([
    'index', 'show'
]);

//ADMIN only -- section
Route::middleware('can:isAdmin')->group(function () {
    Route::get('/admin/staff', [ManagementController::class, 'showStaff'])
        ->name('management.staff');
    Route::get('/admin/users', [ManagementController::class, 'showUsers'])
        ->name('management.users');
    Route::get('/admin/stats', [ManagementController::class, 'showCoupons'])
        ->name('management.stats');
    Route::get('/admin/stats/{promotion_id}', [ManagementController::class, 'showPromotion'])
        ->name('management.promotionStats');
    Route::post('/utenti/{id}/rimuovi', [ManagementController::class, 'deleteUser'])->name('user.delete');
    Route::resource('aziende', CompanyController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('faqs', FaqController::class)->only([
        'create', 'edit', 'destroy', 'store', 'update'
    ]);
    Route::resource('staff', StaffController::class)
        ->only(['create', 'store', 'update', 'destroy', 'edit']);
});

Route::resource('faqs', FaqController::class)->only(['index']);
Route::resource('aziende', CompanyController::class)
    ->only(['index', 'show']);


// TESTING
/*Route::view('/test', 'test')
    ->name('test');
Route::get('/test_get', [TestController::class, 'testGet'])
    ->name('test_get');
Route::post('/test_post', [TestController::class, 'testPost'])
    ->name('test_post');*/

require __DIR__ . '/auth.php';
