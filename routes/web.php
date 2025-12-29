<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\Mentor\MentorDashboardController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MentorQnAController;
use App\Http\Controllers\Portal\MenteeProjectController ;
use App\Http\Controllers\Portal\MentorPortalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RescueSheetController;
use App\Http\Controllers\ResearchProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Portal\PortalMessageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('our-value', [HomeController::class, 'ourValue'])->name('our-value');
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
Route::get('/ask-a-mentor', [MentorQnAController::class, 'askForm'])->name('mentor_qna.ask');
Route::post('/ask-a-mentor', [MentorQnAController::class, 'storeQuestion'])->middleware('auth')->name('mentor_qna.store');
Route::get('/mentor-qna', [MentorQnAController::class, 'index'])->name('mentor_qna.index');
Route::get('/apply-membership', [MembershipController::class, 'create'])->name('membership.create');
Route::post('/apply-membership', [MembershipController::class, 'store'])->name('membership.store');
Route::get('/programs', [HomeController::class, 'programs'])->name('programs');
Route::get('/programs/detail/{slug}', [HomeController::class, 'programsDetail'])->name('programs.detail');
Route::get('/research', [HomeController::class, 'research'])->name('research.index');
Route::get('/research/detail/{slug}', [HomeController::class, 'researchDetail'])->name('research.detail');
Route::get('/faq', [HomeController::class, 'faqPage'])->name('faq.page');
Route::post('/faq/question', [HomeController::class, 'storeQuestion'])->name('faq.question.store');
Route::get('/research_space', [HomeController::class, 'space'])->name('research.space');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

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
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/mentor-qna', [MentorQnAController::class, 'adminIndex'])->name('mentor_qna.admin_index');
    Route::get('/mentor-qna/{question}/answer', [MentorQnAController::class, 'answerForm'])->name('mentor_qna.answer_form');
    Route::post('/mentor-qna/{question}/answer', [MentorQnAController::class, 'storeAnswer'])->name('mentor_qna.store_answer');
    Route::post('/mentor-qna/{question}/archive', [MentorQnAController::class, 'archive'])->name('mentor_qna.archive');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/memberships', [MembershipController::class, 'index'])->name('membership.index');
    Route::post('/memberships/{membership}/status', [MembershipController::class, 'updateStatus'])->name('membership.update_status');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('/admin/users/{id}/reset-password',  [UserController::class, 'resetPassword'])->name('admin.users.resetPassword');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('programs', \App\Http\Controllers\Admin\ProgramController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('stories', \App\Http\Controllers\Admin\StoryController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::resource('resources', \App\Http\Controllers\Admin\ResourceController::class);
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialsController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqsController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('programs', \App\Http\Controllers\Admin\ProgramController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('team', \App\Http\Controllers\Admin\TeamMemberController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('memberships', \App\Http\Controllers\Admin\MembershipController::class);
    Route::put(
        'memberships/{membership}/status',
        [\App\Http\Controllers\Admin\MembershipController::class, 'updateStatus']
    )->name('memberships.status');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('research', \App\Http\Controllers\Admin\ResearchController::class);
});

// Role-based onboarding
Route::get('/onboarding/{role}', [MentorController::class, 'index'])->name('onboarding.index');
Route::post('/onboarding/save-step', [MentorController::class, 'saveStep'])->name('onboarding.saveStep');
Route::post('/onboarding/register', [MentorController::class, 'registerUser'])->name('onboarding.register');

// Mentor listing & request
Route::get('/mentors', [MentorController::class, 'mentorLists'])->name('mentors.list');
Route::get('/mentors/{id}', [MentorController::class, 'profile'])->name('mentors.profile');
Route::post('mentor/{id}/request', [MentorController::class, 'requestMentor'])->name('mentor.request');
Route::get('/mentors/{mentor}/details', [MentorController::class, 'mentorDetails'])->name('mentor.profile');

// Onboarding routes
Route::prefix('mentor-onboarding')->group(function () {
    Route::get('/{role}', [MentorController::class, 'showWizard'])->name('mentor.onboarding');
    Route::post('/save-step', [MentorController::class, 'saveStepMentor'])->name('mentor.onboarding.saveStep');
    Route::post('/register', [MentorController::class, 'registerMentor'])->name('mentor.onboarding.register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mentee/dashboard', [MentorDashboardController::class, 'menteeDashboard'])->name('mentee.dashboard');
    Route::get('/mentor/dashboard', [MentorDashboardController::class, 'mentorDashboard'])->name('mentor.dashboard');
    Route::get('/portal/dashboard', [MentorDashboardController::class, 'dashboard'])->name('portal.dashboard');

    // Requests
    Route::get('/mentor/requests', [MentorPortalController::class, 'index'])->name('mentor.requests.index');
    Route::post('/requests/{id}/action', [MentorPortalController::class, 'action'])->name('requests.action');
    Route::delete('/requests/{id}/cancel', [MentorPortalController::class, 'cancel'])
        ->name('mentee.request.cancel');
    Route::get('/mentors/{mentor}/profile', [MentorPortalController::class, 'mentorProfile'])->name('mentor.details');
    
    Route::get('/portal/projects', [MenteeProjectController::class, 'index'])->name('projects.index'); // list all projects
    Route::get('/portal/projects/create', [MenteeProjectController::class, 'create'])->name('projects.create'); // form to create
    Route::post('/portal/projects', [MenteeProjectController::class, 'store'])->name('projects.store'); // save new project
    Route::get('/portal/projects/{project}', [MenteeProjectController::class, 'show'])->name('projects.show'); // view project details

    // Milestones
    Route::get('/portal/projects/{project}/milestones/create', [MenteeProjectController::class, 'createMilestone'])->name('milestones.create'); // form to add milestone
    Route::post('/portal/projects/{project}/milestones', [MenteeProjectController::class, 'storeMilestone'])->name('milestones.store'); // save milestone

    // Collaborators
    Route::get('/portal/projects/{project}/collaborators/create', [MenteeProjectController::class, 'createCollaborator'])->name('collaborators.create'); // form to add collaborator
    Route::post('/portal/projects/{project}/collaborators', [MenteeProjectController::class, 'storeCollaborator'])->name('collaborators.store'); // save collaborator

    // Comments
    Route::post('/portal/milestones/{milestone}/comments', [MenteeProjectController::class, 'storeComment'])->name('comments.store'); // add comment
});

Route::prefix('messages')->middleware('auth')->group(function() {
    Route::get('/', [PortalMessageController::class, 'index'])->name('messages.index');
    Route::get('/{user}', [PortalMessageController::class, 'show'])->name('messages.show');
    Route::post('/{user}', [PortalMessageController::class, 'store'])->name('messages.store');
});


Route::get('/run-setup', function () {
    Artisan::call('migrate:fresh --seed');

    return 'Database migrated and seeded successfully!';
});

Route::get('/run-storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created!';
});
require __DIR__ . '/auth.php';
