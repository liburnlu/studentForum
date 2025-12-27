<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
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


Route::controller(ReplyController::class)->group(function () {
    Route::post('/topics/{topic}/replies', 'store')->name('replies.store');
    Route::get('/replies/{reply}/edit', 'edit')->name('replies.edit');
    Route::patch('/replies/{reply}', 'update')->name('replies.update');
    Route::delete('replies/{reply}', 'destroy')->name('replies.destroy');
});


Route::controller(BookmarkController::class)->group(function () {
    Route::get('/bookmarks', 'index')->name('bookmarks.index');
    Route::post('/bookmarks', 'toggle')->name('bookmarks.toggle');
});

Route::controller(TopicController::class)->group(function () {
    Route::get('/topics', 'index')->name('topics.index');
    Route::get('/topics/create', 'create')->name('topics.create');
    Route::post('/topics', 'store')->name('topics.store');
    Route::get('/topics/{topic}/edit', 'edit')->name('topics.edit');
    Route::patch('/topics/{topic}', 'update')->name('topics.update');
    Route::delete('/topics/{topic}', 'destroy')->name('topics.destroy');
    Route::get('/topics/{topic:id}', 'show')->name('topics.show');

});


