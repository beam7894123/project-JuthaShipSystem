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
    Route::post('/containers/create', [ContainerController::class, 'create'])->name('containers.create');
    Route::put('/containers/update/{journey}/{container}', [ContainerController::class, 'update'])->name('containers.update');
    Route::get('/containers/destroy/{container}', [ContainerController::class, 'destroy'])->name('containers.destroy');

    //Document system
    Route::get('/documents/{journey}', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('/documents/store/{journey}', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/edit/{document}', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/update/{journey}/{document}', [DocumentController::class, 'update'])->name('documents.update');
    Route::get('/documents/destroy/{journey}/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    //Journey system
    Route::get('/journeys', [DocumentController::class, 'index'])->name('journeys.index');
    Route::get('/journeys/create', [DocumentController::class, 'create'])->name('journeys.create');
    Route::get('/journeys/view', [DocumentController::class, 'view'])->name('journeys.view');
    Route::get('/journeys/edit', [DocumentController::class, 'edit'])->name('journeys.edit');
    Route::post('/documents/store', [DocumentController::class, 'store'])->name('journeys.store');
    Route::put('/documents/update/{journey}', [DocumentController::class, 'update'])->name('journeys.update');

    //Ship system
    Route::get('/ships', [DocumentController::class, 'index'])->name('ships.index');
    Route::get('/ships/create', [DocumentController::class, 'create'])->name('ships.create');
    Route::get('/ships/view', [DocumentController::class, 'view'])->name('ships.view');
    Route::get('/ships/edit', [DocumentController::class, 'edit'])->name('ships.edit');
    Route::post('/ships/updatePage/{ship}', [DocumentController::class, 'updatePage'])->name('ships.updatePage');
    Route::post('/ships/store', [DocumentController::class, 'store'])->name('ships.store');
    Route::put('/ships/update/{ship}', [DocumentController::class, 'update'])->name('ships.update');
    Route::put('ships/updateStatus/{ship}', [DocumentController::class, 'updateStatus'])->name('ships.updateStatus');
    Route::get('/ships/destroy/{ship}', [DocumentController::class, 'destroy'])->name('ships.destroy');

});

require __DIR__.'/auth.php';
