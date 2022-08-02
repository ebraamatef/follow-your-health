<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patient\PatientsController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\Doctor\DoctorsController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PatientProfile;
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

Auth::routes();

Route::get('/', function(){
    return view('welcome');
});

Route::get('/check', [CheckController::class, 'index'])->name('check');


//=================================== Patient Routes ==================================================================

Route::get('/patient/home', [PatientsController::class, 'index'])->name('patient.home');

//========== Profile Routes ==============
Route::put('/patient/profile/settings', [PatientsController::class, 'edit_setting'])->name('patient.setting');
Route::put('/patient/profile/contact', [PatientsController::class, 'edit_contact'])->name('patient.contact');
Route::put('/patient/profile/general', [PatientsController::class, 'edit_general'])->name('patient.contact');

Route::get('/patient/profile/edit', function(){
    $user=Auth::user();
    return view('patient.profile.edit',compact('user'));
});

Route::get('/patient/profile/index', [PatientsController::class, 'index'])->name('patient.index');
Route::get('/patient/profile/update', [PatientsController::class, 'update'])->name('patient.update');
Route::get('/patient/profile/health', function(){
    $test= PatientProfile::where('patient_id',  $user=Auth::user()->patient->id)->first();
        return view('patient.profile.health_habits',compact('test'));
});

Route::get('/patient/profile/health/edit', [PatientsController::class, 'health_create'])->name('patient.health');

Route::get('/patient/profile/health/mental', [PatientsController::class, 'mental'])->name('patient.mental');



//========== Doctors Routes ==============
Route::get('/patient/doctors/index', [PatientsController::class, 'index_doctors'])->name('patient.index.doctors');
Route::post('/patient/doctors/search', [PatientsController::class, 'search_doctors'])->name('patient.search.doctors');
Route::get('/patient/doctors/delete', [PatientsController::class, 'destroy_doctors'])->name('patient.delete.doctors');


//========== Requests Routes ==============
Route::get('/patient/requests/index', [PatientsController::class, 'index_requests'])->name('patient.index.requests');
Route::post('/patient/requests/accept', [PatientsController::class, 'accept_requests'])->name('patient.accept.requests');
Route::delete('/patient/requests/delete', [PatientsController::class, 'destroy_requests'])->name('patient.delete.requests');


//========== Allergies Routes ==============
Route::get('/patient/allergies/index', [PatientsController::class, 'index_allergies'])->name('patient.index.allergies');
Route::delete('/patient/allergies/delete', [PatientsController::class, 'destroy_allergies'])->name('patient.delete.allergies');
Route::post('/patient/allergies/create', [PatientsController::class, 'create_allergies'])->name('patient.create.allergies');
Route::get('/patient/allergies/edit/{id}', [PatientsController::class, 'edit_allergies'])->name('patient.edit.allergies');
Route::post('/patient/allergies/update', [PatientsController::class, 'update_allergies'])->name('patient.update.allergies');


//========== Surgeries Routes ==============
Route::delete('/patient/surgeries/delete', [PatientsController::class, 'destroy_surgeries'])->name('patient.delete.surgeries');
Route::get('/patient/surgeries/index', [PatientsController::class, 'index_surgeries'])->name('patient.index.surgeries');
Route::post('/patient/surgeries/create', [PatientsController::class, 'create_surgeries'])->name('patient.create.surgeries');
Route::get('/patient/surgeries/edit', [PatientsController::class, 'edit_surgeries'])->name('patient.edit.surgeries');
Route::post('/patient/surgeries/update', [PatientsController::class, 'update_surgeries'])->name('patient.update.surgeries');


//========== Lab Tests Routes ==============
Route::get('/patient/tests/index', [PatientsController::class, 'index_tests'])->name('patient.index.tests');
Route::get('/patient/tests/search', [PatientsController::class, 'search_tests'])->name('patient.search.tests');


//========== Radiology Routes ==============
Route::get('/patient/radiology/index', [PatientsController::class, 'index_radiology'])->name('patient.index.radiology');
Route::get('/patient/radiology/search', [PatientsController::class, 'search_radiology'])->name('patient.search.radiology');


//========== Visit Routes ==============
Route::get('/patient/visits/index', [PatientsController::class, 'index_visits'])->name('patient.index.visits');
Route::get('/patient/visits/index/details', [PatientsController::class, 'index_details_visits'])->name('patient.index.details.visits');
Route::get('/patient/visits/search', [PatientsController::class, 'search_visits'])->name('patient.search.visits');


