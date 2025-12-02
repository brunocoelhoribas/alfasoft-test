<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PersonController;
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

Route::get('/', static function () { return redirect()->route('people.index'); });
Route::get('people', [PersonController::class, 'index'])->name('people.index');
Route::get('people/{person}', [PersonController::class, 'show'])->name('people.show');
Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

Route::middleware('auth.basic')->group(function () {
    Route::get('people/create', [PersonController::class, 'create'])->name('people.create');
    Route::post('people', [PersonController::class, 'store'])->name('people.store');
    Route::get('people/{person}/edit', [PersonController::class, 'edit'])->name('people.edit');
    Route::put('people/{person}', [PersonController::class, 'update'])->name('people.update');
    Route::delete('people/{person}', [PersonController::class, 'destroy'])->name('people.destroy');

    Route::get('people/{person}/contacts/create', [ContactController::class, 'create'])->name('people.contacts.create');
    Route::post('people/{person}/contacts', [ContactController::class, 'store'])->name('people.contacts.store');

    Route::get('contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});
