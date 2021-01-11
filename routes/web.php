<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
Route::get('/user/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');
Route::get('/doctor/home', [App\Http\Controllers\Doctor\HomeController::class, 'index'])->name('doctor.home');
Route::get('/patient/home', [App\Http\Controllers\Patient\HomeController::class, 'index'])->name('patient.home');

// Patient Routes
Route::get('/patient', [App\Http\Controllers\Patient\HomeController::class, 'index'])->name('patient.patients.index');
Route::get('/patient/profile', [App\Http\Controllers\Patient\HomeController::class, 'show'])->name('patient.patients.show');
Route::get('/patient/visits/{id}', [App\Http\Controllers\Patient\VisitController::class, 'show'])->name('patient.visits.show');
Route::get('/patient/visits/cancel/{id}', [App\Http\Controllers\Patient\VisitController::class, 'cancel'])->name('patient.visits.cancel');

// Doctor Routes
Route::get('/doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'index'])->name('doctor.doctors.index');
Route::get('/doctor/{id} ', [App\Http\Controllers\Doctor\DoctorController::class, 'show'])->name('doctor.doctors.show');
Route::get('/doctor/doctors/{id}/edit', [App\Http\Controllers\Doctor\DoctorController::class, 'edit'])->name('doctor.doctors.edit');
Route::put('/doctor/doctors/{id} ', [App\Http\Controllers\Doctor\DoctorController::class, 'update'])->name('doctor.doctors.update');

Route::get('/doctor/visits', [App\Http\Controllers\Doctor\VisitController::class, 'index'])->name('doctor.visits.index');
Route::get('/doctor/visits/create ', [App\Http\Controllers\Doctor\VisitController::class, 'create'])->name('doctor.visits.create');
Route::get('/doctor/visits/{id}', [App\Http\Controllers\Doctor\VisitController::class, 'show'])->name('doctor.visits.show');
Route::post('/doctor/visits/store ', [App\Http\Controllers\Doctor\VisitController::class, 'store'])->name('doctor.visits.store');
Route::get('/doctor/visits/{id}/edit', [App\Http\Controllers\Doctor\VisitController::class, 'edit'])->name('doctor.visits.edit');
Route::put('/doctor/visits/{id} ', [App\Http\Controllers\Doctor\VisitController::class, 'update'])->name('doctor.visits.update');
Route::delete('/doctor/visits/{id}', [App\Http\Controllers\Doctor\VisitController::class, 'destroy'])->name('doctor.visits.destroy');

Route::get('/doctor/patients ', [App\Http\Controllers\Doctor\PatientController::class, 'index'])->name('doctor.patients.index');
Route::get('/doctor/patients/create', [App\Http\Controllers\Doctor\PatientController::class, 'create'])->name('doctor.patients.create');
Route::get('/doctor/patients/{id} ', [App\Http\Controllers\Doctor\PatientController::class, 'show'])->name('doctor.patients.show');
Route::post('/doctor/patients/store', [App\Http\Controllers\Doctor\PatientController::class, 'store'])->name('doctor.patients.store');
Route::get('/doctor/patients/{id}/edit', [App\Http\Controllers\Doctor\PatientController::class, 'edit'])->name('doctor.patients.edit');
Route::put('/doctor/patients/{id}', [App\Http\Controllers\Doctor\PatientController::class, 'update'])->name('doctor.patients.update');
Route::delete('/doctor/patients/{id} ', [App\Http\Controllers\Doctor\PatientController::class, 'destroy'])->name('doctor.patients.destroy');

// Admin Routes
Route::get('/admin/doctors', [App\Http\Controllers\Admin\DoctorController::class, 'index'])->name('admin.doctors.index');
Route::get('/admin/doctors/create', [App\Http\Controllers\Admin\DoctorController::class, 'create'])->name('admin.doctors.create');
Route::get('/admin/doctors/{id}', [App\Http\Controllers\Admin\DoctorController::class, 'show'])->name('admin.doctors.show');
Route::post('/admin/doctors/store', [App\Http\Controllers\Admin\DoctorController::class, 'store'])->name('admin.doctors.store');
Route::get('/admin/doctors/{id}/edit ', [App\Http\Controllers\Admin\DoctorController::class, 'edit'])->name('admin.doctors.edit');
Route::put('/admin/doctors/{id}', [App\Http\Controllers\Admin\DoctorController::class, 'update'])->name('admin.doctors.update');
Route::delete('/admin/doctors/{id} ', [App\Http\Controllers\Admin\DoctorController::class, 'destroy'])->name('admin.doctors.destroy');

Route::get('/admin/patients', [App\Http\Controllers\Admin\PatientController::class, 'index'])->name('admin.patients.index');
Route::get('/admin/patients/create', [App\Http\Controllers\Admin\PatientController::class, 'create'])->name('admin.patients.create');
Route::get('/admin/patients/{id}', [App\Http\Controllers\Admin\PatientController::class, 'show'])->name('admin.patients.show');
Route::post('/admin/patients/store', [App\Http\Controllers\Admin\PatientController::class, 'store'])->name('admin.patients.store');
Route::get('/admin/patients/{id}/edit', [App\Http\Controllers\Admin\PatientController::class, 'edit'])->name('admin.patients.edit');
Route::put('/admin/patients/{id}', [App\Http\Controllers\Admin\PatientController::class, 'update'])->name('admin.patients.update');
Route::delete('/admin/patients/{id}', [App\Http\Controllers\Admin\PatientController::class, 'destroy'])->name('admin.patients.destroy');

Route::get('/admin/visits', [App\Http\Controllers\Admin\VisitController::class, 'index'])->name('admin.visits.index');
Route::get('/admin/visits/create', [App\Http\Controllers\Admin\VisitController::class, 'create'])->name('admin.visits.create');
Route::get('/admin/visits/{id} ', [App\Http\Controllers\Admin\VisitController::class, 'show'])->name('admin.visits.show');
Route::post('/admin/visits/store', [App\Http\Controllers\Admin\VisitController::class, 'store'])->name('admin.visits.store');
Route::get('/admin/visits/{id}/edit ', [App\Http\Controllers\Admin\VisitController::class, 'edit'])->name('admin.visits.edit');
Route::put('/admin/visits/{id}', [App\Http\Controllers\Admin\VisitController::class, 'update'])->name('admin.visits.update');
Route::delete('/admin/visits/{id} ', [App\Http\Controllers\Admin\VisitController::class, 'destroy'])->name('admin.visits.destroy');