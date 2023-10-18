<?php

use App\Http\Controllers\ContainerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
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

    //Containers system
    Route::get('/containers', [ContainerController::class, 'index'])->name('containers.index');
    Route::get('/containers/create', [ContainerController::class, 'create'])->name('containers.create');
    Route::put('/containers/update/{journey}/{container}', [ContainerController::class, 'update'])->name('containers.update');

    //Document system
    Route::get('/documents/{journey}', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/store/{journey}', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/edit/{document}', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/update/{journey}/{documents}', [DocumentController::class, 'update'])->name('documents.update');
    Route::get('/documents/destroy/{journey}/{documents}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    //Journey system


});

require __DIR__.'/auth.php';
