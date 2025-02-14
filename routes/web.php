<?php

use App\Http\Controllers\ProfileController;
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

use App\Http\Controllers\MemberController;

Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
});


use App\Http\Controllers\RelationshipController;

Route::get('/relationships', [RelationshipController::class, 'index'])->name('relationships.index');
Route::get('/api/relationships', [RelationshipController::class, 'getRelationshipData'])->name('getRelationshipData');

use App\Http\Controllers\EventController;

Route::get('/events', [EventController::class, 'index'])->name('events.index');;
Route::get('/api/events', [EventController::class, 'getEventData'])->name('getEventData');

require __DIR__ . '/auth.php';
