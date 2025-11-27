<?php

use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MentorQnAController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RescueSheetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/news/detail/{slug}', [HomeController::class, 'newsDetail'])->name('news.detail');
Route::get('/mentorship_hub', [HomeController::class, 'mentorshipHub'])->name('mentorship');
Route::get('/research_data', [HomeController::class, 'researchData'])->name('research_data');
Route::get('/capacity_building', [HomeController::class, 'capacityBuilding'])->name('capacity_building');
Route::get('/innovation_projects', [HomeController::class, 'innovationProjects'])->name('innovation_projects');
Route::get('/partners', [HomeController::class, 'partners'])->name('partners');
Route::get('/our-impact', [HomeController::class, 'ourImpact'])->name('our-impact');
Route::get('/rescue-sheets', [RescueSheetController::class, 'publicIndex'])->name('rescue.sheet.public');
Route::get('/rescue/{slug}', [RescueSheetController::class, 'view'])->name('rescue.sheet.show');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/detail/{id}', [HomeController::class, 'projectsDetail'])->name('projects.detail');
Route::get('/resources', [HomeController::class, 'resources'])->name('resources');
Route::get('/resources/detail/{id}', [HomeController::class, 'resourcesDetail'])->name('resources.detail');
Route::get('/ask-a-mentor', [MentorQnAController::class,'askForm'])->name('mentor_qna.ask');
Route::post('/ask-a-mentor', [MentorQnAController::class,'storeQuestion'])->middleware('auth')->name('mentor_qna.store');
Route::get('/mentor-qna', [MentorQnAController::class,'index'])->name('mentor_qna.index');
Route::get('/apply-membership', [MembershipController::class,'create'])->name('membership.create');
Route::post('/apply-membership', [MembershipController::class,'store'])->name('membership.store');

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

// Admin / Mentor (protected)
Route::prefix('admin')->middleware(['auth','is_admin'])->group(function() {
    Route::get('/mentor-qna', [MentorQnAController::class,'adminIndex'])->name('mentor_qna.admin_index');
    Route::get('/mentor-qna/{question}/answer', [MentorQnAController::class,'answerForm'])->name('mentor_qna.answer_form');
    Route::post('/mentor-qna/{question}/answer', [MentorQnAController::class,'storeAnswer'])->name('mentor_qna.store_answer');
    Route::post('/mentor-qna/{question}/archive', [MentorQnAController::class,'archive'])->name('mentor_qna.archive');
});

// Admin routes
Route::prefix('admin')->middleware(['auth','is_admin'])->group(function() {
    Route::get('/memberships', [MembershipController::class,'index'])->name('membership.index');
    Route::post('/memberships/{membership}/status', [MembershipController::class,'updateStatus'])->name('membership.update_status');
});

Route::get('/run-setup', function () {
    Artisan::call('migrate:fresh --seed');

    return 'Database migrated and seeded successfully!';
});
require __DIR__.'/auth.php';
