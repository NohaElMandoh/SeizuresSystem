<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index'); 

Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create'); 
Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store'); 
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit'); 
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update'); 
Route::get('/user/get_user', [App\Http\Controllers\UserController::class, 'get_user'])->name('user.get_user'); 
Route::get('/user/merchants', [App\Http\Controllers\UserController::class, 'merchants'])->name('user.merchants'); 



Route::get('/governorate', [App\Http\Controllers\GovernorateController::class, 'index'])->name('governorate.index'); 
Route::get('/governorate/create', [App\Http\Controllers\GovernorateController::class, 'create'])->name('governorate.create'); 
Route::post('/governorate/store', [App\Http\Controllers\GovernorateController::class, 'store'])->name('governorate.store'); 
Route::get('/governorate/edit/{id}', [App\Http\Controllers\GovernorateController::class, 'edit'])->name('governorate.edit'); 
Route::post('/governorate/update', [App\Http\Controllers\GovernorateController::class, 'update'])->name('governorate.update'); 



Route::get('/city', [App\Http\Controllers\CityController::class, 'index'])->name('city.index'); 
Route::get('/city/create', [App\Http\Controllers\CityController::class, 'create'])->name('city.create'); 
Route::post('/city/store', [App\Http\Controllers\CityController::class, 'store'])->name('city.store'); 
Route::get('/city/edit/{id}', [App\Http\Controllers\CityController::class, 'edit'])->name('city.edit'); 
Route::post('/city/update', [App\Http\Controllers\CityController::class, 'update'])->name('city.update'); 
Route::get('/city/get_cities', [App\Http\Controllers\CityController::class, 'get_cities'])->name('city.get_cities'); 



Route::get('/merchant', [App\Http\Controllers\MerchantController::class, 'index'])->name('merchant.index'); 
Route::get('/merchant/create', [App\Http\Controllers\MerchantController::class, 'create'])->name('merchant.create'); 
Route::post('/merchant/store', [App\Http\Controllers\MerchantController::class, 'store'])->name('merchant.store'); 
Route::get('/merchant/edit/{id}', [App\Http\Controllers\MerchantController::class, 'edit'])->name('merchant.edit'); 
Route::post('/merchant/update', [App\Http\Controllers\MerchantController::class, 'update'])->name('merchant.update'); 
Route::get('/merchant/get_merchant', [App\Http\Controllers\MerchantController::class, 'get_merchant'])->name('merchant.get_merchant'); 
Route::get('/merchant/causes', [App\Http\Controllers\MerchantController::class, 'causes'])->name('merchant.causes'); 

Route::get('/cause', [App\Http\Controllers\CauseController::class, 'index'])->name('cause.index'); 
Route::get('/cause/create', [App\Http\Controllers\CauseController::class, 'create'])->name('cause.create'); 
Route::post('/cause/store', [App\Http\Controllers\CauseController::class, 'store'])->name('cause.store'); 
Route::get('/cause/edit/{id}', [App\Http\Controllers\CauseController::class, 'edit'])->name('cause.edit'); 
Route::post('/cause/update', [App\Http\Controllers\CauseController::class, 'update'])->name('cause.update'); 
Route::get('/cause/get_cause', [App\Http\Controllers\CauseController::class, 'get_cause'])->name('city.get_cause'); 
Route::get('/cause/seizure', [App\Http\Controllers\CauseController::class, 'seizure'])->name('cause.seizure'); 




Route::get('seizure', [App\Http\Controllers\SeizureController::class, 'index'])->name('seizure.index'); 
Route::get('seizure/create', [App\Http\Controllers\SeizureController::class, 'create'])->name('seizure.create'); 
Route::post('seizure/store', [App\Http\Controllers\SeizureController::class, 'store'])->name('seizure.store'); 
Route::get('seizure/edit/{id}', [App\Http\Controllers\SeizureController::class, 'edit'])->name('seizure.edit'); 
Route::post('seizure/update', [App\Http\Controllers\SeizureController::class, 'update'])->name('seizure.update'); 


Route::get('/fines', [App\Http\Controllers\FinesController::class, 'index'])->name('fines.index'); 
Route::get('/fines/create', [App\Http\Controllers\FinesController::class, 'create'])->name('fines.create'); 
Route::post('/fines/store', [App\Http\Controllers\FinesController::class, 'store'])->name('fines.store'); 
Route::get('/fines/edit/{id}', [App\Http\Controllers\FinesController::class, 'edit'])->name('fines.edit'); 
Route::post('/fines/update', [App\Http\Controllers\FinesController::class, 'update'])->name('fines.update'); 


