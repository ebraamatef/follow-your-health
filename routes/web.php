<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patient\PatientsController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\Doctor\DoctorsController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationsController;
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
Route::get('/patient/profile/edit', [PatientsController::class, 'edit_profile'])->name('patient.profile');

Route::put('/patient/profile/settings', [PatientsController::class, 'edit_setting'])->name('patient.setting');
Route::put('/patient/profile/contact', [PatientsController::class, 'edit_contact'])->name('patient.contact');
Route::put('/patient/profile/general', [PatientsController::class, 'edit_general'])->name('patient.contact');

Route::get('/patient/medical-profile', [PatientsController::class, 'medical_profile'])->name('patient.medical.profile'); 

Route::get('/patient/profile/health/edit', [PatientsController::class, 'health_create'])->name('patient.health');

Route::get('/patient/profile/health/mental', [PatientsController::class, 'mental'])->name('patient.mental');

//========== Doctors Routes ==============
Route::get('/patient/doctors/index', [PatientsController::class, 'index_doctors'])->name('patient.index.doctors');
Route::get('/patient/doctors/find', [PatientsController::class, 'find_doctors'])->name('patient.find.doctors');
Route::get('/patient/doctors/profile/{doctor_id}', [PatientsController::class, 'doctor_profile'])->name('patient.profile.doctors');
Route::get('/patient/doctors/search', [PatientsController::class, 'search_doctors'])->name('patient.search.doctors');
Route::delete('/patient/doctors/remove', [PatientsController::class, 'doctor_remove'])->name('patient.delete.doctors');

Route::get('/patient/doctors/requests/{notif_id?}', [PatientsController::class, 'requests_doctors'])->name('patient.requests.doctors');
Route::post('/patient/doctors/accept_request', [PatientsController::class, 'accept_doctor_requests'])->name('patient.accept.requests.doctors');
Route::post('/patient/doctors/delete_request', [PatientsController::class, 'delete_doctor_requests'])->name('patient.delete.requests.doctors');


Route::get('/patient/doctors/chat/{doctor_id}', [PatientsController::class, 'doctor_chat_index'])->name('patient.chat.index.doctors');



//========== lab Routes ==============
Route::get('/patient/labs/index', [PatientsController::class, 'index_labs'])->name('patient.index.labs');
Route::get('/patient/labs/find', [PatientsController::class, 'find_labs'])->name('patient.find.labs');
Route::get('/patient/labs/profile/{lab_id}', [PatientsController::class, 'lab_profile'])->name('patient.profile.labs');
Route::get('/patient/labs/search', [PatientsController::class, 'search_labs'])->name('patient.search.labs');
Route::delete('/patient/labs/remove', [PatientsController::class, 'lab_remove'])->name('patient.delete.labs');

Route::get('/patient/labs/requests/{notif_id?}', [PatientsController::class, 'requests_labs'])->name('patient.requests.labs');
Route::post('/patient/labs/accept_request', [PatientsController::class, 'accept_lab_requests'])->name('patient.accept.requests.labs');
Route::post('/patient/labs/delete_request', [PatientsController::class, 'delete_lab_requests'])->name('patient.delete.requests.labs');

Route::get('/patient/labs/chat/{lab_id}', [PatientsController::class, 'lab_chat_index'])->name('patient.chat.index.lab');


//========== Allergies Routes ==============
Route::get('/patient/allergies/index/{notif_id?}', [PatientsController::class, 'index_allergies'])->name('patient.index.allergies');
Route::delete('/patient/allergies/delete', [PatientsController::class, 'destroy_allergies'])->name('patient.delete.allergies');
Route::post('/patient/allergies/create', [PatientsController::class, 'create_allergies'])->name('patient.create.allergies');
Route::get('/patient/allergies/edit/{id}', [PatientsController::class, 'edit_allergies'])->name('patient.edit.allergies');
Route::post('/patient/allergies/update', [PatientsController::class, 'update_allergies'])->name('patient.update.allergies');


//========== Surgeries Routes ==============
Route::delete('/patient/surgeries/delete', [PatientsController::class, 'destroy_surgeries'])->name('patient.delete.surgeries');
Route::get('/patient/surgeries/index/{notif_id?}', [PatientsController::class, 'index_surgeries'])->name('patient.index.surgeries');
Route::post('/patient/surgeries/create', [PatientsController::class, 'create_surgeries'])->name('patient.create.surgeries');
Route::get('/patient/surgeries/edit', [PatientsController::class, 'edit_surgeries'])->name('patient.edit.surgeries');
Route::post('/patient/surgeries/update', [PatientsController::class, 'update_surgeries'])->name('patient.update.surgeries');


