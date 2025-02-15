<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelationshipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class)->except(['show']);
    Route::get('/member/{id}', [MemberController::class, 'edit'])->name('members.edit');
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::put('members/{id}', [MemberController::class, 'update'])->name('members.update');
});

Route::get('/relationships', [RelationshipController::class, 'index'])->name('relationships.index');
Route::get('/api/relationships', [RelationshipController::class, 'getRelationshipData'])->name('getRelationshipData');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/api/events', [EventController::class, 'getEventData'])->name('getEventData');

require __DIR__ . '/auth.php';
