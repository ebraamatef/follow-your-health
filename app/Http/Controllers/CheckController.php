<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\PatientProfile;
use App\Models\Lab;
use File;


class CheckController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        
        switch(Auth::user()->type){
            case 'patient':
            {   
                $exist = Patient::where('user_id', Auth::user()->id)->first();
                if($exist){
                    return redirect('patient/home');
                }
                
                Patient::create([
                    'user_id' => Auth::user()->id,
                    'name' => Auth::user()->name
                ]);

                PatientProfile::create([
                    'patient_id' => Auth::user()->patient->id,
                ]);

                $path = public_path() . '/storage/patients/' . Auth::user()->patient->id;
                $path_tests = public_path() . '/storage/patients/' . Auth::user()->patient->id . '/testing';
                $path_radiology = public_path() . '/storage/patients/' . Auth::user()->patient->id . '/radiology';
                $path_images = public_path() . '/storage/patients/' . Auth::user()->patient->id . '/images';
                if(!file_exists($path)){
                File::makedirectory($path);
                File::makedirectory($path_tests);
                File::makedirectory($path_radiology);
                File::makedirectory($path_images);
                }

                return redirect('patient/profile/edit');
            }
            case 'doctor':
            {
                $exist = Doctor::where('user_id', Auth::user()->id)->first();
                if($exist){
                    return redirect('doctor/home');
                }
                
                Doctor::create([
                    'user_id' => Auth::user()->id,
                    'name' => Auth::user()->name
                ]);

                $path = public_path() . '/storage/doctors/' . Auth::user()->doctor->id;
                if(!file_exists($path)){
                File::makedirectory($path);
                }

                return redirect('doctor/profile/edit');
            }
            case 'lab':
            {
                $exist = Lab::where('user_id', Auth::user()->id)->first();
                if($exist){
                    return redirect('lab/home');
                }
                
                Lab::create([
                    'user_id' => Auth::user()->id,
                    'name' => Auth::user()->name
                ]);

                $path = public_path() . '/storage/labs/' . Auth::user()->lab->id;
                if(!file_exists($path)){
                File::makedirectory($path);
                }

                return redirect('lab/profile/edit');
            }
            case 'admin':
            {
                return redirect('admin/home');
            }
        }
    }
    
}
