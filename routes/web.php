<?php

use App\Http\Controllers\SoutenanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail; // Add this line
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\stageInitiation;
use App\Http\Controllers\stagePerfectionnement;

use App\Http\Controllers\stagePFE;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClassController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login'); // This allows the root `/` to show the login form


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-email', function () {
    Mail::raw('This is a test email sent using MailHog.', function ($message) {
        $message->to('test@example.com')
            ->subject('MailHog Test Email');
    });

    return 'Email sent!';
});


Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit'); // This one
Route::patch('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::post('students/import', [StudentController::class, 'importExcelData'])->name('students.import');
require __DIR__ . '/auth.php';
Route::get('/listeEnseignant', [EnseignantController::class, 'listepage'])->name('listeEnseignant');
Route::post('/enseignantAdmin', [EnseignantController::class, 'addEnseignant'])->name('addEnseignant');  //ajouter enseignant
Route::get('/enseignantAdmin', [EnseignantController::class, 'allEnseignant'])->name('allEnseignant');
Route::get('/deleteEnseignant/{id}', [EnseignantController::class, 'delete'])->name('deleteEnseignant');

Route::put('/update/{id}', [EnseignantController::class, 'update'])->name('updateEnseignant');
Route::get('/edit/{id}', [EnseignantController::class, 'edit'])->name('editEnseignant');

Route::post('/enseignants/import', [EnseignantController::class, 'importExcelData'])->name('enseignants.import');

Route::get('/enseignants/search', [EnseignantController::class, 'search'])->name('searchEnseignant');


Route::get('/stage-initiation', [stageInitiation::class, 'index'])->name('stage.initiation');


Route::get('/stage-perfectionnement', [stagePerfectionnement::class, 'index'])->name('stage.perfectionnement');

//class
Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');
Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');

// routes/web.php
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

Route::delete('/soutenances/{id}', [SoutenanceController::class, 'destroy']);



Route::get('/soutenances/pfe', [SoutenanceController::class, 'showPFE'])->name('stageDePFEinterface');
Route::get('/soutenances/initiation', [SoutenanceController::class, 'showInitiation'])->name('stage.initiation');
Route::get('/soutenances/perfectionnement', [SoutenanceController::class, 'showPerfectionnement'])->name('stage.perfectionnement');
Route::post('/soutenances', [SoutenanceController::class, 'store'])->name('soutenances.store');
Route::get('/soutenances/{id}/edit', [SoutenanceController::class, 'edit'])->name('soutenances.edit');
Route::put('/soutenances/{id}', [SoutenanceController::class, 'update'])->name('soutenances.update');
