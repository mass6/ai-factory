<?php

use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ProfileController;
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

Route::view('/completions/create', 'completions.create');
Route::post('/completions', [\App\Http\Controllers\CompletionsController::class, 'store'])->name('completions.store');
Route::view('/drag-and-drop', 'drag-and-drop');
Route::get('/images', [ImagesController::class, 'index'])->name('images.index');
Route::get('/images/create', [ImagesController::class, 'create'])->name('images.create');
Route::post('/images', [ImagesController::class, 'store'])->name('images.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
