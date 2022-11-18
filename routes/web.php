<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routing ke User Controller
Route::get('/user', [UserController::class, 'index'])->name('showUser');
Route::get('/userRegistration', [UserController::class, 'create'])->name('registerUser');
Route::post('/userStore',[UserController::class, 'store']);
Route::get('/userView/{user}',[UserController::class, 'show']);

Route::get('/getAllUsers', [UserController::class,
'getAllUsers'])->middleware(['auth', 'verified']);

// Routing ke CollectionController
Route::get('/koleksi',[CollectionController::class, 'index'])->name('showKoleksi');
Route::get('/koleksiTambah',[CollectionController::class, 'create'])->name('tambahKoleksi');
Route::post('/koleksiStore',[CollectionController::class, 'store']);
Route::get('/koleksiView/{collection}',[CollectionController::class, 'show']);

Route::get('/getAllCollections', [CollectionController::class,
'getAllCollections'])->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
