<?php 


use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\GroupController;



Route::get('admin/edit-profile', [AdminController::class, 'editProfile'])->name('admin.edit-profile')->middleware('auth:admin');
Route::post('admin/update-profile', [AdminController::class, 'updateProfile'])->name('admin.update-profile')->middleware('auth:admin');



Route::get('admin/create-etudiant', [AdminController::class, 'showCreateEtudiantForm'])->name('admin.create-etudiant')->middleware('auth:admin');
Route::post('admin/create-etudiant', [AdminController::class, 'createEtudiant'])->middleware('auth:admin');

Route::get('admin/create-prof', [AdminController::class, 'createProfForm'])->name('admin.createProfForm')->middleware('auth:admin');
Route::post('admin/create-prof', [AdminController::class, 'createProf'])->name('admin.createProf')->middleware('auth:admin');


Route::get('admin/register', [AdminController::class, 'showRegisterForm'])->name('admin.registerForm');
Route::post('admin/register', [AdminController::class, 'register'])->name('admin.register');

Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');

Route::get('prof/login', [ProfController::class, 'showLoginForm'])->name('prof.login');
Route::post('prof/login', [ProfController::class, 'login']);
Route::get('prof/dashboard', [ProfController::class, 'dashboard'])->name('prof.dashboard')->middleware('auth:prof');
Route::post('prof/logout', [ProfController::class, 'logout'])->name('prof.logout');

Route::get('etudiant/login', [EtudiantController::class, 'showLoginForm'])->name('etudiant.login');
Route::post('etudiant/login', [EtudiantController::class, 'login']);
Route::post('/etudiant/logout', function () {
    Auth::guard('etudiant')->logout();
    return redirect()->route('etudiant.login');
})->name('etudiant.logout');
Route::get('etudiant/dashboard', [EtudiantController::class, 'dashboard'])->name('etudiant.dashboard')->middleware('auth:etudiant');


Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/groups', [GroupController::class, 'index'])->name('admin.groups.index');
    Route::get('admin/groups/create', [GroupController::class, 'create'])->name('admin.groups.create');
    Route::post('admin/groups/store', [GroupController::class, 'store'])->name('admin.groups.store');
    Route::delete('admin/groups/{group}', [GroupController::class, 'destroy'])->name('admin.groups.destroy');
});



