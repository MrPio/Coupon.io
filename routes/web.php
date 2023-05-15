<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
Route::get('/catalogo/{name}', [PublicController::class, 'showCatalogWithName'])
    ->name('catalogo_with_name');
Route::get('/catalogo/categoria/{category_id}', [PublicController::class, 'showCatalogWithCategory'])
    ->name('catalogo_with_category');
Route::get('/catalogo/azienda/{company_id}', [PublicController::class, 'showCatalogWithCompany'])
    ->name('catalogo_with_company');


Route::get('/aziende', [PublicController::class, 'showCompanies'])
    ->name('aziende');
Route::get('/categorie', [PublicController::class, 'showCategories'])
    ->name('categories');
Route::view('/login' ,'auth.login')
    ->name('login');
Route::view('/faq' , 'faq')
    ->name('faq');
Route::view('/where' , 'where' )
    ->name('where');

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


Route::view('/where', 'where')
        ->name('where');

Route::view('/who', 'who')
        ->name('who');
*/
/*  Rotte aggiunte da Breeze

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

*/
require __DIR__ . '/auth.php';