//========== Lab Tests Routes ==============
Route::get('/patient/tests/index/{notif_id?}', [PatientsController::class, 'index_tests'])->name('patient.index.tests');
Route::get('/patient/tests/search', [PatientsController::class, 'search_tests'])->name('patient.search.tests');
Route::post('/patient/tests/create', [PatientsController::class, 'create_test'])->name('patient.search.tests');
Route::delete('/patient/tests/delete', [PatientsController::class, 'delete_test'])->name('patient.search.tests');
Route::post('/patient/tests/update/{test_id}', [PatientsController::class, 'update_test'])->name('patient.update.tests');


//========== Radiology Routes ==============
Route::get('/patient/radiology/index/{notif_id?}', [PatientsController::class, 'index_radiology'])->name('patient.index.radiology');
Route::get('/patient/radiology/search', [PatientsController::class, 'search_radiology'])->name('patient.search.radiology');
Route::post('/patient/radiology/create', [PatientsController::class, 'create_radiology'])->name('patient.search.radiology');
Route::delete('/patient/radiology/delete', [PatientsController::class, 'delete_radiology'])->name('patient.search.radiology');
Route::post('/patient/radiology/update/{radiology_id}', [PatientsController::class, 'update_radiology'])->name('patient.update.radiology');


//========== Visit Routes ==============
Route::get('/patient/visits/index', [PatientsController::class, 'index_visits'])->name('patient.index.visits');
Route::get('/patient/visits/details/{visit_id}', [PatientsController::class, 'visit_details'])->name('patient.details.visits');
Route::get('/patient/visits/details/iframe/{visit_id}', [PatientsController::class, 'visit_details_iframe'])->name('patient.details.iframe.visits');
Route::get('/patient/visits/search', [PatientsController::class, 'search_visits'])->name('patient.search.visits');


//========== Medication Routes ==============
Route::get('/patient/medication/prescriptions/index/{notif_id?}', [PatientsController::class, 'prescriptions_index'])->name('patient.medication.prescriptions.index');
Route::get('/patient/medication/prescriptions/search', [PatientsController::class, 'prescriptions_search'])->name('patient.medication.prescriptions.search');

Route::get('/patient/medication/offTheCounter/index', [PatientsController::class, 'offmeds_index'])->name('patient.offmeds.index');
Route::get('/patient/medication/offTheCounter/search', [PatientsController::class, 'offmeds_search'])->name('patient.offmeds.search');
Route::post('/patient/medication/offTheCounter/create', [PatientsController::class, 'offmeds_create'])->name('patient.offmeds.create');
Route::post('/patient/medication/offTheCounter/update/{med_id}', [PatientsController::class, 'offmeds_update'])->name('patient.offmeds.update');
Route::delete('/patient/medication/offTheCounter/delete', [PatientsController::class, 'offmeds_delete'])->name('patient.offmeds.delete');


//========== Medical Conditions Routes ==============
Route::get('/patient/conditions/index/{notif_id?}', [PatientsController::class, 'conditions_index'])->name('patient.conditions.index');
Route::post('/patient/conditions/create', [PatientsController::class, 'conditions_create'])->name('patient.conditions.create');
Route::delete('/patient/conditions/delete', [PatientsController::class, 'conditions_delete'])->name('patient.conditions.delete');


//========== Family History Routes ==============
Route::get('/patient/family/index', [PatientsController::class, 'family_index'])->name('patient.family.index');
Route::post('/patient/family/create', [PatientsController::class, 'family_create'])->name('patient.family.create');
Route::delete('/patient/family/delete', [PatientsController::class, 'family_delete'])->name('patient.family.delete');


//========== BP log Routes ==============
Route::get('/patient/readings', [PatientsController::class, 'readings_index'])->name('patient.bp.index');
Route::post('/patient/readings/bp/create', [PatientsController::class, 'bp_create'])->name('patient.bp.create');
Route::delete('/patient/readings/bp/delete', [PatientsController::class, 'bp_delete'])->name('patient.bp.delete');


