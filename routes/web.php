<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/', function () {
    return view('splash');
})->middleware('guest')->name('splash');


Route::controller(AdminDashboardController::class)->group(function () {
    Route::get('/admin', 'index')->middleware(['auth', 'verified'])->name('admin');
});


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

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/dashboard/topics', 'topics')->middleware(['auth', 'verified'])->name('dashboard.topics');
    Route::get('/dashboard/replies', 'replies')->middleware(['auth', 'verified'])->name('dashboard.replies');
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

Route::controller(CategoryController::class)->group(function () {
    Route::get('/admin/categories', 'index')->middleware(['auth', 'verified'])->name('admin.categories.index');
    Route::get('/admin/categories/create', 'create')->middleware(['auth', 'verified'])->name('admin.categories.create');
    Route::post('/admin/categories', 'store')->middleware(['auth', 'verified'])->name('admin.categories.store');
    Route::get('/admin/categories/{category:id}/edit', 'edit')->middleware(['auth', 'verified'])->name('admin.categories.edit');
    Route::patch('/admin/categories/{category}', 'update')->middleware(['auth', 'verified'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', 'destroy')->middleware(['auth', 'verified'])->name('admin.categories.destroy');
    Route::get('/admin/categories/{category}', 'show')->middleware(['auth', 'verified'])->name('admin.categories.show');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/admin/users', 'index')->middleware(['auth', 'verified'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', 'edit')->middleware(['auth', 'verified'])->name('admin.users.edit');
    Route::patch('admin/users/{user}', 'update')->middleware(['auth', 'verified'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', 'destroy')->middleware(['auth', 'verified'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}', 'show')->middleware(['auth', 'verified'])->name('admin.users.show');
});


