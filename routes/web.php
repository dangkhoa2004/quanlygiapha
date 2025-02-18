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

Route::get('/trang-chu', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('trang-chu');

// Quản lý hồ sơ cá nhân
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Quản lý thành viên gia đình
Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
    Route::get('/quan-ly-thanh-vien', [MemberController::class, 'index'])->name('quan-ly-thanh-vien');
});

// Quản lý mối quan hệ gia đình
Route::middleware('auth')->group(function () {
    Route::resource('relationships', RelationshipController::class);
    Route::get('/cay-pha-he', [RelationshipController::class, 'panzoom'])->name('cay-pha-he');
    Route::get('/quan-ly-moi-quan-he', [RelationshipController::class, 'index'])->name('quan-ly-moi-quan-he');
});

// Quản lý sự kiện gia đình
Route::middleware('auth')->group(function () {
    Route::resource('events', EventController::class);
});

// Quản lý tài sản tài chính của thành viên
Route::middleware('auth')->group(function () {
    Route::resource('financial-assets', FinancialAssetController::class);
    Route::get('/quan-ly-tai-chinh', [FinancialAssetController::class, 'index'])->name('quan-ly-tai-chinh');
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

// =============================
// ========== API ==============
// =============================

Route::prefix('api')->group(function () {
    // API cho thành viên (Đổi tên route để tránh xung đột)
    Route::post('/members', [MemberController::class, 'store'])->name('api.members.store');
    Route::get('/members/{id}', [MemberController::class, 'edit'])->name('api.members.edit');
    Route::put('/members/{id}', [MemberController::class, 'update'])->name('api.members.update');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('api.members.destroy');

    // API cho mối quan hệ gia đình
    Route::get('/relationships', [RelationshipController::class, 'getRelationshipData'])->name('api.relationships.getData');
    Route::post('/relationships', [RelationshipController::class, 'store'])->name('api.relationships.store');
    Route::get('/relationships/{id}', [RelationshipController::class, 'edit'])->name('api.relationships.edit');
    Route::put('/relationships/{id}', [RelationshipController::class, 'update'])->name('api.relationships.update');
    Route::delete('/relationships/{id}', [RelationshipController::class, 'destroy'])->name('api.relationships.destroy');

    // API cho sự kiện gia đình
    Route::get('/events', [EventController::class, 'getEventData'])->name('api.events.getData');
    Route::post('/events', [EventController::class, 'store'])->name('api.events.store');
    Route::get('/events/{id}', [EventController::class, 'edit'])->name('api.events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('api.events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('api.events.destroy');

    // API cho tài sản tài chính
    Route::get('/financial-assets', [FinancialAssetController::class, 'getAllAssets'])->name('api.financial-assets.getData');
    Route::post('/financial-assets', [FinancialAssetController::class, 'store'])->name('api.financial-assets.store');
    Route::get('/financial-assets/{id}', [FinancialAssetController::class, 'edit'])->name('api.financial-assets.edit');
    Route::put('/financial-assets/{id}', [FinancialAssetController::class, 'update'])->name('api.financial-assets.update');
    Route::delete('/financial-assets/{id}', [FinancialAssetController::class, 'destroy'])->name('api.financial-assets.destroy');

    // API cho thông báo
    Route::get('/notifications', [NotificationController::class, 'getAllNotifications'])->name('api.notifications.getData');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('api.notifications.store');
    Route::put('/notifications/{id}', [NotificationController::class, 'markAsRead'])->name('api.notifications.markAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('api.notifications.destroy');

    // API cho bài đăng trên mạng xã hội gia đình
    Route::get('/social-posts', [SocialController::class, 'getAllPosts'])->name('api.social-posts.getData');
    Route::post('/social-posts', [SocialController::class, 'store'])->name('api.social-posts.store');
    Route::delete('/social-posts/{id}', [SocialController::class, 'destroy'])->name('api.social-posts.destroy');

    // API cho lịch sử thay đổi
    Route::get('/changelogs', [ChangeLogController::class, 'getAllChangeLogs'])->name('api.changelogs.getData');
    Route::delete('/changelogs/{id}', [ChangeLogController::class, 'destroy'])->name('api.changelogs.destroy');
});

require __DIR__ . '/auth.php';
