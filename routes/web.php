<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikesController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Ideas Routes

Route::get('/idea/{idea}', [IdeaController::class, 'show'])->name('idea.show');

Route::get('/idea/{idea}/edit', [IdeaController::class, 'edit'])->name('idea.edit')->middleware('auth');

Route::put('/idea/{idea}', [IdeaController::class, 'update'])->name('idea.update')->middleware('auth');

Route::post('/idea', [IdeaController::class, 'store'])->name('idea.store')->middleware('auth');

Route::delete('/idea/{idea}', [IdeaController::class, 'destroy'])->name('idea.destroy')->middleware('auth');

// Comments Routes

Route::post('/ideas/{idea}/comments', [CommentController::class, 'store'])->name('ideas.comments.store');

// Auth Routes

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Profile Routes

Route::resource('users', UserController::class)->only(['show']);
Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware('auth');

Route::get('/profile', [UserController::class, 'profile'])->name('users.profile')->middleware('auth');

// follower controller

Route::post('/users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow')->middleware('auth');

Route::post('/users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

// Likes controller

Route::post('/idea/{idea}/like', [LikesController::class, 'like'])->name('idea.like')->middleware('auth');

Route::post('/idea/{idea}/unlike', [LikesController::class, 'unlike'])->name('idea.unlike')->middleware('auth');

Route::get('/feed', FeedController::class)->name('feed')->middleware('auth');

Route::view('/terms', 'terms')->name('terms');
