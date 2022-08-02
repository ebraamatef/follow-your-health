<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Lab;
use App\Models\LabPatient;
use App\Models\LabRequest;
use App\Models\Visit;
use App\Models\Allergy;
use App\Models\Surgery;
use App\Models\Test;
use App\Models\Prescription;
use App\Models\OffMed;
use App\Models\Radiology;
use App\Models\DoctorRequest;
use App\Models\DoctorPatient;
use App\Models\PatientProfile;
use App\Models\Medication;
use App\Models\Medcondition;
use App\Models\Family;
use App\Models\BloodPressureLog;
use App\Models\BloodSugarLog;
use App\Models\Notification;
use DB;

class PatientsController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }


    public function index(){

        return view('patient.home2', [
            'user' => $this->user,
        ]);
    }
    

    //========== Profile functions ==============

    public function edit_profile(){
        $user=Auth::user();
        return view('patient.profile.edit',compact('user'));
    }

    public function edit_setting(Request $request){
        $imageName = NULL;
        if($request->image != NULL){
            $imageName = $this->user->id . '-' . $request->name . time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/patients/' . $this->user->patient->id), $imageName);

            Patient::where('user_id', $this->user->id)
            ->update([
                'image' => $imageName,
            ]);
        }

        Patient::where('id', $this->user->patient->id)
        ->update([
            'national_id' => $request->patient_nationail_id,
        ]);
            
        
        return redirect('/patient/profile/edit');

    }


    public function edit_contact (Request $request){
        // dd($request);
        Patient::where('id', $this->user->patient->id)
        ->update([
            'name' => $request->contact_info_patient_name,
            'phone' => $request->contact_info_patient_phone_number,
            'alt_phone' => $request->contact_info_alternate_phone_number,
            'address' => $request->contact_info_patient_address,
        ]);
            
        return redirect('/patient/profile/edit');

    }
    
    public function edit_general (Request $request){
        // dd($request);
        Patient::where('id', $this->user->patient->id)
        ->update([
            'gender' => $request->gender,
            'marital' => $request->marital_condition,
            'blood_type' => $request->blood_type,
            'weight' => $request->weight,
            'height' => $request->height,
            'date_of_birth' => $request->date_of_birth,

        ]);
            
        return redirect('/patient/profile/edit');

    }

    public function medical_profile(){

        $test= PatientProfile::where('patient_id',  $user=Auth::user()->patient->id)->first();

        if(!$test){
            PatientProfile::create([
                'patient_id' => $this->user->patient->id,
            ]);
        }

        return view('patient.profile.health_habits',compact('test'));
    }

    public function health_create(Request $request){
        
        $test= PatientProfile::where('patient_id', $this->user->patient->id)->first();

        if($test){
            PatientProfile::where('patient_id', $this->user->patient->id)->update([
                'exercise' => $request->exercise_patient,
                'patient_id' => $this->user->patient->id,
                'dieting' => $request->are_you_dieting_patient,
                'medical_diet' => $request->physician_prescribed_medical_diet,
                'meals_average' => $request->n_of_meals_patient,
                'Rank_salt' => $request->rank_salt_intake_patient,
                'caffeine' => $request->tea_caffeine_patient,
                'cups' => $request->n_of_cups,
                'alchohol' => $request->do_you_drink_alcohol_patient,
                'alchohol_kind' => $request->If_yes_what_kind_patient,
                'alchohol_rate' => $request->how_many_drinks_per_week_patient,
                'alchohol_concerned' => $request->are_you_concerned_about_the_amount_you_drink_patient,
                'alchohol_stopping' => $request->have_you_considered_stopping_patient,
                'alchohol_binge' => $request->are_you_prone_to_“binge”_drinking_patient,
                'alchohol_drive' => $request->do_you_drive_after_drinking_patient,
                'use_tobacco' => $request->do_you_use_tobacco_patient,
                'use_drugs' => $request->do_you_currently_use_recreational_or_street_drugs_patient,
                'drug_needle' => $request->have_you_ever_given_yourself_street_drugs_with_a_needle_patient,
                'sexually_active' => $request->are_you_sexually_active_patient,
                'sexually_pregnancy' => $request->if_yes_are_you_trying_for_a_pregnancy_patient,
                'sexually_discomfort' => $request->if_not_trying_for_a_pregnancy_list_contraceptive_or_barrier_method_used_patient,
                'live_alone' => $request->do_you_live_alone_patient,
                'frequent_falls' => $request->do_you_have_frequent_falls_patient,
                'vision_hearing_loss' => $request->do_you_have_vision_or_hearing_loss_patient,
            ]);

            return redirect('/patient/medical-profile');
        }

    }
     

    public function mental (Request $request){

        PatientProfile::where('patient_id', $this->user->patient->id)
            ->update([
                'stress' => $request->is_stress_a_major_problem_for_you_patient,
                'depressed' => $request->do_you_feel_depressed_patient,
                'panic' => $request->do_you_panic_when_stressed_patient,
                'appetite' => $request->do_you_have_problems_with_eating_or_your_appetite_patient,
                'cry_frequently' => $request->do_you_cry_frequently_patient,
                'suicide' => $request->have_you_ever_attempted_suicide_patient,
                'hurting_yourself' => $request->have_you_ever_seriously_thought_about_hurting_yourself_patient,
                'trouble_sleeping' => $request->do_you_have_trouble_sleeping_patient,
                'counselor' => $request->have_you_ever_been_to_a_counselor_patient,    
        ]);
    
                
        return redirect('/patient/medical-profile');
    }
    
    //========== Doctor functions ==============

    public function index_doctors(){
        $doctors = Patient::with('doctors')->where('id', $this->user->patient->id)->get();
        $myDoctors = $doctors[0]->doctors()->paginate(10);
        
        return view('patient.doctors.index',[
            'myDoctors' => $myDoctors,
        ]);
    }

    public function find_doctors(){

        return view('patient.doctors.find', [
            'user' => $this->user,
        ]);
    }

    
    public function search_doctors(Request $request){
        $name= $request->search_term ;
        $search_cat = $request->search_in;
        $my_patients_id = array();
        $patient_request_ids = array();

        if($request->search_in=='all')
        {
            $result = DB::table('doctors')
            ->where('name', 'LIKE', '%'.$name.'%')
            ->paginate(10);
        }
 
        if($request->search_in=='my')
        {
            $my_doctors = Patient::with('doctors')->where('id', $this->user->patient->id)->get();

            $result = $my_doctors[0]->doctors()->where('name', 'LIKE', '%'.$request->search_term .'%')->paginate(1);

            return view('patient.doctors.index', [
                'myDoctors' => $result,
            ]);
        }

        return view('patient.doctors.search', [
            'doctors' => $result,
            'search_term' => $name,
            'search_in' => $search_cat,
        ]);
    }
    
    public function doctor_profile($doctor_id){
        $doctor = Doctor::where('id', $doctor_id)->get();

        $my_doctors = DoctorPatient::where('patient_id', $this->user->patient->id)->get();
        $my_doctors_id = array();
        foreach($my_doctors as $my_doctor){
            $my_doctors_id[] = $my_doctor->doctor_id;
        }

        return view('patient.doctors.profile', [
            'doctor' => $doctor,
            'myDoctors' => $my_doctors_id,
        ]);
    }

    public function requests_doctors($notif_id = NULL){
        if($notif_id){
            Notification::destroy('id', $notif_id);
        }
        
        $requests = DoctorRequest::where('patient_id', $this->user->patient->id)->get('doctor_id');
        $count = sizeof($requests);
        $doctor_ids = array();
        for($i = 0; $i < $count; $i++){
            $doctor_ids[$i] = $requests[$i]->doctor_id;
        }
        $doctors = Doctor::whereIn('id', $doctor_ids)->paginate(10);
        return view('patient.doctors.requests', [
            'requests' => $doctors,
        ]);
    }


    public function accept_doctor_requests(Request $request){

        DoctorPatient::create([
            'patient_id' => $this->user->patient->id,
            'doctor_id' => $request->doctor_id
        ]);

        $doc_request = DoctorRequest::where('doctor_id', $request->doctor_id)->get();

        DoctorRequest::destroy($doc_request);

        return back();
    }

    public function delete_doctor_requests(Request $request){

        $doc_request = DoctorRequest::where('doctor_id', $request->doctor_id)->get();

        DoctorRequest::destroy($doc_request);

        return back();
    }


    public function doctor_chat_index($doctor_id){
        $doctor = Doctor::where('id', $doctor_id)->get();

        return view('patient.doctors.chat', [
            'doctor' => $doctor,
        ]);
    }
    
    public function doctor_remove(Request $request){
        $doctor = DoctorPatient::where('doctor_id', $request->patient_id)->get();
        DoctorPatient::destroy($doctor);

        return redirect('/patient/doctors/index');
    }

    
    //========== lab functions ==============

    public function index_labs(){
        $labs = Patient::with('labs')->where('id', $this->user->patient->id)->get();
        $myLabs = $labs[0]->labs()->paginate(10);
        
        return view('patient.labs.index',[
            'myLabs' => $myLabs,
        ]);
    }

    public function find_labs(){

        return view('patient.labs.find', [
            'user' => $this->user,
        ]);
    }

    
    public function search_labs(Request $request){
        $name= $request->search_term ;
        $search_cat = $request->search_in;
        $my_patients_id = array();
        $patient_request_ids = array();

        if($request->search_in=='all')
        {
            $result = DB::table('labs')
            ->where('name', 'LIKE', '%'.$name.'%')
            ->paginate(10);
        }
 
        if($request->search_in=='my')
        {
            $my_labs = Patient::with('labs')->where('id', $this->user->patient->id)->get();

            $result = $my_labs[0]->labs()->where('name', 'LIKE', '%'.$request->search_term .'%')->paginate(10);

            return view('patient.labs.index', [
                'myLabs' => $result,
            ]);
        }

        return view('patient.labs.search', [
            'labs' => $result,
            'search_term' => $name,
            'search_in' => $search_cat,
        ]);
    }
    
    public function lab_profile($lab_id){
        $lab = Lab::where('id', $lab_id)->get();

        $my_labs = LabPatient::where('patient_id', $this->user->patient->id)->get();
        $my_labs_id = array();
        foreach($my_labs as $my_lab){
            $my_labs_id[] = $my_lab->lab_id;
        }

        return view('patient.labs.profile', [
            'lab' => $lab,
            'myLabs' => $my_labs_id,
        ]);
    }

    public function lab_chat_index($lab_id){
        $lab = Lab::where('id', $lab_id)->get();

        return view('patient.labs.chat', [
            'lab' => $lab,
        ]);
    }

    public function requests_labs($notif_id = NULL){
        if($notif_id){
            Notification::destroy('id', $notif_id);
        }
        $requests = LabRequest::where('patient_id', $this->user->patient->id)->get('lab_id');
        $count = sizeof($requests);
        $lab_ids = array();
        for($i = 0; $i < $count; $i++){
            $lab_ids[$i] = $requests[$i]->lab_id;
        }
        $labs = Lab::whereIn('id', $lab_ids)->get();
        return view('patient.labs.requests', [
            'requests' => $labs,
        ]);
    }


    public function accept_lab_requests(Request $request){

        LabPatient::create([
            'patient_id' => $this->user->patient->id,
            'lab_id' => $request->lab_id
        ]);

        $lab_request = LabRequest::where('lab_id', $request->lab_id)->get();

        LabRequest::destroy($lab_request);

        return back();
    }

    public function delete_lab_requests(Request $request){

        $lab_request = LabRequest::where('lab_id', $request->lab_id)->get();

        LabRequest::destroy($lab_request);

        return back();
    }
    
    public function lab_remove(Request $request){
        $lab = LabPatient::where('lab_id', $request->patient_id)->get();
        LabPatient::destroy($lab);

        return redirect('/patient/labs/index');
    }

    //========== Allergies functions ==============

    public function index_allergies($notif_id = NULL){
        if($notif_id){
            Notification::destroy('id', $notif_id);
        }
        $allergies = Allergy::where('patient_id', $this->user->patient->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('patient.allergies.index', [
            'user' => $this->user,
            'allergies' => $allergies
        ]);
    }
    
    public function destroy_allergies(Request $request){
        Allergy::destroy('id',$request->id);
        return back();
    }
    
    public function create_allergies(Request $request){
        $allergy = Allergy::create([
            'patient_id' => $this->user->patient->id,
            'allergy' => $request->allergy_name,
            'type' => $request->type,
            'status' => $request->status,
            'notes' => $request->notes,
            'added_by' => $this->user->id,
        ]);

        // $response = response()->json($allergy); 
        // return $response;
        return back();
    }
    
    public function edit_allergies(){
        
    }
    
    public function update_allergies(Request $request){
        Allergy::where('id', $request->allergy_id)
        ->update([
            'patient_id' => $this->user->id,
            'allergy' => $request->allergy_name,
            'type' => $request->type,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);
        return back();
    }

    //========== Surgeries functions ==============

    public function index_surgeries($notif_id = NULL){
        if($notif_id){
            Notification::destroy('id', $notif_id);
        }
        $surgeries = Surgery::where('patient_id', $this->user->patient->id)->paginate(10);

        return view('patient.surgeries.index', [
            'user' => $this->user,
            'surgeries' => $surgeries,
        ]);
    }
    
    public function destroy_surgeries(Request $request){
        Surgery::destroy('id',$request->id);
        return back();
    }
    
    public function create_surgeries(Request $request){
        Surgery::create([
            'patient_id' => $this->user->patient->id,
            'surgery' => $request->surgery_name,
            'reason' => $request->reason,
            'foreign_object' => $request->foreign_object,
            'doctor' => $request->doctor,
            'year' => $request->year,
            'added_by' => $this->user->id,
        ]);
        return back();
    }
    
    public function edit_surgeries(){
        
    }

    public function update_surgeries(Request $request){
        Surgery::where('id', $request->surgery_id)
        ->update([
            'patient_id' => $this->user->id,
            'surgery' => $request->surgery_name,
            'reason' => $request->reason,
            'foreign_object' => $request->foreign_object,
            'doctor' => $request->doctor,
            'year' => $request->year,
        ]);
        return back();
    }
    
    //========== tests functions ==============

    public function index_tests($notif_id = NULL){
        if($notif_id){
            Notification::destroy('id', $notif_id);
        }
        $tests= Test::where('patient_id',$this->user->patient->id)->paginate(10);
        // dd($tests);
        return view('patient.lab_tests.index',compact('tests'));
    }

    public function create_test(Request $request){

        $test_file = $request->file_t->getClientOriginalName();
        $filename= time().''.$test_file;
        $path =  public_path('storage/patients/' . $this->user->patient->id . '/testing');
        $request->file_t->move($path,$filename);



        $test = Test::create([
            'test' => $request->test_name,
            'doctor_name' => $request->doctor_name,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
            'file' => $filename,
            'patient_id' => $this->user->patient->id,
        ]);

        return back();
    }

    public function update_test(Request $request,$id){
        if($request->file_t != NULL){
            $test_file = $request->file_t->getClientOriginalName();
            $file_name= time().'_'.$test_file;
            $path = public_path('storage/patients/' . $request->patient_id . '/testing');
            $request->file_t->move($path,$file_name);

            Test::where('id', $id)
            ->update([
                'file' => $file_name,
            ]); 
        }

        Test::where('id', $id)
        ->update([
            'test' => $request->test_name,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
        ]);

        return back();
    }



    public function search_tests(Request $request){
        $tests= Test::where('patient_id','=', $this->user->patient->id)
        ->where('test','LIKE','%'.$request->name.'%')
        ->paginate(10);
        // dd($request);
        // $id= $tests[0]->id;
        return view('patient.lab_tests.index',compact('tests'));
    }

    public function delete_test(Request $request){
        
        Test::destroy('id', $request->test_id);

        return back();
    }
    
    //========== radiolpgy functions ==============

    public function index_radiology($notif_id = NULL){
        if($notif_id){
            Notification::destroy('id', $notif_id);
        }
        $radiologies= Radiology::where('patient_id',$this->user->patient->id)->paginate(10);
        // dd($tests);
        return view('patient.radiology.index',compact('radiologies'));
    }

    public function create_radiology(Request $request){
        $test_file = $request->file_t->getClientOriginalName();
        $filename= time().''.$test_file;
        $path =  public_path('storage/patients/' . $this->user->patient->id . '/radiology');
        $request->file_t->move($path,$filename);



        $radiology = Radiology::create([
            'radiology' => $request->radiology_name,
            'doctor_name' => $request->doctor_name,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
            'file' => $filename,
            'patient_id' => $this->user->patient->id,
        ]);

        return back();
    }

    public function update_radiology(Request $request,$id){
        if($request->file_t != NULL){
            $test_file = $request->file_t->getClientOriginalName();
            $filename= time().''.$test_file;
            $path =  public_path('storage/patients/' . $this->user->patient->id . '/radiology');
            $request->file_t->move($path,$filename);

            Radiology::where('id', $id)
            ->update([
                'file' => $filename,
            ]); 
        }

        Radiology::where('id', $id)
        ->update([
            'radiology' => $request->radiology_name,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
        ]);

        return back();
    }



    public function search_radiology(Request $request){
        $radiologies = Radiology::where('patient_id','=', $this->user->patient->id)
        ->where('radiology','LIKE','%'.$request->name.'%')
        ->paginate(10);
        // dd($request);
        // $id= $tests[0]->id;
        return view('patient.radiology.index',compact('radiologies'));
    }

    public function delete_radiology(Request $request){
        
        Radiology::destroy('id', $request->radiology_id);

        $path = public_path('storage/patients/' . $radiology[0]->patient_id . '/radiology/' . $radiology[0]->file);
        File::delete($path);
        
        return back();
    }
    
    //========== visits functions ==============

    public function index_visits(){
        $visit = Visit::where('patient_id', $this->user->patient->id)->paginate(10);

        return view('patient.visits.index', [
            'visits' => $visit,
            'patient_id' => $this->user->patient->id,
        ]);
    }
    
    public function visit_details($visit_id){
        $visit = Visit::with('patient')->where('id', $visit_id)->get()->toArray();

        $prescriptions = Prescription::where('visit_id', $visit_id)->get();

        return view('patient.visits.details', [
            'visit' => $visit,
            'prescriptions' => $prescriptions,
        ]);
    }
    
    public function visit_details_iframe($visit_id){
        $visit = Visit::with('patient')->where('id', $visit_id)->get()->toArray();

        $prescriptions = Prescription::where('visit_id', $visit_id)->get();

        return view('patient.visits.details_iframe', [
            'visit' => $visit,
            'prescriptions' => $prescriptions,
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

        return view('patient.visits.index', [
            'patient_id' => $request->patient_id,
            'visits' => $result,
        ]);
    }
    
    //========== medication functions ==============

    public function prescriptions_index($notif_id = NULL){
        if($notif_id){
            Notification::destroy('id', $notif_id);
        }
        $prescriptions = Prescription::where('patient_id', $this->user->patient->id)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('patient.medication.prescriptions.index', [
            'prescriptions' => $prescriptions,
            'patient_id' => $this->user->patient->id,
        ]);
    }

    public function prescriptions_search(Request $request){
        $result = Prescription::where('medication', 'LIKE', '%'.$request->search_term.'%')
                    ->paginate(10);
        
        return view('patient.medication.prescriptions.search', [
            'prescriptions' => $result,
            'patient_id' => $request->patient_id,
        ]);
    }

    public function offmeds_index(){
        $offmeds = OffMed::where('patient_id', $this->user->patient->id)->paginate(10);

        $medications = Medication::all();
        
        return view('patient.medication.off_the_counter.index', [
            'meds' => $offmeds,
            'medications' => $medications,
        ]);
    }

    public function offmeds_create(Request $request){
        OffMed::create([
            'patient_id' => $this->user->patient->id,
            'medication' => $request->medication,
            'status' => $request->status, 
        ]);

        return redirect(URL('patient/medication/offTheCounter/index'));
    }

    public function offmeds_update(Request $request){
        OffMed::where('id', $request->med_id)
        ->update([
            'medication' => $request->medication,
            'status' => $request->status, 
        ]);

        return redirect(URL('patient/medication/offTheCounter/index'));
    }

    public function offmeds_search(Request $request){
        $result = OffMed::where('medication', 'LIKE', '%'.$request->search_term.'%')
                    ->paginate(10);

        $medications = Medication::all();

        return view('patient.medication.off_the_counter.search', [
            'meds' => $result,
            'medications' => $medications,
        ]);
    }
    
    public function offmeds_delete(Request $request){
        OFfMed::destroy('id',$request->med_id);
        return back();
    }

    //============================= Medical Conditions functions ===========================

    public function conditions_index($notif_id = NULL){
        if($notif_id){
            Notification::destroy('id', $notif_id);
        }
        $conditions = MedCondition::where('patient_id', $this->user->patient->id)->paginate(10);
        
        return view('patient.conditions.index', [
            'conditions' => $conditions,
            'patient_id' => $this->user->patient->id,
        ]);
    }

    public function conditions_create(Request $request){
        MedCondition::create([
            'patient_id' => $this->user->patient->id,
            'condition' => $request->condition
        ]);
        
        return back();
    }

    public function conditions_delete(Request $request){
        MedCondition::destroy('id', $request->condition_id);
        
        return back();
    }


    //============================= Family History functions ===========================

    public function family_index(){
        $family = Family::where('patient_id', $this->user->patient->id)->paginate(10);
        
        return view('patient.family.index', [
            'families' => $family,
            'patient_id' => $this->user->patient->id,
        ]);
    }

    public function family_create(Request $request){
        Family::create([
            'patient_id' => $this->user->patient->id,
            'problem' => $request->problem,
            'member' => $request->member
        ]);
        
        return back();
    }

    public function family_delete(Request $request){
        Family::destroy('id', $request->problem_id);
        
        return back();
    }


    //============================= Blood Pressure log functions ===========================

    public function readings_index(){

        $readings = BloodPressureLog::where('patient_id', $this->user->patient->id)->paginate(10);

        return view('patient.blood_pressure.index', [
            'readings' => $readings,
        ]);

    }

    public function bp_create(Request $request){

        BloodPressureLog::create([
            'patient_id' => $this->user->patient->id,
            'time' => $request->time,
            'date' => $request->date,
            'reading_top' => $request->reading_top,
            'reading_bottom' => $request->reading_bottom,
        ]);

        return back();

    }

    public function bp_delete(Request $request){

        BloodPressureLog::destroy('id', $request->reading_id);

        return back();

    }

    //============================= Blood Sugar log functions ===========================

    public function bs_index(){

        $readings = BloodSugarLog::where('patient_id', $this->user->patient->id)->paginate(10);

        return view('patient.blood_sugar.index', [
            'readings' => $readings,
        ]);

    }

    public function bs_create(Request $request){

        BloodSugarLog::create([
            'patient_id' => $this->user->patient->id,
            'time' => $request->time,
            'date' => $request->date,
            'reading' => $request->reading,
            'unit' => $request->unit,
        ]);

        return back();

    }

    public function bs_delete(Request $request){

        BloodSugarLog::destroy('id', $request->reading_id);

        return back();

    }

}
