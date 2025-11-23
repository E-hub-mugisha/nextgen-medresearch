<?php

use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RescueSheetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/news/detail', [HomeController::class, 'newsDetail'])->name('news.detail');
Route::get('/mentorship_hub', [HomeController::class, 'mentorshipHub'])->name('mentorship');
Route::get('/research_data', [HomeController::class, 'researchData'])->name('research_data');
Route::get('/partners', [HomeController::class, 'partners'])->name('partners');
Route::get('/our-impact', [HomeController::class, 'ourImpact'])->name('our-impact');
Route::get('/rescue/{slug}', [RescueSheetController::class, 'view'])->name('rescue.sheet.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Rescue Sheets CRUD
    Route::get('/rescue-sheets', [RescueSheetController::class, 'index'])->name('rescue.index');
    Route::post('/rescue-sheets', [RescueSheetController::class, 'store'])->name('rescue.store');
    Route::get('/rescue-sheets/{id}/edit', [RescueSheetController::class, 'edit'])->name('rescue.edit');
    Route::put('/rescue-sheets/{id}', [RescueSheetController::class, 'update'])->name('rescue.update');
    Route::delete('/rescue-sheets/{id}', [RescueSheetController::class, 'destroy'])->name('rescue.destroy');

});
require __DIR__.'/auth.php';
