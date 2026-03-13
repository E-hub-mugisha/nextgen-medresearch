<?php

use App\Http\Controllers\Admin\AdminResearchSpaceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\Mentor\MentorDashboardController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MentorQnAController;
use App\Http\Controllers\Portal\MenteeProjectController;
use App\Http\Controllers\Portal\MentorPortalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RescueSheetController;
use App\Http\Controllers\ResearchProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Portal\CollaboratorController;
use App\Http\Controllers\Portal\CollaboratorController as PortalCollaboratorController;
use App\Http\Controllers\Portal\CommentController;
use App\Http\Controllers\Portal\DashboardController as PortalDashboardController;
use App\Http\Controllers\Portal\MilestoneController;
use App\Http\Controllers\Portal\PeopleController;
use App\Http\Controllers\Portal\PortalMessageController;
use App\Http\Controllers\Portal\ResearchInterestController;
use App\Http\Controllers\Portal\ResearchProjectController as PortalResearchProjectController;
use App\Http\Controllers\ResearchKitController;
use App\Http\Controllers\ResearchSpaceController;
use Barryvdh\DomPDF\Facade\Pdf;
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
Route::get('/partnerships', [HomeController::class, 'partners'])->name('partners');
Route::get('/our-impact', [HomeController::class, 'ourImpact'])->name('our-impact');
Route::get('/rescue-sheets', [RescueSheetController::class, 'publicIndex'])->name('rescue.sheet.public');
Route::get('/rescue/{slug}', [RescueSheetController::class, 'view'])->name('rescue.sheet.show');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/detail/{id}', [HomeController::class, 'projectsDetail'])->name('projects.detail');
Route::get('/resources', [HomeController::class, 'resources'])->name('resources');
Route::get('/resources/detail/{id}', [HomeController::class, 'resourcesDetail'])->name('resources.detail');
Route::get('/ask-a-mentor', [MentorQnAController::class, 'askForm'])->name('mentor_qna.ask');
Route::post('/ask-a-mentor', [MentorQnAController::class, 'storeQuestion'])->name('mentor_qna.store');
Route::get('/mentor-qna', [MentorQnAController::class, 'index'])->name('mentor_qna.index');
Route::get('/apply-membership', [MembershipController::class, 'create'])->name('membership.create');
Route::post('/apply-membership', [MembershipController::class, 'store'])->name('membership.store');
Route::get('/programs', [HomeController::class, 'programs'])->name('programs');
Route::get('/programs/detail/{slug}', [HomeController::class, 'programsDetail'])->name('programs.detail');
Route::get('/our-research', [HomeController::class, 'research'])->name('research.index');
Route::get('/our-research/detail/{slug}', [HomeController::class, 'researchDetail'])->name('research.detail');
Route::get('/faq', [HomeController::class, 'faqPage'])->name('faq.page');
Route::post('/faq/question', [HomeController::class, 'storeQuestion'])->name('faq.question.store');
// Route::get('/research_space', [HomeController::class, 'space'])->name('research.space');
Route::get('/research-space', [ResearchSpaceController::class, 'index'])
    ->name('research.space');

Route::post('/contact/send', [HomeController::class, 'send'])->name('contact.send');
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribe'])
    ->name('newsletter.subscribe');
Route::get('/research-kits', [ResearchKitController::class, 'index'])->name('kits.index');
Route::get('/research-kits/{id}', [ResearchKitController::class, 'show'])->name('kits.show');
Route::get('/research-kits/{id}/download', [ResearchKitController::class, 'download'])->name('kits.download');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/application-form', function () {
    return view('front.apply');
});
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

// admin research space routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('research_spaces', AdminResearchSpaceController::class);
    Route::get('admin/research-spaces/{researchSpace}/users', [AdminResearchSpaceController::class, 'showUsers'])
        ->name('research_spaces.users');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/research-kits', [ResearchKitController::class, 'indexAdmin'])->name('research_kits.index');
    Route::post('/research-kits', [ResearchKitController::class, 'store'])->name('research_kits.store');
    Route::put('/research-kits/{researchKit}', [ResearchKitController::class, 'update'])->name('research_kits.update');
    Route::delete('/research-kits/{researchKit}', [ResearchKitController::class, 'destroy'])->name('research_kits.destroy');
});

// Step 1 — Role selection modal lives on the home/welcome page
// Step 2 — Show the registration form based on role
Route::get('/onboarding', [MentorController::class, 'showForm'])
    ->name('register');

// Step 3 — Handle registration form submission (AJAX)
Route::post('/onboarding', [MentorController::class, 'register'])
    ->name('onboarding.register');