//========== Medication Routes ==============
Route::get('/patient/medication/index', [PatientsController::class, 'index_medication'])->name('patient.index.medication');
Route::get('/patient/medication/delete', [PatientsController::class, 'destroy_medication'])->name('patient.delete.medication');
Route::get('/patient/medication/create', [PatientsController::class, 'create_medication'])->name('patient.create.medication');
Route::get('/patient/medication/edit', [PatientsController::class, 'edit_medication'])->name('patient.edit.medication');

//=====================================================================================================================

//=================================== Doctor Routes ==================================================================

//=====================================================================================================================

Route::get('/doctor/home', [DoctorsController::class, 'index'])->name('patient.home');

//========== Profile Routes ==============
Route::get('/doctor/profile/create', [DoctorsController::class, 'create'])->name('doctor.create');
Route::get('/doctor/profile/index', [DoctorsController::class, 'index_profile'])->name('doctor.index.profile');
Route::get('/doctor/profile/edit', [DoctorsController::class, 'edit_profile'])->name('doctor.edit.profile');
Route::post('/doctor/profile/update', [DoctorsController::class, 'update_profile'])->name('doctor.update.profile');


//========== Patients Routes ==============
Route::get('/doctor/patient/index', [DoctorsController::class, 'index_patient'])->name('doctor.index.patient');
Route::post('/doctor/patient/profile', [DoctorsController::class, 'patient_profile'])->name('doctor.index.patient');
Route::get('/doctor/patient/search', [DoctorsController::class, 'search_patient'])->name('doctor.search.patient');
Route::get('/doctor/patient/delete', [DoctorsController::class, 'destroy_patient'])->name('doctor.delete.patient');


//========== Requests Routes ==============
Route::post('/doctor/requests/create', [DoctorsController::class, 'create_requests'])->name('doctor.create.requests');
Route::post('/doctor/requests/delete', [DoctorsController::class, 'destroy_requests'])->name('doctor.delete.requests');


//========== Allergies Routes ==============
Route::post('/doctor/allergies/index', [DoctorsController::class, 'index_allergies'])->name('doctor.index.allergies');
Route::delete('/doctor/allergies/delete', [DoctorsController::class, 'destroy_allergies'])->name('doctor.delete.allergies');
Route::post('/doctor/allergies/create', [DoctorsController::class, 'create_allergies'])->name('doctor.create.allergies');
Route::get('/doctor/allergies/edit/{id}', [DoctorsController::class, 'edit_allergies'])->name('doctor.edit.allergies');
Route::post('/doctor/allergies/update', [DoctorsController::class, 'update_allergies'])->name('doctor.update.allergies');


//========== Surgeries Routes ==============
Route::post('/doctor/surgeries/index', [DoctorsController::class, 'index_surgeries'])->name('doctor.index.surgeries');
Route::delete('/doctor/surgeries/delete', [DoctorsController::class, 'destroy_surgeries'])->name('doctor.delete.surgeries');
Route::post('/doctor/surgeries/create', [DoctorsController::class, 'create_surgeries'])->name('doctor.create.surgeries');
Route::get('/doctor/surgeries/edit', [DoctorsController::class, 'edit_surgeries'])->name('doctor.edit.surgeries');
Route::post('/doctor/surgeries/update', [DoctorsController::class, 'update_surgeries'])->name('doctor.update.surgeries');


//========== Lab Tests Routes ==============
Route::get('/patient/tests/index', [PatientsController::class, 'index_tests'])->name('patient.index.tests');
Route::get('/patient/tests/search', [PatientsController::class, 'search_tests'])->name('patient.search.tests');
Route::post('/patient/tests/create', [PatientsController::class, 'create_test'])->name('patient.create.tests');


//========== Radiology Routes ==============
Route::get('/patient/radiology/index', [PatientsController::class, 'index_radiology'])->name('patient.index.radiology');
Route::get('/patient/radiology/search', [PatientsController::class, 'search_radiology'])->name('patient.search.radiology');
Route::post('/patient/radiology/create', [PatientsController::class, 'create_radiology'])->name('patient.create.radiology');