//========== BS log Routes ==============
Route::get('/patient/readings/bs/index', [PatientsController::class, 'bs_index'])->name('patient.bs.index');
Route::post('/patient/readings/bs/create', [PatientsController::class, 'bs_create'])->name('patient.bs.create');
Route::delete('/patient/readings/bs/delete', [PatientsController::class, 'bs_delete'])->name('patient.bs.delete');


//=====================================================================================================================

//=================================== Doctor Routes ==================================================================

//=====================================================================================================================

Route::get('/doctor/home', [DoctorsController::class, 'index'])->name('patient.home');

//========== Profile Routes ==============
Route::get('/doctor/profile/create', [DoctorsController::class, 'create'])->name('doctor.create');
Route::get('/doctor/profile/index', [DoctorsController::class, 'index_profile'])->name('doctor.index.profile');
Route::get('/doctor/profile/edit', [DoctorsController::class, 'edit_profile'])->name('doctor.edit.profile');
Route::post('/doctor/profile/update', [DoctorsController::class, 'update_profile'])->name('doctor.update.profile');

//========== doctors Routes ==============
Route::get('/doctor/patient/doctors/{patient_id}', [DoctorsController::class, 'doctors_index'])->name('doctor.patient.doctors');
Route::get('/doctor/doctors/profile/{doctor_id}', [DoctorsController::class, 'doctors_profile'])->name('doctor.doctors.profile');
Route::get('/doctor/doctors/search', [DoctorsController::class, 'doctors_search'])->name('doctor.doctors.search');

//========== Patients Routes ==============
Route::get('/doctor/patients/index', [DoctorsController::class, 'mypatients_index'])->name('doctor.index.patient');
Route::get('/doctor/patients/find', [DoctorsController::class, 'allpatients_index'])->name('doctor.index.patient');
Route::get('/doctor/patients/profile/{patient_id}', [DoctorsController::class, 'patient_profile'])->name('doctor.full.profile.patient');
Route::get('/doctor/patients/profile_x/{patient_id}', [DoctorsController::class, 'patient_profile_x'])->name('doctor.full.profile_x.patient');
Route::get('/doctor/patients/search', [DoctorsController::class, 'search_patient'])->name('doctor.search.patient');
Route::delete('/doctor/patients/remove', [DoctorsController::class, 'patient_remove'])->name('doctor.delete.patient');

Route::get('/doctor/patient/chat/{patient_id}', [DoctorsController::class, 'chat_index'])->name('patient.chat.index.patients');


//========== Requests Routes ==============
Route::get('/doctor/requests/index', [DoctorsController::class, 'index_requests'])->name('doctor.create.requests');
Route::post('/doctor/requests/create', [DoctorsController::class, 'create_requests'])->name('doctor.create.requests');
Route::post('/doctor/requests/delete', [DoctorsController::class, 'destroy_requests'])->name('doctor.delete.requests');

//========== Allergies Routes ==============
Route::get('/doctor/allergies/index/{patient_id}', [DoctorsController::class, 'index_allergies'])->name('doctor.index.allergies');
Route::delete('/doctor/allergies/delete', [DoctorsController::class, 'destroy_allergies'])->name('doctor.delete.allergies');
Route::post('/doctor/allergies/create', [DoctorsController::class, 'create_allergies'])->name('doctor.create.allergies');
Route::get('/doctor/allergies/edit/{id}', [DoctorsController::class, 'edit_allergies'])->name('doctor.edit.allergies');
Route::post('/doctor/allergies/update', [DoctorsController::class, 'update_allergies'])->name('doctor.update.allergies');


//========== Surgeries Routes ==============
Route::get('/doctor/surgeries/index/{patient_id}', [DoctorsController::class, 'index_surgeries'])->name('doctor.index.surgeries');
Route::delete('/doctor/surgeries/delete', [DoctorsController::class, 'destroy_surgeries'])->name('doctor.delete.surgeries');
Route::post('/doctor/surgeries/create', [DoctorsController::class, 'create_surgeries'])->name('doctor.create.surgeries');
Route::get('/doctor/surgeries/edit', [DoctorsController::class, 'edit_surgeries'])->name('doctor.edit.surgeries');
Route::post('/doctor/surgeries/update', [DoctorsController::class, 'update_surgeries'])->name('doctor.update.surgeries');


