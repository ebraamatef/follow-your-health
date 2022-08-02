<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Allergy;
use App\Models\Surgery;
use App\Models\Test;
use App\Models\Radiology;
use App\Models\DoctorRequest;
use App\Models\DoctorPatient;
use App\Models\PatientProfile;

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
        return view('patient.home', [
            'user' => $this->user,
        ]);
    }

    //========== Requests functions ==============

    public function index_requests(){
        $requests = DoctorRequest::where('patient_id', $this->user->patient->id)->get();
        $doctorIDs = array();

        foreach($requests as $request){
            $doctorIDs[] = $request->doctor_id;
        }

        $doctors = Doctor::whereIn('id', $doctorIDs)->get();

        return view('patient.requests', [
            'requests' => $requests,
            'doctors' => $doctors,
        ]);
    }


    public function accept_requests(Request $request){

        DoctorPatient::create([
            'patient_id' => $this->user->patient->id,
            'doctor_id' => $request->doctor_id
        ]);

        $doc_request = DoctorRequest::where('doctor_id', $request->doctor_id)->get();

        DoctorRequest::destroy($doc_request);

        return back();
    }
    

    //========== Profile functions ==============
    
    public function show(){

    }
    
    public function edit_setting(Request $request){
        // dd($request);
        Patient::where('id', $this->user->patient->id)
        ->update([
            'national_id' => $request->patient_nationail_id,
            'image' => $request->image,
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
     public function health_create(Request $request){

        // dd($request);
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



            // 'stress' => $request->blood_type,
            // 'depressed' => $request->weight,
            // 'panic' => $request->height,
            // 'appetite' => $request->date_of_birth,
            // 'cry_frequently' => $request->weight,
            // 'suicide' => $request->height,
            // 'hurting_yourself' => $request->date_of_birth,
            // 'trouble_sleeping' => $request->weight,
            // 'counselor ' => $request->height,
            
        ]);

            
            return redirect('/patient/profile/health');


        }
        else
        {
        
            PatientProfile::create([
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



            // 'stress' => $request->blood_type,
            // 'depressed' => $request->weight,
            // 'panic' => $request->height,
            // 'appetite' => $request->date_of_birth,
            // 'cry_frequently' => $request->weight,
            // 'suicide' => $request->height,
            // 'hurting_yourself' => $request->date_of_birth,
            // 'trouble_sleeping' => $request->weight,
            // 'counselor ' => $request->height,
            
        ]);
        return redirect('/patient/profile/health');

        }


        }
     

        public function mental (Request $request){

            // dd($request);
       
    
    
    
                PatientProfile::where('patient_id', $this->user->patient->id)->update([
                  
    
    
    
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
    
                
                return redirect('/patient/profile/health');
    
    
            }
            
    
    
           




        
    
    public function update(){
        
    }
    
    //========== Doctor functions ==============

    public function index_doctors(){
        $doctors = Patient::with('doctors')->where('id', $this->user->patient->id)->get()->toArray();
        $myDoctors = $doctors[0]['doctors'];
        
        return view('patient.doctors.index',[
            'myDoctors' => $myDoctors,
        ]);
    }
    
    public function search_doctors(Request $request){
       $name= $request->search_term ;
        if($request->search_in=='all')
        {
                  if($request->search_by=='name')
              {
                  $result = DB::table('doctors')
                  ->where('name', 'LIKE', '%'.$name.'%')
                  ->get()->toArray();
                  
                  return view('patient.doctors.index')->with('doctors',$result);
              }
              if($request->search_by=='speciality')
              {
                  $result = DB::table('doctors')
                  ->where('speciality', 'LIKE', '%'.$name.'%')
                  ->get()->toArray();
                  return view('patient.doctors.index')->with('doctors',$result);
              }
        }

        if($request->search_in=='my')
        {
            if($request->search_by=='name')
            {
               $result = Patient::with('doctors')->whereHas('doctors', function ($query) use ($name){
               return $query->with('doctors.name', 'LIKE', '%'.$name.'%')
                            ->where('patient_id','=',$this->user->patient->id );
                                })->get();

                $f= $result[0]->doctors()->where('name', 'LIKE', '%'.$request->search_term .'%')->get();
         
                return view('patient.doctors.search')->with('doctors',$f);

            if($request->search_by=='speciality')
                { 
                    $result = Patient::with('doctors')->whereHas('doctors', function ($query) use ($name){
                        return $query->with('doctors.name', 'LIKE', '%'.$name.'%')
                                    ->where('patient_id','=',$this->user->patient->id );
                                         })->get();
                     
                      $f= $result[0]->doctors()->where('speciality', 'LIKE', '%'.$request->search_term .'%')->get();
                     
                         return view('patient.doctors.search')->with('doctors',$f);
         
                }
            }          
            return view('patient.doctors.search',[
                'doctors' => $result,
            ]);
        }
    }
    
    public function destroy_doctors(){
        
    }
    
    //========== Allergies functions ==============

    public function index_allergies(){
        $allergies = Allergy::where('patient_id', $this->user->id)->get();

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
            'patient_id' => $this->user->id,
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

    public function index_surgeries(){
        $surgeries = Surgery::where('patient_id', $this->user->id)->get();

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
            'patient_id' => $this->user->id,
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

    public function index_tests(){

        $tests= Test::where('patient_id',$this->user->patient->id)->get();
        // dd($tests);
        return view('patient.lab_tests.index',compact('tests'));
    }

    public function create_test(Request $request){


        $test_file = $request->file_t->getClientOriginalName();
        $filename= time().''.$test_file;
        $path = 'lab/tests';
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



    public function search_tests(Request $request){
        $tests= Test::where('patient_id','=', $this->user->patient->id)
        ->where('test','LIKE','%'.$request->name.'%')
        ->get();
        // dd($request);
        // $id= $tests[0]->id;
        return view('patient.lab_tests.index',compact('tests'));
    }
    
    //========== radiolpgy functions ==============

    public function index_radiology(){
        $radiologies= Radiology::where('patient_id',$this->user->patient->id)->get();
        // dd($tests);
        return view('patient.radiology.index',compact('radiologies'));

    }
    public function create_radiology(Request $request){


        $test_file = $request->file_t->getClientOriginalName();
        $filename= time().''.$test_file;
        $path = 'lab/tests';
        $request->file_t->move($path,$filename);



        $radiologies = Radiology::create([
            'radiology' => $request->radiology,
            'doctor_name' => $request->doctor_name,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
            'file' => $filename,
            'patient_id' => $this->user->patient->id,
        ]);

        return back();
    }

    public function search_radiology(Request $request){
        $radiologies= Radiology::where('patient_id','=', $this->user->patient->id)
        ->where('radiology','LIKE','%'.$request->name.'%')
        ->get();

        return view('patient.radiology.index',compact('radiologies'));
    }
    
    //========== visits functions ==============

    public function index_visits(){
        return view('patient.visits.index');
    }
    
    public function index_details_visits(){
        
    }
    
    public function search_visits(){
        
    }
    
    //========== medication functions ==============

    public function index_medication(){
        return view('patient.medication.index');
    }
}
