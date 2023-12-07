<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HeaderController;

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
//     return view('Brosys');
// });
Route::get('/', [FrontEndController::class, 'index']);


Route::get('/admin/site/login', [AuthController::class, 'index'])->name('login');
Route::post('/admin/site/login/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin', 'auth:web', 'PreventBack'])->prefix('/admin')->group(function (){
    Route::resource('/event', EventController::class);
    Route::resource('/header', HeaderController::class);
});

// Route::get('/brosys', function () {
//     return view('brosys');
// });
