<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\NewPasswordAdminController;
use App\Http\Controllers\Etablissement;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\ForgotAdminPasswordController;
use App\Http\Controllers\ForgotEtablissementPasswordController;
use App\Http\Controllers\MaterielInformatiqueController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetAdminPasswordController;
use Illuminate\Support\Facades\Route;



// +++++++++++++++++++++++++ Admin +++++++++++++++++++++++++++++++++++++++++++++++
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'index'])->name('login_form');
    Route::post('/login/owner', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');
    Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create', [AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');
});


Route::get('admin/forgot-password', [ForgotAdminPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('admin/forgot-password', [ForgotAdminPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::post('admin/reset-password', [ForgotAdminPasswordController::class, 'update'])->name('admin.password.update');
Route::get('reset-password/{token}', [NewPasswordAdminController::class, 'create'])->name('password.reset');



Route::get('/fetch-etablissements/{communeId}', [AdminController::class, 'fetchEtablissements']);
Route::get('/fetch-materiel-informatique/{etablissementId}', [AdminController::class, 'fetchMaterielInformatique']);


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++













// ===================================== etablessement route =====================
Route::prefix('etablissement')->group(function () {
    Route::get('/login', [EtablissementController::class, 'index'])->name('etablissement_login_form');
    Route::get('/dashboard', [EtablissementController::class, 'dashboard'])->name('etablissement.dashboard')->middleware('etablissement');
    Route::post('/login/owner', [EtablissementController::class, 'Etablissementlogin'])->name('etablissement.login');
    Route::get('/logout', [EtablissementController::class, 'Etablissementlogout'])->name('etablissement.logout')->middleware('etablissement');
    Route::get('/register', [EtablissementController::class, 'EtablissementRegister'])->name('etablissement.register');
    Route::post('/register/owner', [EtablissementController::class, 'EtablissementRegisterCreate'])->name('etablissement.register.create');

    Route::get('/pdf', [PdfController::class, 'generateEtablissementPdf'])->name('etablissement.pdf');
});
// web.php

Route::get('/forgot-password', [ForgotEtablissementPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotEtablissementPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/reset-password', [ForgotEtablissementPasswordController::class, 'store'])->name('password.store');

// =======================================================================















// ===================================== material informatique route =====================
Route::prefix('materials')->group(function () {
    Route::get('/add/{id}', [MaterielInformatiqueController::class, 'index'])->name('add_materail_form')->middleware('admin');
    Route::post('/addMateriel/{id}', [MaterielInformatiqueController::class, 'addMateriel'])->name('add_materiel_info')->middleware('admin');
    Route::delete('/delete-materiel/{id}', [MaterielInformatiqueController::class, 'deleteMateriel'])->name('delete_materiel')->middleware('admin');
    Route::get('/edit-materiel/{id}', [MaterielInformatiqueController::class, 'editMateriel'])->name('edit_materiel')->middleware('admin');
    Route::put('/update-materiel/{id}', [MaterielInformatiqueController::class, 'updateMateriel'])->name('update_materiel')->middleware('admin');
    // this is for letting the etablissement to add a new materiel Informatique
    Route::get('/etablissement/add-material', [MaterielInformatiqueController::class, 'showMaterialForm'])->name('etablissement.add_material_form')->middleware('etablissement');
    Route::post('/etablissement/add-material', [MaterielInformatiqueController::class, 'addMaterial'])->name('etablissement.add_material')->middleware('etablissement');
});
// =======================================================================











Route::get('/pdf/{etablissementId}', [PdfController::class, 'generatePdf'])->name('generate_pdf')->middleware('admin');
Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
