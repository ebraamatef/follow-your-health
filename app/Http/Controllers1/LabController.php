<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Lab;
use App\Models\LabPatient;
use App\Models\LabRequest;
use App\Models\Test;
use App\Models\Radiology;
use Crypt;
use DB;
use File;
use Str;
use Storage;

class LabController extends Controller
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

    public function create_requests(Request $request){
        
        LabRequest::create([
            'patient_id' => $request->patient_id,
            'lab_id' => $this->user->lab->id,
        ]);

        return back();
    }

    public function destroy_requests(Request $request){

        $lab_request = LabRequest::where('patient_id', $request->patient_id)->get();
        LabRequest::destroy($lab_request);

        return back();
    }

    //========== Profile functions ==============
    
    public function show(){

    }
    
    public function edit_profile(){
        $lab = Lab::where('id', $this->user->lab->id)->get();

        return view('lab.profile.edit', [
            'user' => $this->user,
            'lab' => $lab,
        ]);
    }
    
    public function update_profile(Request $request){
        User::where('id', $this->user->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);


        if($request->image != NULL){
            $imageName = $this->user->id . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('storage/labs/' . $this->user->id), $imageName);
        }

        
        Lab::where('user_id', $this->user->id)
        ->update([
            'type' => $request->type,
            'phone' => $request->phone,
            'alt_phone' => $request->alt_phone,
            'address' => $request->clinic_address,
            'image' => $imageName,
        ]);
        return back();
    }

    //========== Patients functions ==============

    public function index(){
        $myPatients = Lab::with('patients')->where('id', $this->user->lab->id)->get()->toArray();
        


        return view('lab.home', [
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
            
            $my_patients = LabPatient::where('lab_id','=',$this->user->lab->id )
                                    ->get('patient_id');
            foreach($my_patients as $my_patient){
                $my_patients_id[] = $my_patient->patient_id;
            }

            $request_ids = LabRequest::where('lab_id','=',$this->user->lab->id )
                                    ->get('patient_id');
            foreach($request_ids as $request){
                $patient_request_ids[] = $request->patient_id;
            }
        }
 
        if($request->search_in=='my')
        {
            $my_patients = Lab::with('patients')->where('id', $this->user->lab->id)->get();

            $result = $my_patients[0]->patients()->where('name', 'LIKE', '%'.$request->search_term .'%')->get();
        }

        return view('lab.patients.search', [
            'patients' => $result,
            'myPatients' => $my_patients_id,
            'search_term' => $name,
            'search_in' => $search_cat,
            'request_ids' => $patient_request_ids,
        ]);
    }

    public function patient_profile(Request $request){

        $patient = Patient::where('id', $request->patient_id)->get();

        return view('lab.patients.profile', [
            'user' => $this->user,
            'patient' => $patient,
        ]);
    }

    //========== tests functions ==============

    public function index_tests($id){
        $tests = Test::where('patient_id',$id)->get();
        return view('lab.lab_tests.index',compact('id','tests'));
    }  
    
    public function search_tests(Request $request){
        $tests= Test::where('patient_id','=', $request->patient_id)
        ->where('test','LIKE','%'.$request->search.'%')
        ->get();
        
        $id= $request->patient_id;
        return view('lab.lab_tests.index',compact('tests','id'));
    }
    public function create_test(Request $request){
        
        if($request->file_t != NULL){
            $test_file = $request->file_t->getClientOriginalName();
            $file_name= time().'_'.$test_file;
            $path = 'lab/tests';
            $request->file_t->move($path,$file_name);
        }
         

      
        $test = Test::create([
            'test' => $request->test_name,
            'doctor_name' => $request->doctor_name,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
            'file' => $file_name,
            'patient_id' => $request->patient_id,
            'lab_id' => $this->user->lab->id
        ]);

        return back();
    }



    public function update_test(Request $request,$id){
        

        $test_file = $request->file_t->getClientOriginalName();
        $file_name= time().'_'.$test_file;
        $path = 'lab/tests';
        $request->file_t->move($path,$file_name);


      
         Test::where('id', $id)
        ->update([
            'test' => $request->test_name,
            'doctor_name' => $request->doctor_name,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
            'file' => $file_name,
            'patient_id' => $request->patient_id,
            'lab_id' => $this->user->lab->id
        ]);

        return back();
    }

    public function destroy_test(Request $request){
        Test::destroy('id',$request->id);
        return back();
    }





    //========== radiolpgy functions ==============

    public function index_radiology($id){

        $radiologies = Radiology::where('patient_id',$id)->get();
        
        return view('lab.radiology.index',compact('id','radiologies'));
    }  



    public function create_radiology(Request $request){

        $test_file = $request->file_t->getClientOriginalName();
        $file_name= time().'_'.$test_file;
        $path = 'lab/radiology';
        $request->file_t->move($path,$file_name);

       
      
        $radiologies = Radiology::create([
            
            'radiology' => $request->radiology,
            'doctor_name' => $request->doctor_name,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
            'file' => $file_name,
            'patient_id' => $request->patient_id,
            'lab_id' => $this->user->lab->id
        ]);
        
        return back();
    }
    


    public function update_radiology(Request $request,$id){
        
        

        $test_file = $request->file_t->getClientOriginalName();
        $file_name= time().'_'.$test_file;
        $path = 'lab/radiology';
        $request->file_t->move($path,$file_name);


      
         Radiology::where('id','=', $id)
       -> update([
            'radiology' => $request->radiology,
            'doctor_name' => $request->doctor_name,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
            'file' => $file_name,
           
        ]);
        // dd($radiologies);

        return back();
    }

    public function destroy_radiology(Request $request){
        Radiology::destroy('id',$request->id);
        return back();
    }
    public function search_radiology(Request $request){
        // dd($request->patient_id);
        $radiologies= Radiology::where('patient_id','=', $request->patient_id)
        ->where('radiology','LIKE','%'.$request->search.'%')
        ->get();
        $id= $request->patient_id;
        return view('lab.radiology.index',compact('radiologies','id'));
    }
}