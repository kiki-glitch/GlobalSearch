<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationContoler;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
Route::get('/api/users', [TablesController::class,'index']);
Route::post('/api/users', [TablesController::class,'store']);

Route::put('/api/users/{user}', [TablesController::class,'update']);

Route::get('{view}', ApplicationContoler::class)->where('view','(.*)');