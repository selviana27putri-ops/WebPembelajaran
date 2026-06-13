<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\NilaiController;
use Illuminate\Support\Facades\Artisan;

Route::get('/setup-db', function () {
    Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
    return 'Database migrated and seeded successfully! You can now login with admin@eduspace.com / password';
});

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/materi/{id}', [PublicController::class, 'show'])->name('materi.show');
Route::post('/materi/{id}/submit', [PublicController::class, 'submitQuiz'])->name('materi.submit');
Route::get('/riwayat-nilai', [PublicController::class, 'riwayat'])->name('riwayat');

// Admin Routes - dilindungi middleware auth
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [MateriController::class, 'index'])->name('dashboard');
    Route::resource('materi', MateriController::class);
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
});

// Alias for Breeze redirection
Route::get('/dashboard', function() {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// Alias jika user klik /admin-login di footer
Route::get('/admin-login', function() {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';