//========== Lab Tests Routes ==============
Route::get('/doctor/tests/index/{patient_id}', [DoctorsController::class, 'index_tests'])->name('doctor.index.tests');
Route::get('/doctor/tests/search', [DoctorsController::class, 'search_tests'])->name('doctor.search.tests');


//========== Radiology Routes ==============
Route::get('/doctor/radiology/index/{patient_id}', [DoctorsController::class, 'index_radiology'])->name('doctor.index.radiology');
Route::get('/doctor/radiology/search', [DoctorsController::class, 'search_radiology'])->name('doctor.search.radiology');


//========== Visit Routes ==============
Route::get('/doctor/visits/index/{patient_id}', [DoctorsController::class, 'index_visits'])->name('doctor.index.visits');
Route::get('/doctor/visits/details/{visit_id}', [DoctorsController::class, 'details_visits'])->name('doctor.index.details.visits');
Route::get('/doctor/visits/details/iframe/{visit_id}', [DoctorsController::class, 'iframe_details_visits'])->name('doctor.index.details.visits');


Route::get('/doctor/visits/new/{patient_id}', [DoctorsController::class, 'new_visit'])->name('doctor.new.visits');

Route::post('/doctor/visits/create', [DoctorsController::class, 'create_visit'])->name('doctor.create.visits');
Route::get('/doctor/visits/edit/{visit_id}', [DoctorsController::class, 'edit_visits'])->name('doctor.edit.visits');
Route::post('/doctor/visits/update', [DoctorsController::class, 'update_visits'])->name('doctor.update.visits');
Route::delete('/doctor/visits/delete', [DoctorsController::class, 'destroy_visits'])->name('doctor.delete.visits');
Route::get('/doctor/visits/search', [DoctorsController::class, 'search_visits'])->name('doctor.search.visits');

                                            ///==== iframe Routes =====
Route::get('/doctor/visit/iframe/allergies/{patient_id}', [DoctorsController::class, 'allergies_iframe'])->name('doctor.visit.iframe.allergies');
Route::get('/doctor/visit/iframe/search/allergies', [DoctorsController::class, 'search_allergies_iframe'])->name('doctor.visit.iframe.search.allergies');

Route::get('/doctor/visit/iframe/visits/{patient_id}', [DoctorsController::class, 'visits_iframe'])->name('doctor.visit.iframe.visits');
Route::get('/doctor/visits/iframe/search', [DoctorsController::class, 'search_visits_iframe'])->name('doctor.visit.iframe.search.visits');


Route::get('/doctor/visit/iframe/tests/{patient_id}', [DoctorsController::class, 'tests_iframe'])->name('doctor.visit.iframe.tests');
Route::get('/doctor/visit/iframe/search/tests', [DoctorsController::class, 'search_tests_iframe'])->name('doctor.visit.iframe.search.tests');

Route::get('/doctor/visit/iframe/radiology/{patient_id}', [DoctorsController::class, 'radiology_iframe'])->name('doctor.visit.iframe.radiology');
Route::get('/doctor/visit/iframe/search/radiology', [DoctorsController::class, 'search_radiology_iframe'])->name('doctor.visit.iframe.search.radiology');

Route::get('/doctor/visit/iframe/surgeries/{patient_id}', [DoctorsController::class, 'surgeries_iframe'])->name('doctor.visit.iframe.surgeries');

Route::get('/doctor/visit/iframe/readings/{patient_id}', [DoctorsController::class, 'readings_bloodpressure_iframe'])->name('doctor.visit.iframe.bp.readings');
Route::get('/doctor/visit/iframe/readings/blood-sugar/{patient_id}', [DoctorsController::class, 'readings_bloodsugar_iframe'])->name('doctor.visit.iframe.bs.readings');

Route::get('/doctor/visit/iframe/medical-profile/{patient_id}', [DoctorsController::class, 'medical_profile_iframe'])->name('doctor.visit.iframe.medical_profile');

Route::get('/doctor/visit/iframe/family/{patient_id}', [DoctorsController::class, 'family_iframe'])->name('doctor.visit.iframe.family');