//========== Visit Routes ==============
Route::get('/doctor/visits/index/{patient_id}', [DoctorsController::class, 'index_visits'])->name('doctor.index.visits');
Route::get('/doctor/visits/details', [DoctorsController::class, 'details_visits'])->name('doctor.index.details.visits');

Route::post('/doctor/visits/new', [DoctorsController::class, 'new_visit'])->name('doctor.new.visits');

Route::post('/doctor/visits/create', [DoctorsController::class, 'create_visit'])->name('doctor.create.visits');
Route::get('/doctor/visits/edit', [DoctorsController::class, 'edit_visits'])->name('doctor.edit.visits');
Route::get('/doctor/visits/update', [DoctorsController::class, 'update_visits'])->name('doctor.update.visits');
Route::delete('/doctor/visits/delete', [DoctorsController::class, 'destroy_visits'])->name('doctor.delete.visits');
Route::get('/doctor/visits/search', [DoctorsController::class, 'search_visits'])->name('doctor.search.visits');


//========== Medication Routes ==============
Route::get('/doctor/medication/index/{patient_id}', [DoctorsController::class, 'index_medication'])->name('doctor.index.medication');
Route::get('/doctor/medication/delete', [DoctorsController::class, 'destroy_medication'])->name('doctor.delete.medication');
Route::get('/doctor/medication/create', [DoctorsController::class, 'create_medication'])->name('doctor.create.medication');
Route::get('/doctor/medication/edit', [DoctorsController::class, 'edit_medication'])->name('doctor.edit.medication');
Route::get('/autocomplete-search', [DoctorsController::class, 'autocompleteSearch']);


//=====================================================================================================================

//=================================== Lab Routes ==================================================================

//=====================================================================================================================

Route::get('/lab/home', [LabController::class, 'index'])->name('lab.home');

//========== Profile Routes ==============
Route::get('/lab/profile/index', [LabController::class, 'index_profile'])->name('lab.index.profile');
Route::get('/lab/profile/edit', [LabController::class, 'edit_profile'])->name('lab.edit.profile');
Route::post('/lab/profile/update', [LabController::class, 'update_profile'])->name('lab.update.profile');


//========== Patient Routes ==============
Route::post('/lab/patients/profile', [LabController::class, 'patient_profile'])->name('lab.patients.profile');
Route::get('/lab/patients/search', [LabController::class, 'search_patient'])->name('lab.patients.search');


//========== Lab Tests Routes ==============
Route::get('/lab/tests/index', [LabController::class, 'index_tests'])->name('lab.index.tests');
Route::get('/lab/tests/search', [LabController::class, 'search_tests'])->name('lab.search.tests');


//========== Radiology Routes ==============
Route::get('/lab/radiology/index/{id}', [LabController::class, 'index_radiology'])->name('lab.index.radiology');
Route::get('/lab/radiology/search', [LabController::class, 'search_radiology'])->name('lab.search.radiology');
Route::post('/lab/radiology/create', [LabController::class, 'create_radiology'])->name('lab.create.radiology');
Route::post('/lab/radiology/update/{id}', [LabController::class, 'update_radiology'])->name('lab.update.radilogy');
Route::delete('/lab/radiology/delete', [LabController::class, 'destroy_radiology'])->name('lab.delete.radiology');


//========== Requests Routes ==============
Route::post('/lab/requests/create', [LabController::class, 'create_requests'])->name('lab.create.requests');
Route::post('/lab/requests/delete', [LabController::class, 'destroy_requests'])->name('lab.delete.requests');


//========== Lab Tests Routes ==============
Route::get('/lab/patient/tests/{id}', [LabController::class, 'index_tests'])->name('lab.index.tests');
Route::get('/lab/tests/search', [LabController::class, 'search_tests'])->name('lab.search.tests');
Route::post('/lab/test/create', [LabController::class, 'create_test'])->name('lab.create.tests');
Route::delete('/lab/test/delete', [LabController::class, 'destroy_test'])->name('lab.delete.tests');
Route::post('/lab/test/update/{id}', [LabController::class, 'update_test'])->name('lab.update.tests');



//=====================================================================================================================

//=================================== Admin Routes ==================================================================

//=====================================================================================================================

Route::get('/admin/home', [AdminController::class, 'admin_index'])->name('admin_index');
Route::get('/admin/add_med', [AdminController::class, 'medication'])->name('admin_med');
