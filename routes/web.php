<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AttentionController;
use App\Http\Controllers\TriageController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SurgeryController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group( function () {

    // ADMINSION

    // Inicio
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('permission:home index');
    Route::get('/api/triages', [HomeController::class, 'triages'])->name('home.triages')->middleware('permission:home triages');
    Route::get('/api/attentions', [HomeController::class, 'attentions'])->name('home.attentions')->middleware('permission:home attentions');

    // Pacientes
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index')->middleware('permission:patients index');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store')->middleware('permission:patients store');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update')->middleware('permission:patients update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy')->middleware('permission:patients destroy');
    Route::get('/api/patients', [PatientController::class, 'get'])->name('patients.get')->middleware('permission:patients get');
    Route::get('/api/patients/{patient}', [PatientController::class, 'show'])->name('patients.show')->middleware('permission:patients show');
    
    // Historial Médico y reportes PDF Historia Clínica y Receta Médica
    Route::get('/histories', [HistoryController::class, 'index'])->name('histories.index')->middleware('permission:histories index');
    Route::get('/records/{attention}', [HistoryController::class, 'record'])->name('histories.record')->middleware('permission:histories record');
    Route::get('/prescriptions/{attention}', [HistoryController::class, 'prescription'])->name('histories.prescription')->middleware('permission:histories prescription');

    // Atenciones
    Route::get('/attentions', [AttentionController::class, 'index'])->name('attentions.index')->middleware('permission:attentions index');
    Route::post('/attentions', [AttentionController::class, 'store'])->name('attentions.store')->middleware('permission:attentions store');
    Route::put('/attentions/{attention}', [AttentionController::class, 'update'])->name('attentions.update')->middleware('permission:attentions update');
    Route::delete('/attentions/{attention}', [AttentionController::class, 'destroy'])->name('attentions.destroy')->middleware('permission:attentions destroy');
    
        
    // CLINICA
 
    // Triajes
    Route::get('/triages', [TriageController::class, 'index'])->name('triages.index')->middleware('permission:triages index');
    Route::put('/triages/{triage}', [TriageController::class, 'update'])->name('triages.update')->middleware('permission:triages update');

    // Historias Clínicas
    Route::get('/records', [RecordController::class, 'index'])->name('records.index')->middleware('permission:records index');
    Route::put('/records/{record}', [RecordController::class, 'update'])->name('records.update')->middleware('permission:records update');
    
    // INFORME

    // Informes Quirúrgicos
    Route::get('/surgeries', [SurgeryController::class, 'index'])->name('surgeries.index')->middleware('permission:surgeries index');
    Route::post('/surgeries', [SurgeryController::class, 'store'])->name('surgeries.store')->middleware('permission:surgeries store');
    Route::get('/surgeries/{surgery}', [SurgeryController::class, 'show'])->name('surgeries.show')->middleware('permission:surgeries show');
    Route::put('/surgeries/{surgery}', [SurgeryController::class, 'update'])->name('surgeries.update')->middleware('permission:surgeries update');
    Route::delete('/surgeries/{surgery}', [SurgeryController::class, 'destroy'])->name('surgeries.destroy')->middleware('permission:surgeries destroy');

    // Informes de Laboratoriales
    Route::get('/labs', [LabController::class, 'index'])->name('labs.index')->middleware('permission:labs index');
    Route::post('/labs', [LabController::class, 'store'])->name('labs.store')->middleware('permission:labs store');
    Route::get('/labs/{lab}', [LabController::class, 'show'])->name('labs.show')->middleware('permission:labs show');
    Route::put('/labs/{lab}', [LabController::class, 'update'])->name('labs.update')->middleware('permission:labs update');
    Route::delete('/labs/{lab}', [LabController::class, 'destroy'])->name('labs.destroy')->middleware('permission:labs destroy');
    
    // MANTENIMIENTO

    // Accesos
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:roles index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:roles store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:roles update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:roles destroy');
    Route::get('/api/roles', [RoleController::class, 'get'])->name('roles.get')->middleware('permission:roles get');
    Route::get('/api/roles/{role}', [RoleController::class, 'show'])->name('roles.show')->middleware('permission:roles show');

    // Servicios
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index')->middleware('permission:services index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store')->middleware('permission:services store');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update')->middleware('permission:services update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy')->middleware('permission:services destroy');
    Route::get('/api/services', [ServiceController::class, 'get'])->name('services.get')->middleware('permission:services get');
    Route::get('/api/services/{service}', [ServiceController::class, 'show'])->name('services.show')->middleware('permission:services show');

    // Diagnósticos
    Route::get('/diagnoses', [DiagnosisController::class, 'index'])->name('diagnoses.index')->middleware('permission:diagnoses index');
    Route::post('/diagnoses', [DiagnosisController::class, 'store'])->name('diagnoses.store')->middleware('permission:diagnoses store');
    Route::put('/diagnoses/{diagnosis}', [DiagnosisController::class, 'update'])->name('diagnoses.update')->middleware('permission:diagnoses update');
    Route::delete('/diagnoses/{diagnosis}', [DiagnosisController::class, 'destroy'])->name('diagnoses.destroy')->middleware('permission:diagnoses destroy');
    Route::get('/api/diagnoses', [DiagnosisController::class, 'get'])->name('diagnoses.get')->middleware('permission:diagnoses get');
    Route::get('/api/diagnoses/{diagnosis}', [DiagnosisController::class, 'show'])->name('diagnoses.show')->middleware('permission:diagnoses show');
    Route::patch('/diagnoses/{id}', [DiagnosisController::class, 'reinstate'])->name('diagnoses.reinstate')->middleware('permission:diagnoses destroy');

    // Especialistas
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('permission:users index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('permission:users store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:users update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:users destroy');
    Route::get('/api/users', [UserController::class, 'get'])->name('users.get')->middleware('permission:users get');
    Route::get('/api/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:users show');
    
    Route::get('audits', [AuditController::class, 'index'])->name('audits.index')->middleware('role:Super Admin');
});