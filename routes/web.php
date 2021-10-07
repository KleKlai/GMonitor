<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;

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

Route::get('/dashboard', [ClassroomController::class, 'index'])->name('dashboard');

Route::resource('/classroom', ClassroomController::class);

Route::get('/test/{code}', [ClassroomController::class, 'join']);
require __DIR__.'/auth.php';
