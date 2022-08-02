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
use App\Models\Notification;
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
    public function index_requests(){
        
        $requests = LabRequest::where('lab_id', $this->user->lab->id)->get('patient_id');
        $count = sizeof($requests);
        $patient_ids = array();
        for($i = 0; $i < $count; $i++){
            $patient_ids[$i] = $requests[$i]->patient_id;
        }
        $patients = Patient::whereIn('id', $patient_ids)->paginate(10);
        return view('lab.patients.requests', [
            'requests' => $patients,
        ]);
    }

    public function create_requests(Request $request){
        
        LabRequest::create([
            'patient_id' => $request->patient_id,
            'lab_id' => $this->user->lab->id,
        ]);

        $patient = Patient::where('id', $request->patient_id)->get('user_id');
        $notification = "" . $this->user->name . " send you a request";
        Notification::create([
            'sender_id' => $this->user->id,
            'sender_type' => $this->user->type,
            'sender_image' => $this->user->lab->image,
            'reciever' => $patient[0]->user_id,
            'notification' => $notification,
            'subject' => 'test',
            'link' => 'patient/labs/requests',
        ]);

        return back();
    }

    public function destroy_requests(Request $request){

        $lab_request = LabRequest::where('patient_id', $request->patient_id)->get();
        LabRequest::destroy($lab_request);

        return back();
    }

    //========== Profile functions ==============

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

        $imageName = NULL;
        if($request->image != NULL){
            $imageName = $this->user->id . '-' . $request->name . '.' . time() . $request->image->extension();
            $request->image->move(public_path('storage/labs/' . $this->user->id), $imageName);

            Lab::where('user_id', $this->user->id)
                ->update([
                    'image' => $imageName,
                ]);
        }

        
        Lab::where('user_id', $this->user->id)
        ->update([
            'type' => $request->type,
            'phone' => $request->phone,
            'alt_phone' => $request->alt_phone,
            'address' => $request->clinic_address,
        ]);
        return back();
    }

    //========== Patients functions ==============

    public function index(){

        return view('lab.home', [
            'user' => $this->user,
        ]);
    }

    public function mypatients_index(){
        $myPatients = Lab::with('patients')->where('id', $this->user->lab->id)->get();
        $result = $myPatients[0]->patients()->paginate(10);

        return view('lab.patients.index', [
            'user' => $this->user,
            'myPatients' => $result,
        ]);
    }

    public function allpatients_index(){

        return view('lab.patients.find', [
            'user' => $this->user,
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
            ->paginate(10);
            
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
            $my_patients = LabPatient::where('lab_id','=',$this->user->lab->id )
                                    ->get('patient_id');
            foreach($my_patients as $my_patient){
                $my_patients_id[] = $my_patient->patient_id;
            }
            
            $my_patients = Lab::with('patients')->where('id', $this->user->lab->id)->get();

            $result = $my_patients[0]->patients()->where('name', 'LIKE', '%'.$request->search_term .'%')->paginate(10);
         
            return view('lab.patients.index', [
                'myPatients' => $result,
            ]);
        }

        return view('lab.patients.search', [
            'patients' => $result,
            'myPatients' => $my_patients_id,
            'search_term' => $name,
            'search_in' => $search_cat,
            'request_ids' => $patient_request_ids,
        ]);
    }

    public function patient_profile($patient_id){
        $patient = Patient::where('id', $patient_id)->get();

        return view('lab.patients.profile', [
            'user' => $this->user,
            'patient' => $patient,
        ]);
    }

    public function chat_index($patient_id){
        $patient = Patient::where('id', $patient_id)->get();

        return view('lab.patients.chat', [
            'patient' => $patient,
        ]);
    }

    public function patient_profile_x($patient_id){
        $patient = Patient::where('id', $patient_id)->get();

        return view('lab.patients.profile_x', [
            'user' => $this->user,
            'patient' => $patient,
        ]);
    }

    public function patient_remove(Request $request){
        $patient = LabPatient::where('patient_id', $request->patient_id)->get();
        LabPatient::destroy($patient);

        return redirect('/lab/patients/index');
    }

    //========== tests functions ==============

    public function index_tests($id){
        $tests = Test::where([['patient_id', $id],['lab_id', $this->user->lab->id]])->paginate(10);

        return view('lab.lab_tests.index',compact('id','tests'));
    }  
    
    public function search_tests(Request $request){
        $tests= Test::where('patient_id','=', $request->patient_id)
        ->where('lab_id', $this->user->lab->id)
        ->where('test','LIKE','%'.$request->search.'%')
        ->paginate(10);
        
        $id= $request->patient_id;
        return view('lab.lab_tests.index',compact('tests','id'));
    }

    public function create_test(Request $request){
        
            $test_file = $request->file_t->getClientOriginalName();
            $file_name= time().'_'.$test_file;
            $path = public_path('storage/patients/' . $request->patient_id . '/testing');
            $request->file_t->move($path,$file_name);
         

      
        $test = Test::create([
            'test' => $request->test_name,
            'lab_name' => $this->user->name,
            'date' => $request->date,
            'file' => $file_name,
            'patient_id' => $request->patient_id,
            'lab_id' => $this->user->lab->id
        ]);

        $patient = Patient::where('id', $request->patient_id)->get('user_id');
        $notification = "" . $this->user->name . " added to your tests";
        Notification::create([
            'sender_id' => $this->user->id,
            'sender_type' => $this->user->type,
            'sender_image' => $this->user->lab->image,
            'reciever' => $patient[0]->user_id,
            'notification' => $notification,
            'subject' => 'test',
            'link' => 'patient/tests/index',
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

    public function destroy_test(Request $request){
        $test = Test::where('id', $request->test_id)->get();
        
        $path = public_path('storage/patients/' . $test[0]->patient_id . '/testing/' . $test[0]->file);
        File::delete($path);

        Test::destroy('id',$request->test_id);

        return back();
    }





    //========== radiolpgy functions ==============

    public function index_radiology($id){
        $radiologies = Radiology::where([['patient_id', $id],['lab_id', $this->user->lab->id]])->paginate(10);
        
        return view('lab.radiology.index',compact('id','radiologies'));
    }  



    public function create_radiology(Request $request){

        $test_file = $request->file_t->getClientOriginalName();
        $file_name= time().'_'.$test_file;
        $path = public_path('storage/patients/' . $request->patient_id . '/radiology');
        $request->file_t->move($path,$file_name);
       
      
        $radiologies = Radiology::create([
            
            'radiology' => $request->radiology,
            'lab_name' => $this->user->name,
            'date' => $request->date,
            'file' => $file_name,
            'patient_id' => $request->patient_id,
            'lab_id' => $this->user->lab->id
        ]);

        $patient = Patient::where('id', $request->patient_id)->get('user_id');
        $notification = "" . $this->user->name . " added to your radiology";
        Notification::create([
            'sender_id' => $this->user->id,
            'sender_type' => $this->user->type,
            'sender_image' => $this->user->lab->image,
            'reciever' => $patient[0]->user_id,
            'notification' => $notification,
            'subject' => 'test',
            'link' => 'patient/radiology/index',
        ]);

        
        return back();
    }
    


    public function update_radiology(Request $request,$id){
        
        if($request->file_t != NULL){
            $test_file = $request->file_t->getClientOriginalName();
            $file_name= time().'_'.$test_file;
            $path = public_path('storage/patients/' . $request->patient_id . '/radiology');
            $request->file_t->move($path,$file_name);


            Radiology::where('id','=', $id)
            -> update([
                 'file' => $file_name,
             ]);
        }

      
         Radiology::where('id','=', $id)
       -> update([
            'radiology' => $request->radiology,
            'lab_name' => $request->lab_name,
            'date' => $request->date,
        ]);

        return back();
    }

    public function destroy_radiology(Request $request){
        $radiology = Radiology::where('id', $request->radiology_id)->get();

        $path = public_path('storage/patients/' . $radiology[0]->patient_id . '/radiology/' . $radiology[0]->file);
        File::delete($path);
        
        

        Radiology::destroy('id',$request->radiology_id);
        return back();
    }

    public function search_radiology(Request $request){
        $radiologies= Radiology::where('patient_id','=', $request->patient_id)
        ->where('radiology','LIKE','%'.$request->search.'%')
        ->paginate(10);
        $id= $request->patient_id;
        return view('lab.radiology.index',compact('radiologies','id'));
    }
}