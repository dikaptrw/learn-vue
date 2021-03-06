<?php

use App\Http\Controllers\Notes\NoteController;
use App\Http\Controllers\Notes\SubjectController;
use Illuminate\Support\Facades\Route;


Route::prefix('notes')->group(function() {
    Route::post('create-new-note', [NoteController::class, 'store']);
    Route::get('', [NoteController::class, 'index']);
    Route::get('{note:slug}', [NoteController::class, 'show'])->name('notes.show');
    Route::patch('{note:slug}/update', [NoteController::class, 'update']);
    Route::delete('{note:slug}/delete', [NoteController::class, 'destroy']);
});

Route::prefix('subjects')->group(function() {
    Route::get('', [SubjectController::class, 'index']);
});