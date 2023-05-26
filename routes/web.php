<?php

use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PublicController::class, 'showHome'])
    ->name('home');

Route::get('/catalogo', [PublicController::class, 'showCatalog'])
    ->name('catalogo');
//Route::get('/catalogo/categoria/{category_id}', [PublicController::class, 'showCatalogWithCategory'])
//    ->name('catalogo_with_category');
//Route::get('/catalogo/filter', [PublicController::class, 'showCatalogFiltered'])
//    ->name('catalogo_filtered');

Route::get('/aziende', [PublicController::class, 'showCompanies'])
    ->name('aziende');
Route::get('/azienda/{company_id}', [PublicController::class, 'showCompany'])
    ->name('azienda');
Route::get('/categorie', [PublicController::class, 'showCategories'])
    ->name('categories');
Route::view('/where' , 'where' )
    ->name('where');
Route::view('who' , 'who')
    ->name('who');
Route::get('/faq' , [PublicController::class, 'showFaq'])
    ->name('faq');
Route::get('/promozione/{promotion_id}', [PublicController::class, 'showPromotion'])
    ->name('promotion');
Route::post('/acquisisci_coupon', [PublicController::class, 'storeCoupon'])
        ->name('takeCoupon');
Route::get('/coupon/{promotion_id}' , [PublicController::class, 'showCoupon'] )
    ->name('coupon')->middleware('can:isUser');;

Route::view('/aggiungi_promozione', 'add_and_edit_promotion')
    ->name('add_promotion');



Route::get('/account' , [ProfileController::class, 'showUserInfo'] )
    ->name('account');
Route::post('/account' , [ProfileController::class, 'update'] )
    ->name('account');



Route::get('/staff', function (){
    return view('home_staff');
})->name('staff');

Route::get('/admin', function (){
    return view('home_admin');
})->name('admin');


// MANAGEMENT: admin section
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

/*
Route::get('/', [PublicController::class, 'showCatalog1'])
        ->name('catalog1');

Route::get('/selTopCat/{topCatId}', [PublicController::class, 'showCatalog2'])
        ->name('catalog2');

Route::get('/selTopCat/{topCatId}/selCat/{catId}', [PublicController::class, 'showCatalog3'])
        ->name('catalog3');

Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin');

Route::get('/admin/newproduct', [AdminController::class, 'addProduct'])
        ->name('newproduct');

Route::post('/admin/newproduct', [AdminController::class, 'storeProduct'])
        ->name('newproduct.store');

Route::get('/user', [UserController::class, 'index'])
        ->name('user')->middleware('can:isUser');
Route::get('/admin/stats/{promotion_id}', [ManagementController::class, 'showPromotion'])
    ->name('management.promotionStats');


// TESTING
Route::view('/test', 'test')
    ->name('test');
Route::get('/test_get',[TestController::class, 'testGet'])
    ->name('test_get');
Route::post('/test_post',[TestController::class, 'testPost'])
    ->name('test_post');


/*  Rotte aggiunte da Breeze

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

*/
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