Route::get('/portal/dashboard', [PortalDashboardController::class, 'index'])->name('portal.dashboard.index');
Route::get('/portal/discover', [PortalResearchProjectController::class, 'discover'])->name('portal.projects.discover');
Route::get('/portal/profile',       [PeopleController::class, 'show'])->name('portal.profile.show');
Route::get('/portal/profile/edit',  [PeopleController::class, 'edit'])->name('portal.profile.edit');
Route::patch('/portal/profile',      [PeopleController::class, 'update'])->name('portal.profile.update');
Route::get('/portal/users/{user}', [PeopleController::class, 'viewUser'])->name('portal.users.show');
Route::get('portal/projects', [PortalResearchProjectController::class, 'index'])->name('portal.projects.index');
Route::get('portal/projects/create', [PortalResearchProjectController::class, 'create'])->name('portal.projects.create');
Route::post('portal/projects', [PortalResearchProjectController::class, 'store'])->name('portal.projects.store');
Route::get('portal/projects/{project}', [PortalResearchProjectController::class, 'show'])->name('portal.projects.show');
Route::get('portal/projects/{project}/edit', [PortalResearchProjectController::class, 'edit'])->name('portal.projects.edit');
Route::patch('portal/projects/{project}', [PortalResearchProjectController::class, 'update'])->name('portal.projects.update');
Route::delete('portal/projects/{project}', [PortalResearchProjectController::class, 'destroy'])->name('portal.projects.destroy');
// Route::resource('portal/projects', PortalResearch
// Registers:
//   GET    /projects                → projects.index
//   GET    /projects/create         → projects.create
//   POST   /projects                → projects.store
//   GET    /projects/{project}       → projects.show
//   GET    /projects/{project}/edit  → projects.edit
//   PATCH  /projects/{project}       → projects.update
//   DELETE /projects/{project}       → projects.destroy


/*
    |----------------------------------------------------------------------
    | COLLABORATORS
    |----------------------------------------------------------------------
    */
Route::middleware('auth')->prefix('portal')->name('portal.')->group(function () {
    Route::get('/people', [PeopleController::class, 'index'])->name('people.index');

    // Collaborators ← full group with index
    Route::prefix('projects/{project}/collaborators')->name('collaborators.')->group(function () {
        Route::get('/',                [PortalCollaboratorController::class, 'index'])->name('index');
        Route::post('request',         [PortalCollaboratorController::class, 'sendRequest'])->name('request');
        Route::patch('{user}/accept',  [PortalCollaboratorController::class, 'accept'])->name('accept');
        Route::patch('{user}/reject',  [PortalCollaboratorController::class, 'reject'])->name('reject');
        Route::delete('{user}/remove', [PortalCollaboratorController::class, 'remove'])->name('remove');
        Route::post('{user}/invite',   [PortalCollaboratorController::class, 'invite'])->name('invite');
    });

    Route::get('/topics',                   [ResearchInterestController::class, 'index'])->name('interests.index');
    Route::post('/topics/{interest}/toggle', [ResearchInterestController::class, 'toggle'])->name('interests.toggle');
    Route::post('/topics/sync',             [ResearchInterestController::class, 'sync'])->name('interests.sync');
    Route::get('/topics/{interest}/projects', [ResearchInterestController::class, 'projects'])->name('interests.projects');
});


/*
    |----------------------------------------------------------------------
    | MILESTONES
    |----------------------------------------------------------------------
    */
Route::resource('projects.milestones', MilestoneController::class)->shallow();
// shallow() generates:
//   GET    /projects/{project}/milestones          → milestones.index
//   GET    /projects/{project}/milestones/create   → milestones.create
//   POST   /projects/{project}/milestones          → milestones.store
//   GET    /milestones/{milestone}                 → milestones.show
//   GET    /milestones/{milestone}/edit            → milestones.edit
//   PATCH  /milestones/{milestone}                 → milestones.update
//   DELETE /milestones/{milestone}                 → milestones.destroy

// Quick status update via AJAX
Route::patch('/milestones/{milestone}/status', [MilestoneController::class, 'updateStatus'])
    ->name('milestones.status');


/*
    |----------------------------------------------------------------------
    | COMMENTS
    |----------------------------------------------------------------------
    */
Route::post('/milestones/{milestone}/comments',  [CommentController::class, 'store'])->name('comments.store');
Route::patch('/comments/{comment}',              [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}',             [CommentController::class, 'destroy'])->name('comments.destroy');
// Role-based onboarding
// Route::get('/onboarding/{role}', [MentorController::class, 'index'])->name('onboarding.index');
// Route::post('/onboarding/save-step', [MentorController::class, 'saveStep'])->name('onboarding.saveStep');
// Route::post('/onboarding/register', [MentorController::class, 'registerUser'])->name('onboarding.register');

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


Route::prefix('messages')->middleware('auth')->group(function () {
    Route::get('/', [PortalMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/chat/{user}', [PortalMessageController::class, 'chat'])
        ->name('messages.chat');

    Route::post('/messages/send/{user}', [PortalMessageController::class, 'store'])
        ->name('messages.send');
});


Route::get('/run-setup', function () {
    Artisan::call('migrate:fresh');

    return 'Database migrated and seeded successfully!';
});

Route::get('/run-migration', function () {
    Artisan::call('migrate');

    return 'Database migrated successfully!';
});

Route::get('/run-storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created!';
});

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'Cache cleared';
});

Route::get('/pdf-test', function () {
    return Pdf::loadHTML('<h1>PDF OK</h1>')->download('test.pdf');
});
require __DIR__ . '/auth.php';
