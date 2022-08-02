<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Allergy;
use App\Models\Surgery;
use App\Models\Test;
use App\Models\Radiology;
use App\Models\Medication;
use App\Models\Prescription;
use App\Models\Visit;
use App\Models\DoctorPatient;
use App\Models\DoctorRequest;
use App\Models\Family;
use App\Models\BloodPressureLog;
use App\Models\BloodSugarLog;
use App\Models\MedCondition;
use App\Models\PatientProfile;
use App\Models\OffMed;
use App\Models\Notification;
use DB;

class DoctorsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    //========== Requests functions ==============

    public function index_requests(){
        $requests = DoctorRequest::where('doctor_id', $this->user->doctor->id)->get('patient_id');
        $count = sizeof($requests);
        $patient_ids = array();
        for($i = 0; $i < $count; $i++){
            $patient_ids[$i] = $requests[$i]->patient_id;
        }
        $patients = Patient::whereIn('id', $patient_ids)->paginate(10);
        return view('doctor.patients.requests', [
            'requests' => $patients,
        ]);
    }

    public function create_requests(Request $request){
        
        DoctorRequest::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $this->user->doctor->id,
        ]);



        $patient = Patient::where('id', $request->patient_id)->get('user_id');
        $notification = "Dr. " . $this->user->name . " sent you a request";
        Notification::create([
            'sender_id' => $this->user->id,
            'sender_type' => $this->user->type,
            'sender_image' => $this->user->doctor->image,
            'reciever' => $patient[0]->user_id,
            'notification' => $notification,
            'subject' => 'request',
            'link' => 'patient/doctors/requests',
        ]);

        return back();
    }

    public function destroy_requests(Request $request){

        $doc_request = DoctorRequest::where('patient_id', $request->patient_id)->get();
        DoctorRequest::destroy($doc_request);

        return back();
    }

    //========== Patients functions ==============

    public function index(){

        return view('doctor.home', [
            'user' => $this->user,
        ]);
    }

    public function mypatients_index(){
        $myPatients = Doctor::with('patients')->where('id', $this->user->doctor->id)->get();
        $result = $myPatients[0]->patients()->paginate(10);

        return view('doctor.patients.index', [
            'user' => $this->user,
            'myPatients' => $result,
        ]);
    }

    public function allpatients_index(){

        return view('doctor.patients.find', [
            'user' => $this->user,
        ]);
    }

    public function patient_full_profile($patient_id){
        return view('doctor.patients.full_profile');
    }
    
    public function search_patient(Request $request){
        $name= $request->search_term ;
        $search_cat = $request->search_in;
        $my_patients_id = array();
        $patient_request_ids = array();

        if($request->search_in=='all')
        {
            $result = DB::table('patients')
            ->where('name', 'LIKE', '%'.$name.'%')
            ->paginate(10);
            
            $my_patients = DoctorPatient::where('doctor_id','=',$this->user->doctor->id )
                                    ->get('patient_id');
            foreach($my_patients as $my_patient){
                $my_patients_id[] = $my_patient->patient_id;
            }

            $request_ids = DoctorRequest::where('doctor_id','=',$this->user->doctor->id )
                                    ->get('patient_id');
            foreach($request_ids as $request){
                $patient_request_ids[] = $request->patient_id;
            }
        }
 
        if($request->search_in=='my')
        {
            $my_patients = Doctor::with('patients')->where('id', $this->user->doctor->id)->get();

            $result = $my_patients[0]->patients()->where('name', 'LIKE', '%'.$request->search_term .'%')->paginate(10);

            return view('doctor.patients.index', [
                'myPatients' => $result,
            ]);
        }

        return view('doctor.patients.search', [
            'patients' => $result,
            'myPatients' => $my_patients_id,
            'search_term' => $name,
            'search_in' => $search_cat,
            'request_ids' => $patient_request_ids,
        ]);
    }

    public function patient_profile(Request $request){

        $patient = Patient::where('id', $request->patient_id)->get();

        return view('doctor.patients.profile', [
            'user' => $this->user,
            'patient' => $patient,
        ]);
    }

    public function chat_index($patient_id){
        $patient = Patient::where('id', $patient_id)->get();

        return view('doctor.patients.chat', [
            'patient' => $patient,
        ]);
    }

    public function patient_profile_x(Request $request){

        $patient = Patient::where('id', $request->patient_id)->get();

        return view('doctor.patients.profile_x', [
            'user' => $this->user,
            'patient' => $patient,
        ]);
    }

    public function patient_remove(Request $request){
        $patient = DoctorPatient::where('patient_id', $request->patient_id)->get();
        DoctorPatient::destroy($patient);

        return redirect('/doctor/patients/index');
    }

    //========== Profile functions ==============
    
    public function index_profile(){

    }
    
    public function edit_profile(){
        return view('doctor.profile.edit', [
            'user' => $this->user,
        ]);
    }
    
    public function update_profile(Request $request){
        User::where('id', $this->user->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $imageName = NULL;
        if($request->image != NULL){
            $imageName = $this->user->id . '-' . $request->name . time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/doctors/' . $this->user->doctor->id), $imageName);

            Doctor::where('user_id', $this->user->id)
            ->update([
                'image' => $imageName,
            ]);
        }

        Doctor::where('user_id', $this->user->id)
        ->update([
            'name' => $request->name,
            'national_id' => $request->national_id,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'alt_phone' => $request->alt_phone,
            'speciality' => $request->speciality,
            'clinic_address' => $request->clinic_address,
        ]);
        return back();
    }
    
    //========== Doctor functions ==============
    public function doctors_index($patient_id){
        $doctors = DoctorPatient::where('patient_id', $patient_id)->get('doctor_id');
        
        $count = sizeof($doctors);
        $doctor_ids = array();
        for($i = 0; $i < $count; $i++){
            $doctor_ids[$i] = $doctors[$i]->doctor_id;
        }

        $doctors = Doctor::whereIn('id', $doctor_ids)->paginate(10);

        return view('doctor.doctors.index', [
            'doctors' => $doctors,
            'patient_id' => $patient_id,
        ]);

    }
    
    public function doctors_profile($doctor_id){
        $doctor = Doctor::where('id', $doctor_id)->get();

        return view('doctor.doctors.profile', [
            'doctor' => $doctor,
        ]);
    }

    public function doctors_search(Request $request){
        $doctors = DoctorPatient::where('patient_id', $request->patient_id)->get('doctor_id');
        $count = sizeof($doctors);
        $doctor_ids = array();
        for($i = 0; $i < $count; $i++){
            $doctor_ids[$i] = $doctors[$i]->doctor_id;
        }

        $result = Doctor::whereIn('id', $doctor_ids)->where('name', 'LIKE', '%'.$request->search_term.'%')
        ->get();

        return view('doctor.doctors.search', [
            'doctors' => $result,
            'search_term' => $request->search_term,
            'patient_id' => $request->patient_id
        ]);
    }

    
    
    //========== Allergies functions ==============

    public function index_allergies($patient_id){
        $allergies = Allergy::where('patient_id', $patient_id)->paginate(10);
        
        return view('doctor.allergies.index', [
            'user' => $this->user,
            'allergies' => $allergies,
            'patient_id' => $patient_id
        ]);
    }
    
    public function destroy_allergies(Request $request){
        Allergy::destroy('id',$request->allergy_id);
        return back();
    }
    
    public function create_allergies(Request $request){
        // dd($request->patient_id);
        $allergy = Allergy::create([
            'patient_id' => $request->patient_id,
            'allergy' => $request->allergy_name,
            'type' => $request->type,
            'status' => $request->status,
            'notes' => $request->notes,
            'doctor' => $this->user->doctor->name,
            'added_by' => $this->user->id,
        ]);

        $patient = Patient::where('id', $request->patient_id)->get('user_id');
        $notification = "Dr. " . $this->user->name . " added to your allergies";
        Notification::create([
            'sender_id' => $this->user->id,
            'sender_type' => $this->user->type,
            'sender_image' => $this->user->doctor->image,
            'reciever' => $patient[0]->user_id,
            'notification' => $notification,
            'subject' => 'allergy',
            'link' => 'patient/allergies/index',
        ]);

        // $response = response()->json($allergy); 
        // return $response;
        return back();
    }
    
    public function update_allergies(Request $request){
        Allergy::where('id', $request->allergy_id)
        ->update([
            'patient_id' => $request->patient_id,
            'allergy' => $request->allergy_name,
            'type' => $request->type,
            'status' => $request->status,
            'notes' => $request->notes,
            'doctor' => $this->user->doctor->name,
        ]);
        return back();
    }
    
    //========== Surgeries functions ==============

    public function index_surgeries($patient_id){
        $surgeries = Surgery::where('patient_id', $patient_id)->get();

        return view('doctor.surgeries.index', [
            'user' => $this->user,
            'surgeries' => $surgeries,
            'patient_id' => $patient_id
        ]);
    }
    
    public function destroy_surgeries(Request $request){
        Surgery::destroy('id',$request->surgery_id);
        return back();
    }
    
    public function create_surgeries(Request $request){
        Surgery::create([
            'patient_id' => $request->patient_id,
            'surgery' => $request->surgery_name,
            'reason' => $request->reason,
            'foreign_object' => $request->foreign_object,
            'doctor' => $request->doctor,
            'year' => $request->year,
            'added_by' => $this->user->id,
        ]);

        $patient = Patient::where('id', $request->patient_id)->get('user_id');
        $notification = "Dr. " . $this->user->name . " added to your surgeries";
        Notification::create([
            'sender_id' => $this->user->id,
            'sender_type' => $this->user->type,
            'sender_image' => $this->user->doctor->image,
            'reciever' => $patient[0]->user_id,
            'notification' => $notification,
            'subject' => 'prescription',
            'link' => 'patient/surgeries/index',
        ]);


        return back();
    }

    public function update_surgeries(Request $request){
        Surgery::where('id', $request->surgery_id)
        ->update([
            'patient_id' => $request->patient_id,
            'surgery' => $request->surgery_name,
            'reason' => $request->reason,
            'foreign_object' => $request->foreign_object,
            'doctor' => $request->doctor,
            'year' => $request->year,
        ]);
        return back();
    }
    
    //========== tests functions ==============
    public function index_tests($patient_id){
        $tests= Test::where('patient_id',$patient_id)->paginate(10);
        // dd($tests);
        return view('doctor.lab_tests.index', [
            'tests' => $tests,
            'patient_id' => $patient_id,
        ]);
    }
    
    public function search_tests(Request $request){
        $tests = Test::where('patient_id','=', $request->patient_id)
        ->where('test','LIKE','%'.$request->name.'%')
        ->paginate(10);

        return view('doctor.lab_tests.search', [
            'tests' => $tests,
            'patient_id' => $request->patient_id,
    ]);
    }
    
    //========== radiolpgy functions ==============
    public function index_radiology($patient_id){
        $radiologies= Radiology::where('patient_id',$patient_id)->paginate(10);
        // dd($tests);
        return view('doctor.radiology.index',[
            'radiologies' => $radiologies,
            'patient_id' => $patient_id,
        ]);

    }  
    
    public function search_radiology(Request $request){
        $radiologies= Radiology::where('patient_id','=', $request->patient_id)
        ->where('radiology','LIKE','%'.$request->name.'%')
        ->paginate(10);

        return view('doctor.radiology.search',[
            'radiologies' => $radiologies,
            'patient_id' => $request->patient_id,
        ]);
    }
    
    //========== visits functions ==============
    public function index_visits($patient_id){
        // $text = 'Hi this is test';
        // $keyword = "i";
        // $test = preg_replace('/'.$keyword.'/', 'kaka', $text);
        // dd($test);

        $visits = Visit::where('patient_id', $patient_id)->paginate(10);

        return view('doctor.visits.index', [
            'patient_id' => $patient_id,
            'visits' => $visits,
        ]);
    }
    
    public function search_visits(Request $request){
        // $text = 'Hi this is test';
        // $keyword = "i";
        // $test = preg_replace('/'.$keyword.'/', 'kaka', $text);
        // dd($test);
        $result = Visit::where('patient_id','=', $request->patient_id)
        ->where('doctor_name','LIKE','%'.$request->search_term.'%')
        ->orWhere('patient_complaint','LIKE','%'.$request->search_term.'%')
        ->orWhere('visit_report','LIKE','%'.$request->search_term.'%')
        ->orWhere('treatment_action','LIKE','%'.$request->search_term.'%')
        ->paginate(10);

        return view('doctor.visits.index', [
            'patient_id' => $request->patient_id,
            'visits' => $result,
        ]);
    }
    

    public function new_visit($patient_id){
        $patient = Patient::where('id', $patient_id)->get();
        $medications = Medication::all();
        
        return view('doctor.visits.create', [
            'patient_id' => $patient[0]->id,
            'patient_name' => $patient[0]->name,
            'doctor_name' => $this->user->doctor->name,
            'doctor_specialty' => $this->user->doctor->speciality,
            'medications' => $medications,
        ]);
    }


    public function create_visit(Request $request){
        $visit = Visit::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $this->user->doctor->id,
            'doctor_name' => $this->user->doctor->name,
            'specialty' => $this->user->doctor->speciality,
            'patient_complaint' => $request->patient_complaint,
            'visit_report' => $request->visit_report,
            'treatment_action' => $request->treatment_action,
            'date' => $request->date,
        ]);

        $start_date = date('m/d/Y');
        $timedate = strtotime($start_date);

        if($request->medication){
            $arr_size = count($request->medication['name']);
            for($i = 0; $i < $arr_size; $i++){
                $end_date[$i] = strtotime("+" . $request->medication['duration_num'][$i] . $request->medication['duration'][$i], $timedate);
                $end_date[$i] = date('m/d/Y', $end_date[$i]);
            }


            for($i = 0; $i < $arr_size; $i++){  
                Prescription::create([
                    'patient_id' => $request->patient_id,
                    'doctor_id' => $this->user->doctor->id,
                    'visit_id' => $visit->id,
                    'medication' => $request->medication["name"][$i],
                    'instructions' => $request->medication["instructions"][$i],
                    'start_date' => $start_date,
                    'end_date' => $end_date[$i],
                    'status' => 2,
                ]);
            }
        }
        

        return redirect()->route('doctor.index.visits', [
            'patient_id' => $request->patient_id,
        ]);
    }


    public function edit_visits($visit_id){
        $visit = Visit::with('patient')->where('id', $visit_id)->get()->toArray();

        $prescriptions = Prescription::where('visit_id', $visit_id)->get();

        $medications = Medication::all();

        return view('doctor.visits.edit', [
            'visit' => $visit,
            'prescriptions' => $prescriptions,
            'medications' => $medications,
        ]);
    }


    public function update_visits(Request $request){
        $visit = Visit::where('id', $request->visit_id)->update([
            'patient_complaint' => $request->patient_complaint,
            'visit_report' => $request->visit_report,
            'treatment_action' => $request->treatment_action,
        ]);

        $start_date = date('m/d/Y');
        $timedate = strtotime($start_date);

        

        if($request->medication){
            $arr_size = count($request->medication['name']);
            for($i = 0; $i < $arr_size; $i++){
                $end_date[$i] = strtotime("+" . $request->medication['duration_num'][$i] . $request->medication['duration'][$i], $timedate);
                $end_date[$i] = date('m/d/Y', $end_date[$i]);
            }
    
    
            for($i = 0; $i < $arr_size; $i++){  
                Prescription::create([
                    'patient_id' => $request->patient_id,
                    'doctor_id' => $this->user->doctor->id,
                    'visit_id' => $request->visit_id,
                    'medication' => $request->medication["name"][$i],
                    'instructions' => $request->medication["instructions"][$i],
                    'start_date' => $start_date,
                    'end_date' => $end_date[$i],
                    'status' => 2,
                ]);
            }
        }
        

        return back();
    }


    public function details_visits($visit_id){
        $visit = Visit::with('patient')->where('id', $visit_id)->get()->toArray();

        $prescriptions = Prescription::where('visit_id', $visit_id)->get();

        return view('doctor.visits.details', [
            'visit' => $visit,
            'prescriptions' => $prescriptions,
        ]);
    }

    public function iframe_details_visits($visit_id){
        $visit = Visit::with('patient')->where('id', $visit_id)->get()->toArray();

        $prescriptions = Prescription::where('visit_id', $visit_id)->get();

        return view('doctor.visits.details_iframe', [
            'visit' => $visit,
            'prescriptions' => $prescriptions,
        ]);
    }

    public function destroy_visits(Request $request){
        Visit::destroy('id',$request->visit_id);
        return back();
    }

    //============================================================iframe functions==========================================================

    public function visits_iframe($patient_id){

        $visits = Visit::where('patient_id', $patient_id)->paginate(5);

        return view('doctor.visits.iframe.visits', [
            'patient_id' => $patient_id,
            'visits' => $visits,
        ]);
    }

    public function search_visits_iframe(Request $request){

        $result = Visit::where('patient_id','=', $request->patient_id)
        ->where('doctor_name','LIKE','%'.$request->search_term.'%')
        ->orWhere('patient_complaint','LIKE','%'.$request->search_term.'%')
        ->orWhere('visit_report','LIKE','%'.$request->search_term.'%')
        ->orWhere('treatment_action','LIKE','%'.$request->search_term.'%')
        ->paginate(5);

        return view('doctor.visits.iframe.visits', [
            'patient_id' => $request->patient_id,
            'visits' => $result,
        ]);
    }

    public function tests_iframe($patient_id){

        $tests = Test::where('patient_id', $patient_id)->paginate(5);

        return view('doctor.visits.iframe.tests', [
            'patient_id' => $patient_id,
            'tests' => $tests,
        ]);
    }
    
    public function search_tests_iframe(Request $request){
        $tests = Test::where('patient_id','=', $request->patient_id)
        ->where('test','LIKE','%'.$request->name.'%')
        ->paginate(5);

        return view('doctor.visits.iframe.tests', [
            'tests' => $tests,
            'patient_id' => $request->patient_id,
    ]);
    }

    public function radiology_iframe($patient_id){

        $radiologies = Radiology::where('patient_id', $patient_id)->paginate(5);

        return view('doctor.visits.iframe.radiology', [
            'patient_id' => $patient_id,
            'radiologies' => $radiologies,
        ]);
    }
    
    public function search_radiology_iframe(Request $request){
        $radiologies = Radiology::where('patient_id','=', $request->patient_id)
        ->where('radiology','LIKE','%'.$request->name.'%')
        ->paginate(5);

        return view('doctor.visits.iframe.radiology', [
            'radiologies' => $radiologies,
            'patient_id' => $request->patient_id,
    ]);
    }

    public function allergies_iframe($patient_id){

        $allergies = Allergy::where('patient_id', $patient_id)->paginate(5);

        return view('doctor.visits.iframe.allergies', [
            'patient_id' => $patient_id,
            'allergies' => $allergies,
        ]);
    }

    public function surgeries_iframe($patient_id){

        $surgeries = Surgery::where('patient_id', $patient_id)->paginate(8);

        return view('doctor.visits.iframe.surgeries', [
            'patient_id' => $patient_id,
            'surgeries' => $surgeries,
        ]);
    }

    public function readings_bloodpressure_iframe($patient_id){

        $readings = BloodPressureLog::where('patient_id', $patient_id)->paginate(5);

        return view('doctor.visits.iframe.blood_pressure', [
            'patient_id' => $patient_id,
            'readings' => $readings,
        ]);
    }

    public function readings_bloodsugar_iframe($patient_id){

        $readings = BloodSugarLog::where('patient_id', $patient_id)->paginate(5);

        return view('doctor.visits.iframe.blood_sugar', [
            'patient_id' => $patient_id,
            'readings' => $readings,
        ]);
    }
    
    public function medical_profile_iframe($patient_id){

        $test = PatientProfile::where('patient_id', $patient_id)->first();
        $patient = Patient::where('id', $patient_id)->get();

        return view('doctor.visits.iframe.medical_profile', [
            'patient_id' => $patient_id,
            'test' => $test,
            'patient' => $patient
        ]);
    }

    public function family_iframe($patient_id){

        $family = Family::where('patient_id', $patient_id)->paginate(10);
        return view('doctor.visits.iframe.family', [
            'patient_id' => $patient_id,
            'families' => $family,
        ]);
    }


    public function conditions_iframe($patient_id){

        $conditions = MedCondition::where('patient_id', $patient_id)->paginate(8);

        return view('doctor.visits.iframe.conditions', [
            'patient_id' => $patient_id,
            'conditions' => $conditions,
        ]);
    }

    //========== medication functions ==============
    public function prescriptions_index($patient_id){
        $prescriptions = Prescription::where('patient_id', $patient_id)->paginate(10);
        $medications = Medication::all();
        
        return view('doctor.medication.prescriptions', [
            'medications' => $medications,
            'prescriptions' => $prescriptions,
            'patient_id' => $patient_id,
        ]);
    }

    public function create_prescription(Request $request){

        $start_date = date('m/d/Y');
        $timedate = strtotime($start_date);
        $end_date = strtotime("+" . $request->duration_num . $request->duration, $timedate);
        $end_date = date('m/d/Y', $end_date);

        Prescription::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $this->user->doctor->id,
            'doctor_name' => $this->user->doctor->name,
            'medication' => $request->medication,
            'instructions' => $request->instructions,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => 2,
        ]);

        $patient = Patient::where('id', $request->patient_id)->get('user_id');
        $notification = "Dr. " . $this->user->name . " added to your prescriptions";
        Notification::create([
            'sender_id' => $this->user->id,
            'sender_type' => $this->user->type,
            'sender_image' => $this->user->doctor->image,
            'reciever' => $patient[0]->user_id,
            'notification' => $notification,
            'subject' => 'prescription',
            'link' => 'patient/medication/prescriptions/index',
        ]);


        return back();
    }

    public function update_prescription(Request $request){

        $start_date = date('m/d/Y');
        $timedate = strtotime($start_date);
        $end_date = strtotime("+" . $request->duration_num . $request->duration, $timedate);
        $end_date = date('m/d/Y', $end_date);

        Prescription::where('id', $request->prescription_id)->update([
            'medication' => $request->medication,
            'instructions' => $request->instructions,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => 2,
        ]);

        return back();
    }

    public function search_prescription(Request $request){
        $result = Prescription::where('medication', 'LIKE', '%'.$request->search_term.'%')
                ->paginate(10);

        $medications = Medication::all();
        
        return view('doctor.medication.search_prescription', [
            'medications' => $medications,
            'prescriptions' => $result,
            'patient_id' => $request->patient_id,
        ]);
    }

    public function destroy_prescription(Request $request){
        Prescription::destroy('id',$request->prescription_id);
        return back();
    }


    public function offmeds_index($patient_id){
        $offmeds = OffMed::where('patient_id', $patient_id)->paginate(10);

        $medications = Medication::all();
        
        return view('doctor.medication.off_the_counter.index', [
            'meds' => $offmeds,
            'medications' => $medications,
            'patient_id' => $patient_id,
        ]);
    }

    public function offmeds_search(Request $request){
        $result = OffMed::where('medication', 'LIKE', '%'.$request->search_term.'%')
                    ->paginate(10);

        $medications = Medication::all();

        return view('doctor.medication.off_the_counter.search', [
            'meds' => $result,
            'medications' => $medications,
            'patient_id' => $request->patient_id,
        ]);
    }

    //========================= Family History Functions =======================

    public function family_index($patient_id){
        $family = Family::where('patient_id', $patient_id)->paginate(10);
        
        return view('doctor.family.index', [
            'families' => $family,
            'patient_id' => $patient_id,
        ]);
    }


    //============================= Blood Pressure log functions ===========================

    public function readings_index($patient_id){

        $readings = BloodPressureLog::where('patient_id', $patient_id)->orderBy('created_at', 'DESC')->paginate(10);

        return view('doctor.blood_pressure.index', [
            'readings' => $readings,
            'patient_id' => $patient_id,
        ]);

    }

    //============================= Blood Sugar log functions ===========================

    public function bs_index($patient_id){

        $readings = BloodSugarLog::where('patient_id', $patient_id)->paginate(10);

        return view('doctor.blood_sugar.index', [
            'readings' => $readings,
            'patient_id' => $patient_id,
        ]);

    }

    //============================= Medical Conditions functions ===========================

    public function conditions_index($patient_id){
        $conditions = MedCondition::where('patient_id', $patient_id)->paginate(10);

        return view('doctor.conditions.index', [
            'conditions' => $conditions,
            'patient_id' => $patient_id,
        ]);
    }

    public function conditions_create(Request $request){
        MedCondition::create([
            'patient_id' => $request->patient_id,
            'doctor_name' => $this->user->name,
            'condition' => $request->condition
        ]);
        
        $patient = Patient::where('id', $request->patient_id)->get('user_id');
        $notification = "Dr. " . $this->user->name . " added to your conditions";
        Notification::create([
            'sender_id' => $this->user->id,
            'sender_type' => $this->user->type,
            'sender_image' => $this->user->doctor->image,
            'reciever' => $patient[0]->user_id,
            'notification' => $notification,
            'subject' => 'prescription',
            'link' => 'patient/conditions/index',
        ]);

        return back();
    }

    public function conditions_delete(Request $request){
        MedCondition::destroy('id', $request->condition_id);
        
        return back();
    }


    //============================= Medical Profile functions ===========================
    public function medical_profile($patient_id){

        $test= PatientProfile::where('patient_id',  $patient_id)->first();
        $patient = Patient::where('id', $patient_id)->get();
        if(!$test){
            PatientProfile::create([
                'patient_id' => $patient_id,
            ]);
        }
        
        return view('doctor.patients.health_habits',compact('test', 'patient_id', 'patient'));
    }


}
