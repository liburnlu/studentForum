<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('splash');
})->middleware('guest')->name('splash');

Route::get('/contact' , [ContactController::class, 'index'])->name('contact');
Route::post('/contact' , [ContactController::class, 'store'])->name('contact.store');


Route::middleware('auth')->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});


Route::middleware('auth')->group(function () {
    Route::controller(TopicController::class)->group(function () {

        Route::get('/topics/create', 'create')->name('topics.create');
        Route::post('/topics', 'store')->name('topics.store');
        Route::get('/topics/{topic}/edit', 'edit')->name('topics.edit');
        Route::patch('/topics/{topic}', 'update')->name('topics.update');
        Route::delete('/topics/{topic}', 'destroy')->name('topics.destroy');
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
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/dashboard/topics', 'topics')->name('dashboard.topics');
        Route::get('/dashboard/replies', 'replies')->name('dashboard.replies');
    });


});

Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');
Route::get('/topics/{topic:id}', [TopicController::class, 'show'])->name('topics.show');


Route::middleware(['auth', 'can:view-admin-panel'])->group(function () {

    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/categories', 'index')->name('admin.categories.index');
        Route::get('/admin/categories/create', 'create')->name('admin.categories.create');
        Route::post('/admin/categories', 'store')->name('admin.categories.store');
        Route::get('/admin/categories/{category:id}/edit', 'edit')->name('admin.categories.edit');
        Route::patch('/admin/categories/{category}', 'update')->name('admin.categories.update');
        Route::delete('/admin/categories/{category}', 'destroy')->name('admin.categories.destroy');
        Route::get('/admin/categories/{category}', 'show')->name('admin.categories.show');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'index')->name('admin.users.index');
        Route::get('/admin/users/{user}/edit', 'edit')->name('admin.users.edit');
        Route::patch('admin/users/{user}', 'update')->name('admin.users.update');
        Route::delete('/admin/users/{user}', 'destroy')->name('admin.users.destroy');
        Route::get('/admin/users/{user}', 'show')->name('admin.users.show');
    });
});


require __DIR__ . '/auth.php';



