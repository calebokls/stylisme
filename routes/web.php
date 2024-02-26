<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Stylist\VetementController;
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
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Nos Routes
 */

 Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('category',\App\Http\Controllers\admin\CategoryController::class)->except('show');
    Route::resource('primary',\App\Http\Controllers\admin\PrimaryController::class)->except('show');
 });

Route::prefix('style')->name('style.')->group(function(){
    Route::resource('vetement',\App\Http\Controllers\Stylist\VetementController::class)->except('show');
});

require __DIR__.'/auth.php';
