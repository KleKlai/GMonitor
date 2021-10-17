<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\PasswordController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', 'login');

Route::get('/dashboard', [ClassroomController::class, 'index'])->name('dashboard');
Route::get('/profile/update', [PasswordController::class, 'index'])->name('profile.password');
Route::post('/profile/update', [PasswordController::class, 'store'])->name('profile.password.update');
Route::resource('/classroom', ClassroomController::class);

//For Testing
Route::get('/test/{code}', [ClassroomController::class, 'join']);

require __DIR__.'/auth.php';
