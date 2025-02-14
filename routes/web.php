<?php 

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==========================
//      ADMIN ROUTES
// ==========================
Route::prefix('admin')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Profile management
        Route::get('edit-profile', [AdminController::class, 'editProfile'])->name('admin.edit-profile');
        Route::post('update-profile', [AdminController::class, 'updateProfile'])->name('admin.update-profile');
        
        // Manage students & professors
        Route::get('create-etudiant', [AdminController::class, 'showCreateEtudiantForm'])->name('admin.create-etudiant');
        Route::post('create-etudiant', [AdminController::class, 'createEtudiant']);
        Route::get('create-prof', [AdminController::class, 'createProfForm'])->name('admin.createProfForm');
        Route::post('create-prof', [AdminController::class, 'createProf'])->name('admin.createProf');

        // Group Management
        Route::get('groups', [GroupController::class, 'index'])->name('admin.groups.index');
        Route::get('groups/create', [GroupController::class, 'create'])->name('admin.groups.create');
        Route::post('groups/store', [GroupController::class, 'store'])->name('admin.groups.store');
        Route::delete('groups/{group}', [GroupController::class, 'destroy'])->name('admin.groups.destroy');


        
        // Assign Professors to Subjects
        Route::get('assign-prof', [AdminController::class, 'assignProf'])->name('admin.assignProf');
        Route::post('assign-prof', [AdminController::class, 'storeProfSubject'])->name('admin.storeProfSubject');
    });
    
    // Authentication Routes
    Route::get('register', [AdminController::class, 'showRegisterForm'])->name('admin.registerForm');
    Route::post('register', [AdminController::class, 'register'])->name('admin.register');
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// Subject Management (Admin)
Route::get('admin/create-subject', [SubjectController::class, 'create'])->name('admin.createSubject');
Route::post('admin/store-subject', [SubjectController::class, 'store'])->name('admin.storeSubject');
// ==========================
//      PROFESSOR ROUTES
// ==========================
Route::prefix('prof')->group(function () {
    Route::middleware('auth:prof')->group(function () {
        Route::get('dashboard', [ProfController::class, 'dashboard'])->name('prof.dashboard');
        Route::get('students/{subject_id}', [ProfController::class, 'showStudents'])->name('prof.students');
        Route::post('assign-grade', [ProfController::class, 'storeGrade'])->name('prof.assignGrade');
    });

    // Authentication Routes
    Route::get('login', [ProfController::class, 'showLoginForm'])->name('prof.login');
    Route::post('login', [ProfController::class, 'login']);
    Route::post('logout', [ProfController::class, 'logout'])->name('prof.logout');
});

// ==========================
//      STUDENT ROUTES
// ==========================
Route::prefix('etudiant')->group(function () {
    Route::middleware('auth:etudiant')->group(function () {
        Route::get('dashboard', [EtudiantController::class, 'dashboard'])->name('etudiant.dashboard');
    });

    // Authentication Routes
    Route::get('login', [EtudiantController::class, 'showLoginForm'])->name('etudiant.login');
    Route::post('login', [EtudiantController::class, 'login']);
    Route::post('logout', function () {
        Auth::guard('etudiant')->logout();
        return redirect()->route('etudiant.login');
    })->name('etudiant.logout');
});