Route::get('/doctor/visit/iframe/conditions/{patient_id}', [DoctorsController::class, 'conditions_iframe'])->name('doctor.visit.iframe.conditions');

                    
//========== Medication Routes ==============
Route::get('/doctor/medication/prescriptions/index/{patient_id}', [DoctorsController::class, 'prescriptions_index'])->name('doctor.index.medication.prescriptions');
Route::delete('/doctor/prescription/delete', [DoctorsController::class, 'destroy_prescription'])->name('doctor.destroy.prescription');
Route::post('/doctor/prescription/create', [DoctorsController::class, 'create_prescription'])->name('doctor.create.prescription');
Route::post('/doctor/prescription/update', [DoctorsController::class, 'update_prescription'])->name('doctor.update.prescription');
Route::get('/doctor/prescription/search', [DoctorsController::class, 'search_prescription'])->name('doctor.search.prescription');


Route::get('/doctor/medication/offTheCounter/index/{patient_id}', [DoctorsController::class, 'offmeds_index'])->name('doctor.offmeds.index');
Route::get('/doctor/medication/offTheCounter/search', [DoctorsController::class, 'offmeds_search'])->name('doctor.offmeds.search');

//========== Medical Conditions Routes ==============
Route::get('/doctor/conditions/index/{patient_id}', [DoctorsController::class, 'conditions_index'])->name('doctor.conditions.index');
Route::post('/doctor/conditions/create', [DoctorsController::class, 'conditions_create'])->name('doctor.conditions.create');
Route::delete('/doctor/conditions/delete', [DoctorsController::class, 'conditions_delete'])->name('doctor.conditions.delete');

//========== Family History Routes ==============
Route::get('/doctor/family/index/{patient_id}', [DoctorsController::class, 'family_index'])->name('patient.family.index');

//========== BP log Routes ==============
Route::get('/doctor/readings/{patient_id}', [DoctorsController::class, 'readings_index'])->name('doctor.bp.index');


//========== BS log Routes ==============
Route::get('/doctor/readings/bs/index/{patient_id}', [DoctorsController::class, 'bs_index'])->name('doctor.bs.index');


//========== Medical Profile Routes ==============
Route::get('/doctor/patient/medical-profile/{patient_id}', [DoctorsController::class, 'medical_profile'])->name('doctor.patient.medical_profile'); 


//=====================================================================================================================

//=================================== Lab Routes ==================================================================

//=====================================================================================================================

Route::get('/lab/home', [LabController::class, 'index'])->name('lab.home');

//========== Profile Routes ==============
Route::get('/lab/profile/index', [LabController::class, 'index_profile'])->name('lab.index.profile');
Route::get('/lab/profile/edit', [LabController::class, 'edit_profile'])->name('lab.edit.profile');
Route::post('/lab/profile/update', [LabController::class, 'update_profile'])->name('lab.update.profile');


//========== Patient Routes ==============
Route::get('/lab/patients/index', [LabController::class, 'mypatients_index'])->name('lab.patients.mypatients');
Route::get('/lab/patients/profile/{patient_id}', [LabController::class, 'patient_profile'])->name('lab.patients.profile');
Route::get('/lab/patients/profile_x/{patient_id}', [LabController::class, 'patient_profile_x'])->name('lab.patients.profile_x');
Route::get('/lab/patients/search', [LabController::class, 'search_patient'])->name('lab.patients.search');
Route::get('/lab/patients/find', [LabController::class, 'allpatients_index'])->name('lab.patients.allpatients');
Route::delete('/lab/patients/remove', [LabController::class, 'patient_remove'])->name('lab.patients.remove');

Route::get('/lab/patients/chat/{patient_id}', [LabController::class, 'chat_index'])->name('patient.chat.index.patients');

//========== Radiology Routes ==============
Route::get('/lab/radiology/{id}', [LabController::class, 'index_radiology'])->name('lab.index.radiology');
Route::get('/lab/patients/radiology/search', [LabController::class, 'search_radiology'])->name('lab.search.radiology');
Route::post('/lab/radiology/create', [LabController::class, 'create_radiology'])->name('lab.create.radiology');
Route::post('/lab/radiology/update/{id}', [LabController::class, 'update_radiology'])->name('lab.update.radilogy');
Route::delete('/lab/radiology/delete', [LabController::class, 'destroy_radiology'])->name('lab.delete.radiology');


//========== Requests Routes ==============
Route::get('/lab/requests/index', [LabController::class, 'index_requests'])->name('lab.create.requests');
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


