<?php

use App\Http\Controllers\ChangeLogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FinancialAssetController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

// Routes trả về view
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Quản lý hồ sơ cá nhân
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Quản lý thành viên gia đình
Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
});

// Quản lý mối quan hệ gia đình
Route::middleware('auth')->group(function () {
    Route::resource('relationships', RelationshipController::class);
});

// Quản lý sự kiện gia đình
Route::middleware('auth')->group(function () {
    Route::resource('events', EventController::class);
});

// Quản lý tài sản tài chính của thành viên
Route::middleware('auth')->group(function () {
    Route::resource('financial-assets', FinancialAssetController::class);
});

// Quản lý thông báo trong hệ thống
Route::middleware('auth')->group(function () {
    Route::resource('notifications', NotificationController::class);
});

// Quản lý bài đăng mạng xã hội gia đình
Route::middleware('auth')->group(function () {
    Route::resource('social-posts', SocialController::class);
});

// Quản lý lịch sử thay đổi
Route::middleware('auth')->group(function () {
    Route::resource('changelogs', ChangeLogController::class);
});

// Routes trả về JSON (API)
Route::prefix('api')->group(function () {
    // API cho thành viên
    Route::get('/members', [MemberController::class, 'getAllMembers'])->name('getAllMembers');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{id}', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');

    // API cho mối quan hệ gia đình
    Route::get('/relationships', [RelationshipController::class, 'getRelationshipData'])->name('getRelationshipData');
    Route::post('/relationships', [RelationshipController::class, 'store'])->name('relationships.store');
    Route::get('/relationships/{id}', [RelationshipController::class, 'edit'])->name('relationships.edit');
    Route::put('/relationships/{id}', [RelationshipController::class, 'update'])->name('relationships.update');
    Route::delete('/relationships/{id}', [RelationshipController::class, 'destroy'])->name('relationships.destroy');

    // API cho sự kiện gia đình
    Route::get('/events', [EventController::class, 'getEventData'])->name('getEventData');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // API cho tài sản tài chính
    Route::get('/financial-assets', [FinancialAssetController::class, 'getAllAssets'])->name('getAllAssets');
    Route::post('/financial-assets', [FinancialAssetController::class, 'store'])->name('financial-assets.store');
    Route::get('/financial-assets/{id}', [FinancialAssetController::class, 'edit'])->name('financial-assets.edit');
    Route::put('/financial-assets/{id}', [FinancialAssetController::class, 'update'])->name('financial-assets.update');
    Route::delete('/financial-assets/{id}', [FinancialAssetController::class, 'destroy'])->name('financial-assets.destroy');

    // API cho thông báo
    Route::get('/notifications', [NotificationController::class, 'getAllNotifications'])->name('getAllNotifications');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::put('/notifications/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // API cho bài đăng trên mạng xã hội gia đình
    Route::get('/social-posts', [SocialController::class, 'getAllPosts'])->name('getAllPosts');
    Route::post('/social-posts', [SocialController::class, 'store'])->name('social-posts.store');
    Route::delete('/social-posts/{id}', [SocialController::class, 'destroy'])->name('social-posts.destroy');

    // API cho lịch sử thay đổi
    Route::get('/changelogs', [ChangeLogController::class, 'getAllChangeLogs'])->name('getAllChangeLogs');
    Route::delete('/changelogs/{id}', [ChangeLogController::class, 'destroy'])->name('changelogs.destroy');
});

require __DIR__ . '/auth.php';
