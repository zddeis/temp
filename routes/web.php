<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegistrationController;
use App\Models\Note;
use Illuminate\Support\Facades\Route;

// Nav Links
Route::get('/', function () {
    $pinnedNotes = Note::where('is_pinned', true)
        ->join('users', 'notes.user_id', '=', 'users.id')
        ->select('notes.*', 'users.name as author_name')
        ->get();

    return view('index', [
        "heading" => "Home",
        "pinnedNotes" => $pinnedNotes
    ]);
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Notes
Route::middleware('auth')->group(function () {
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');

    Route::get('/note/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::patch('/note/edit', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/note/edit', [NoteController::class, 'destroy'])->name('notes.destroy');
});

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegistrationController::class, 'create'])->name('register');
    Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
});