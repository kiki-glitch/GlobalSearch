<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationContoler;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TablesController;
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


// Route::get('/', function () {
//     return view('login');
// })->name('login');
Route::get('/', LoginController::class)->name('log');
Route::post('/login', [LoginController::class,'store'])->name('login');

Route::get('/register', RegisterController::class);
Route::post('/register', [RegisterController::class,'store'])->name('register');

Route::get('/logout', LogoutController::class)->name('logout');



// Route::get('/register', function () {
//     return view('register');
// })->name('register');

Route::get('/api/users', [TablesController::class,'index']);
Route::post('/api/users', [TablesController::class,'store']);

Route::put('/api/users/{user}', [TablesController::class,'update']);
Route::delete('/api/users/{user}', [TablesController::class,'destroy']);


Route::get('/api/search', [TablesController::class,'search']);

Route::get('{view}', ApplicationContoler::class)->where('view','(.*)');

// Route::get('/login', LoginController::class,'login');
