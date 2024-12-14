<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\GenereController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [RoleController::class, 'admin'])
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [RoleController::class, 'user'])
        ->name('user.dashboard');
});

Route::get('/dashboard', [ImageController::class,'myImages'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('change',[LanguageController::class,'change'])->name('setlang');
    Route::get('/uploadimages',[ImageController::class,'index'])->name('upload.images');
    Route::patch('/uploadimages',[ImageController::class,'store'])->name('store.image');
    Route::get('detail/{image_id}',[ImageController::class,'detail'])->name('detail.image');
    Route::get('/upload', [GenereController::class, 'show'])->name('upload.form');
    Route::get('/myBooks', [BookController::class, 'index'])->name('myBooks');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/image/{image_id}', [ImageController::class, 'show'])->name('detail.image');
    Route::patch('/comments', [CommentController::class, 'store'])->name('store.comment');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('delete.comment');
});

require __DIR__.'/auth.php';
