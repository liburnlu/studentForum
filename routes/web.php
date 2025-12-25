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

require __DIR__.'/auth.php';

Route::get('/topics' , [TopicController::class, 'index'])->name('topics.index');
Route::get('/topics/create' , [TopicController::class, 'create'])->name('topics.create');
Route::post('/topics' , [TopicController::class, 'store'])->name('topics.store');
Route::get('/topics/{topic}/edit' , [TopicController::class, 'edit'])->name('topics.edit');
Route::patch('/topics/{topic}' , [TopicController::class, 'update'])->name('topics.update');
Route::delete('/topics/{topic}' , [TopicController::class, 'destroy'])->name('topics.destroy');
Route::get('/topics/{topic:id}' , [TopicController::class, 'show'])->name('topics.show');

