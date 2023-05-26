<?php

use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ALL -- section
Route::get('/', [PublicController::class, 'showHome'])
    ->name('home');
Route::get('/aziende', [PublicController::class, 'showCompanies'])
    ->name('aziende');
Route::get('/azienda/{company_id}', [PublicController::class, 'showCompany'])
    ->name('azienda');
Route::get('/categorie', [PublicController::class, 'showCategories'])
    ->name('categories');
Route::view('/where', 'where')
    ->name('where');
Route::view('who', 'who')
    ->name('who');
Route::get('/faq', [PublicController::class, 'showFaq'])
    ->name('faq');
Route::post('/acquisisci_coupon', [PublicController::class, 'storeCoupon'])
    ->name('takeCoupon');

//Route::view('/aggiungi_promozione', 'add_and_edit_promotion')
//    ->name('add_promotion');

Route::resource('promozioni', PromotionController::class)->only([
    'index', 'show'
]);

Route::get('/account', [ProfileController::class, 'showUserInfo'])
    ->name('account');
Route::post('/account', [ProfileController::class, 'update'])
    ->name('account');


//USER only -- section
Route::middleware('can:isUser')->group(function () {
    Route::get('/coupon/{promotion_id}', [PublicController::class, 'showCoupon'])
        ->name('coupon');
});

//STAFF only -- section
Route::middleware('can:isStaff')->group(function () {
    Route::get('/staff/aggiungi_promozione', [ManagementController::class, 'showCompanyStaff'])
        ->name('add.promotion');
});

//ADMIN only -- section
Route::middleware('can:isAdmin')->group(function () {
    Route::get('/admin/aziende', [ManagementController::class, 'showCompanies'])
        ->name('management.companies');
    Route::get('/admin/staff', [ManagementController::class, 'showStaff'])
        ->name('management.staff');
    Route::get('/admin/users', [ManagementController::class, 'showUsers'])
        ->name('management.users');
    Route::get('/admin/stats', [ManagementController::class, 'showCoupons'])
        ->name('management.stats');
    Route::get('/admin/stats/{promotion_id}', [ManagementController::class, 'showPromotion'])
        ->name('management.promotionStats');
    Route::post('/aziende/{id}/rimuovi', [ManagementController::class, 'deleteCompany'])->name('company.delete');
    Route::post('/staff/{id}/rimuovi', [ManagementController::class, 'deleteStaff'])->name('staff.delete');
    Route::post('/utenti/{id}/rimuovi', [ManagementController::class, 'deleteUser'])->name('user.delete');

});


// TESTING
Route::view('/test', 'test')
    ->name('test');
Route::get('/test_get', [TestController::class, 'testGet'])
    ->name('test_get');
Route::post('/test_post', [TestController::class, 'testPost'])
    ->name('test_post');

require __DIR__ . '/auth.php';

/*
<?php

use App\Http\Controllers\ProfileController;
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


Route::get('/', function () {
    return view('public');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';

*/
