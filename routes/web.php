<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('splash');
})->name('splash');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::controller(TopicController::class)->group(function () {
    Route::get('/topics', 'index')->name('topics.index');
    Route::get('/topics/create', 'create')->name('topics.create');
    Route::post('/topics', 'store')->name('topics.store');
    Route::get('/topics/{topic}/edit', 'edit')->name('topics.edit');
    Route::patch('/topics/{topic}', 'update')->name('topics.update');
    Route::delete('/topics/{topic}', 'destroy')->name('topics.destroy');
    Route::get('/topics/{topic:id}', 'show')->name('topics.show');

});


