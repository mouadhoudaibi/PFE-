<?php 

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Auth\AdminPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==========================
//      ADMIN ROUTES
// ==========================

Route::get('/', function () {
    return view  ('welcome');
});

Route::prefix('admin')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('admins', [AdminController::class, 'showAdmin'])->name('admins.show');


        
        // Profile management
        Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('edit-profile', [AdminController::class, 'editProfile'])->name('admin.edit-profile');
        Route::post('update-profile', [AdminController::class, 'updateProfile'])->name('admin.update-profile');
        
        // Manage students & professors
        Route::get('create-etudiant', [AdminController::class, 'showCreateEtudiantForm'])->name('admin.create-etudiant');
        Route::post('create-etudiant', [AdminController::class, 'createEtudiant']);
        Route::get('students', [AdminController::class, 'showStudents'])->name('admin.students.show');
        Route::get('create-prof', [AdminController::class, 'createProfForm'])->name('admin.createProfForm');
        Route::post('create-prof', [AdminController::class, 'createProf'])->name('admin.createProf');

        // Group Management
        Route::get('groups', [GroupController::class, 'index'])->name('admin.groups.index');
        Route::get('groups/create', [GroupController::class, 'create'])->name('admin.groups.create');
        Route::post('groups/store', [GroupController::class, 'store'])->name('admin.groups.store');
        Route::get('groups/{group}/students', [AdminController::class, 'viewStudents'])->name('admin.groups.students');
        Route::get('groups/students/{id}/edit', [AdminController::class, 'editStudent'])->name('admin.editStudent');
        Route::put('students/{id}', [AdminController::class, 'updateStudent'])->name('admin.updateStudent');
        Route::delete('students/{id}', [AdminController::class, 'deleteStudent'])->name('admin.deleteStudent');
        Route::delete('groups/{group}', [GroupController::class, 'destroy'])->name('admin.groups.destroy');


        
        // Assign Professors to Subjects
        Route::get('assign-prof', [AdminController::class, 'showAssignProfForm'])->name('admin.assignProf');
        Route::post('assign-prof', [AdminController::class, 'storeAssignProf'])->name('admin.storeAssignProf');

        Route::get('professors-groups', [AdminController::class, 'viewProfessorsGroups'])->name('admin.professorsGroups');


        // Route for admin to view all professors
        Route::get('professors', [ProfController::class, 'index'])->name('admin.professors');

        // Route to edit professor
        Route::get('professors/{id}/edit', [ProfController::class, 'edit'])->name('admin.professors.edit');
        Route::post('professors/{id}/update', [ProfController::class, 'update'])->name('admin.professors.update');

        // Route to delete professor
        Route::delete('professors/{id}', [ProfController::class, 'destroy'])->name('admin.professors.destroy');



    Route::get('/view-grades', [AdminController::class, 'index'])->name('admin.viewGrades');
    Route::get('/view-grades/{group}', [AdminController::class, 'showSubjects'])->name('admin.viewGrades.subjects');
    Route::get('/view-grades/{group}/{subject}', [AdminController::class, 'showGrades'])->name('admin.viewGrades.grades');


    });
    
    // Authentication Routes
    Route::get('register', [AdminController::class, 'showRegisterForm'])->name('admin.registerForm');
    Route::post('register', [AdminController::class, 'register'])->name('admin.register');
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Subject Management (Admin)
    Route::get('subjects/create-subject', [SubjectController::class, 'create'])->name('admin.createSubject');
    Route::post('store-subject', [SubjectController::class, 'store'])->name('admin.storeSubject');
    Route::get('subjects', [AdminController::class, 'viewSubjects'])->name('admin.subjects.index');
    Route::get('subjects/{id}/edit', [AdminController::class, 'editSubject'])->name('admin.subjects.edit');
    Route::put('subjects/{id}', [AdminController::class, 'updateSubject'])->name('admin.subjects.update');
    Route::delete('subjects/{id}', [AdminController::class, 'deleteSubject'])->name('admin.subjects.delete');

});


// ==========================
//      PROFESSOR ROUTES
// ==========================
Route::prefix('prof')->group(function () {
    Route::middleware('auth:prof')->group(function () {
        Route::get('dashboard', [ProfController::class, 'dashboard'])->name('prof.dashboard');
        Route::get('students/{subject_id}', [ProfController::class, 'showStudents'])->name('prof.students');
        Route::post('assign-grade', [ProfController::class, 'storeGrade'])->name('prof.assignGrade');
        Route::get('groups', [ProfController::class, 'viewGroups'])->name('prof.groups');
        Route::get('groups/{group}', [ProfController::class, 'viewStudents'])->name('prof.viewStudents');
        Route::post('save-grades/{group}', [ProfController::class, 'saveGrades'])->name('prof.saveGrades');
        


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
        Route::get('assignments', [EtudiantController::class, 'assignments'])->name('etudiant.assignments');
        Route::get('grades', [EtudiantController::class, 'grades'])->name('etudiant.grades');
        Route::get('group', [EtudiantController::class, 'group'])->name('etudiant.group');
        Route::get('grades/totalgrades', [EtudiantController::class, 'totalgrades'])->name('etudiant.totalgrades');

        
    });

    // Authentication Routes
    Route::get('login', [EtudiantController::class, 'showLoginForm'])->name('etudiant.login');
    Route::post('login', [EtudiantController::class, 'login']);
    Route::post('logout', function () {
        Auth::guard('etudiant')->logout();
        return redirect()->route('etudiant.login');
    })->name('etudiant.logout');
});


Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
