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
use App\Models\Medication;
use App\Models\Visit;
use App\Models\DoctorPatient;
use App\Models\DoctorRequest;
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
        $requests = DoctorRequest::where('patient_id', $this->user->id)->get();

        return view('patient.requests', [
            'user' => $this->user,
            'requests' => $requests,
        ]);
    }

    public function create_requests(Request $request){
        
        DoctorRequest::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $this->user->doctor->id,
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
        $myPatients = Doctor::with('patients')->where('id', $this->user->doctor->id)->get()->toArray();

        return view('doctor.home', [
            'user' => $this->user,
            'myPatients' => $myPatients,
        ]);
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
            ->get();
            
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

            $result = $my_patients[0]->patients()->where('name', 'LIKE', '%'.$request->search_term .'%')->get();
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

        Doctor::where('user_id', $this->user->id)
        ->update([
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
    public function show_patients(){
        
    }
    
    public function destroy_patients(){
        
    }
    
    //========== Allergies functions ==============

    public function index_allergies(Request $request){
        $allergies = Allergy::where('patient_id', $request->patient_id)->get();
        
        return view('doctor.allergies.index', [
            'user' => $this->user,
            'allergies' => $allergies,
            'patient_id' => $request->patient_id
        ]);
    }
    
    public function destroy_allergies(Request $request){
        Allergy::destroy('id',$request->id);
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

    public function index_surgeries(Request $request){
        $surgeries = Surgery::where('patient_id', $request->patient_id)->get();

        return view('doctor.surgeries.index', [
            'user' => $this->user,
            'surgeries' => $surgeries,
            'patient_id' => $request->patient_id
        ]);
    }
    
    public function destroy_surgeries(Request $request){
        Surgery::destroy('id',$request->id);
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
    public function show_tests(){
        
    }  
    
    public function search_tests(){
        
    }
    
    //========== radiolpgy functions ==============
    public function show_radiology(){
        
    }  
    
    public function search_radiology(){
        
    }
    
    //========== visits functions ==============
    public function index_visits($patient_id){
        $visits = Visit::where('patient_id', $patient_id)->get();

        return view('doctor.visits.index', [
            'patient_id' => $patient_id,
            'visits' => $visits,
        ]);
    }
    
    public function new_visit(Request $request){
        $patient = Patient::where('id', $request->patient_id)->get();
        
        return view('doctor.visits.create', [
            'patient_id' => $patient[0]->id,
            'patient_name' => $patient[0]->name,
            'doctor_name' => $this->user->doctor->name,
            'doctor_specialty' => $this->user->doctor->speciality,
        ]);
    }

    public function create_visit(Request $request){
        Visit::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $this->user->doctor->id,
            'doctor_name' => $this->user->doctor->name,
            'specialty' => $this->user->doctor->speciality,
            'patient_complaint' => $request->patient_complaint,
            'visit_report' => $request->visit_report,
            'treatment_action' => $request->treatment_action,
            'date' => $request->date,
        ]);

        $visits = Visit::where('patient_id', $request->patient_id)->get();

        return view('doctor.visits.details', [
            'doctor_name' => $this->user->doctor->name,
            'specialty' => $this->user->doctor->speciality,
            'visit' => $request,
        ]);
    }

    public function destroy_visits(Request $request){
        Visit::destroy('id',$request->id);
        return back();
    }
    
    //========== medication functions ==============
    public function index_medication($patient_id){
        $medications = Medication::all();
        
        return view('doctor.medication.index', [
            'medications' => $medications,
        ]);
    }
}
