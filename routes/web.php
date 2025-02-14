<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;







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
    return view('login');
});

Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');   


// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');  
// Route::delete('/admin/doctors/{doctor}', [AdminController::class, 'destroy'])->name('doctors.destroy');
// Route::get('/admin/doctors/manage/{id?}', [AdminController::class, 'editdoctors'])->name('doctors.update');
// Route::POST('admin//doctors/{id}', [AdminController::class, 'updatesdoctor'])->name('doctors.updatesubmit');
// Route::POST('/admin/add/data', [AdminController::class, 'add'])->name('doctors.add');
// Route::get('/admin/patient/data', [AdminController::class, 'get_list'])->name('manage.patient'); 
// Route::POST('/admin/patients/add', [AdminController::class, 'createpatients'])->name('patients.add');
// Route::get('/admin/patients/manage/{id?}', [AdminController::class, 'editpatients'])->name('patients.update'); 
// Route::delete('/admin/patients/{patients}', [AdminController::class, 'destroy_patients'])->name('patients.destroy'); 
// Route::PUT('/admin/patients/{id}', [AdminController::class, 'updatespatients'])->name('patients.updatesubmit');


// Route::get('/doctor/dashboard', [DoctorController::class, 'doctor_dashboard'])->name('doctor.dashboard'); 
// Route::get('/doctor/diagnoses/manage/{id?}', [DoctorController::class, 'editdiagnoses'])->name('diagnoses.update');
// Route::PUT('/doctor/diagnoses/{id}', [DoctorController::class, 'updatesdiagnoses'])->name('diagnoses.updatesubmit');
// Route::POST('/doctor/diagnoses/add', [DoctorController::class, 'creatediagnoses'])->name('diagnoses.add');
// Route::delete('/doctor/diagnoses/{doctor}', [DoctorController::class, 'diagnoses_destroy'])->name('diagnoses.destroy');
// Route::get('/doctor/treatment/manage/{id?}', [DoctorController::class, 'edittreatment'])->name('treatment.update');
// Route::PUT('/doctor/treatment/{id}', [DoctorController::class, 'updatestreatment'])->name('treatment.updatesubmit');
// Route::POST('/doctor/treatment/add', [DoctorController::class, 'createtreatment'])->name('treatment.add');
// Route::delete('/doctor/treatment/{doctor}', [DoctorController::class, 'treatment_destroy'])->name('treatment.destroy');
// Route::get('/doctor/treatment/data', [DoctorController::class, 'get_treatment_list'])->name('manage.treatment'); 

// Route::get('/treatment/data', [PatientController::class, 'treatment_dashboard'])->name('treatment.dashboard');
// Route::get('/diagnoses/dashboard', [PatientController::class, 'diagnosis_dashboard'])->name('diagnoses.dashboard'); 



// Route::middleware('auth:api')->group(function () {
//     Route::get('/doctors', [AdminController::class, 'listDoctors'])->middleware('admin');
//     Route::get('/patients', [AdminController::class, 'listPatients'])->middleware(['admin', 'doctor']);
//     Route::get('/diagnoses/{patient_id}', [DoctorController::class, 'viewDiagnoses'])->middleware(['doctor', 'patient']);
//     Route::post('/diagnoses', [DoctorController::class, 'addDiagnosis'])->middleware('doctor');
//     Route::get('/treatments/{diagnosis_id}', [DoctorController::class, 'viewTreatments'])->middleware(['doctor', 'patient']);
//     Route::post('/treatments', [DoctorController::class, 'addTreatment'])->middleware('doctor');
// });
// Doctor CRUD routes

// Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
// Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
// Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
// Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');  
    Route::delete('/admin/doctors/{doctor}', [AdminController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/admin/doctors/manage/{id?}', [AdminController::class, 'editdoctors'])->name('doctors.update');
    Route::POST('admin//doctors/{id}', [AdminController::class, 'updatesdoctor'])->name('doctors.updatesubmit');
    Route::POST('/admin/add/data', [AdminController::class, 'add'])->name('doctors.add');
    Route::get('/admin/patient/data', [AdminController::class, 'get_list'])->name('manage.patient'); 
    Route::POST('/admin/patients/add', [AdminController::class, 'createpatients'])->name('patients.add');
    
    Route::get('/admin/patients/manage/{id?}', [AdminController::class, 'editpatients'])->name('patients.update'); 
    Route::delete('/admin/patients/{patients}', [AdminController::class, 'destroy_patients'])->name('patients.destroy'); 
    Route::PUT('/admin/patients/{id}', [AdminController::class, 'updatespatients'])->name('patients.updatesubmit');
    Route::get('/admin/pasthistory', [AdminController::class, 'past_history'])->name('admin.history');  
    Route::get('/patient/history/{id}/download', [AdminController::class, 'downloadHistory'])->name('patient.history.download');

});

Route::middleware('doctor')->group(function () {
   
Route::get('/doctor/dashboard', [DoctorController::class, 'doctor_dashboard'])->name('doctor.dashboard'); 
Route::get('/doctor/diagnoses/manage/{id?}', [DoctorController::class, 'editdiagnoses'])->name('diagnoses.update');
Route::PUT('/doctor/diagnoses/{id}', [DoctorController::class, 'updatesdiagnoses'])->name('diagnoses.updatesubmit');
Route::POST('/doctor/diagnoses/add', [DoctorController::class, 'creatediagnoses'])->name('diagnoses.add');
Route::delete('/doctor/diagnoses/{doctor}', [DoctorController::class, 'diagnoses_destroy'])->name('diagnoses.destroy');
Route::get('/doctor/treatment/manage/{id?}', [DoctorController::class, 'edittreatment'])->name('treatment.update');
Route::PUT('/doctor/treatment/{id}', [DoctorController::class, 'updatestreatment'])->name('treatment.updatesubmit');
Route::POST('/doctor/treatment/add', [DoctorController::class, 'createtreatment'])->name('treatment.add');
Route::delete('/doctor/treatment/{doctor}', [DoctorController::class, 'treatment_destroy'])->name('treatment.destroy');
Route::get('/doctor/treatment/data', [DoctorController::class, 'get_treatment_list'])->name('manage.treatment'); 
});

Route::middleware('patient')->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'treatment_dashboard'])->name('treatment.dashboard');
    Route::get('/diagnoses/dashboard', [PatientController::class, 'diagnosis_dashboard'])->name('diagnoses.dashboard'); 
    
    
    
});