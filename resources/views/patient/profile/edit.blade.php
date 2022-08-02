@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>My Profile</b></p>
        </div>
    </div>
</div>
<div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-12">
      <div class="bg-white pb-3 p-0 border-0 rounded-0">
        <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
        </div>
        <div class="p-0 card-body">
            <div class="mb-4 row justify-content-center">
                <div class="col-11 ">
                    <form action="{{URL('/patient/profile/settings')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="row justify-content-center">
                        <div class="mb-4 col-8 col-md-3">
                            <img class="w-100" src="
                            @if($user->patient->image == NULL)
                            {{ URL('storage/patient.png') }}
                            @else
                            {{ URL('storage/patients/' . $user->patient->id . '/' . $user->patient->image )}}
                            @endif
                            ">
                            <div class="mt-3">  
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div> 
                            </div>   
                            <div class="col-12 col-md-9">
                        
                                <div class="">
                                    <h3><b>Account Settings</b></h3>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">National ID</label>
                                    <input name="patient_nationail_id" type="text" class="form-control" value="{{ $user->patient->national_id }}" placeholder="Enter your National ID">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                                    <input name="patient_password" type="password" class="form-control" value="Password" placeholder="" disabled>
                                </div>
                            <div class="row">
                                <div class="col float-end">
                                <button name="save_button" type="submit" class="btn btn-primary primary_color primary_color_border">Save</button>
                                </div>
                            </div> 
                        </form>
                    </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-11">
                        <form action="{{URL('/patient/profile/contact')}}"method="post">
                            @csrf
                            @method('PUT')
                            <div class="">
                                <h4><b>Contact Information</b></h4>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input name="contact_info_patient_name"  value="{{ $user->patient->name }}" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input name="contact_info_patient_email" type="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                                    <input name="contact_info_patient_phone_number" value="{{ $user->patient->phone }}" type="number" class="form-control" placeholder="">
                                </div>
                                <div class="col mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Alternate Phone Number</label>
                                    <input name="contact_info_alternate_phone_number" type="number" value="{{ $user->patient->alt_phone }}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Address</label>
                                <input name="contact_info_patient_address" value="{{ $user->patient->address}}" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="clearfix">
                                <button name="contact_info_patient_edit_button" type="submit" class="btn btn-primary  primary_color primary_color_border float-end">Save</button>
                            </div>
                        </form> 
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-11 mb-4">
                        <form action="{{URL('/patient/profile/general')}}"method="post">
                            @csrf
                            @method('PUT')
                            <div>
                                <h4><b>General Information</b></h4>
                            </div>
                            <div class="row">
                                <fieldset class="row mb-3"  >
                                    <legend class="col-form-label col-sm-2 pt-0">Gender:</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check-inline">
                                            <input class="form-check-input"    type="radio" name="gender"  id="gridRadios1" value="male" {{ ($user->patient->gender=="Male")? "checked" : "" }}>
                                            <label class="form-check-label" for="gridRadios1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female"{{ ($user->patient->gender=="Female")? "checked" : "" }} >
                                            <label class="form-check-label" for="gridRadios2">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Marital Condition:</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="marital_condition" id="gridRadios3" value="single" {{ ($user->patient->marital=="single")? "checked" : "" }}>
                                            <label class="form-check-label" for="gridRadios3">
                                                Single
                                            </label>
                                        </div>

                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="marital_condition" id="gridRadios5" value="married" {{ ($user->patient->marital=="married")? "checked" : "" }}>
                                            <label class="form-check-label" for="gridRadios5">
                                                Married
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="marital_condition" id="gridRadios6" value="separated" {{ ($user->patient->marital=="separated")? "checked" : "" }}>
                                            <label class="form-check-label" for="gridRadios6">
                                                Separated
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="marital_condition" id="gridRadios7" value="divorced" {{ ($user->patient->marital=="divorced")? "checked" : "" }}>
                                            <label class="form-check-label" for="gridRadios7">
                                                Divorced
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="marital_condition" id="gridRadios8" value="widowed" {{ ($user->patient->marital=="widowed")? "checked" : "" }}>
                                            <label class="form-check-label" for="gridRadios8">
                                                Widowed
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="marital_condition" id="gridRadios4" value="partnered"{{ ($user->patient->marital=="partnered")? "checked" : "" }}>
                                            <label class="form-check-label" for="gridRadios4">
                                                Partnered
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Blood Type:</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood_type" id="A+" value="A+"{{ ($user->patient->blood_type=="A+")? "checked" : "" }}>
                                            <label class="form-check-label" for="A+">
                                                A+
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood_type" id="A-" value="A-"{{ ($user->patient->blood_type=="A-")? "checked" : "" }}>
                                            <label class="form-check-label" for="A-">
                                                A-
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood_type" id="B+" value="B+"{{ ($user->patient->blood_type=="B+")? "checked" : "" }}>
                                            <label class="form-check-label" for="B+">
                                                B+
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood_type" id="B-" value="B-"{{ ($user->patient->blood_type=="B-")? "checked" : "" }} >
                                            <label class="form-check-label" for="B-">
                                                B-
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood_type" id="O+" value="O+"{{ ($user->patient->blood_type=="O+")? "checked" : "" }}>
                                            <label class="form-check-label" for="O+">
                                                O+
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood_type" id="O-" value="O-"{{ ($user->patient->blood_type=="O-")? "checked" : "" }}>
                                            <label class="form-check-label" for="O-">
                                                O-
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood_type" id="AB+" value="AB+"{{ ($user->patient->blood_type=="AB+")? "checked" : "" }}>
                                            <label class="form-check-label" for="AB+">
                                                AB+
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood_type" id="AB-" value="AB-"{{ ($user->patient->blood_type=="AB-")? "checked" : "" }}>
                                            <label class="form-check-label" for="AB-">
                                                AB-
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="col mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Weight</label>
                                    <input name="weight" type="number" class="form-control-inline" id="exampleFormControlInput1" value="{{$user->patient->weight}}" placeholder="Enter your weight">
                                </div>   
                                <div class="col mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Height</label>
                                    <input name="height" type="number" class="form-control-inline" id="exampleFormControlInput1" value="{{$user->patient->height}}" placeholder="Enter your height">
                                </div>
                                <div class="col mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Date Of Birth</label>
                                    <input name="date_of_birth" type="date" class="form-control-inline" value="{{$user->patient->date_of_birth}}" id="exampleFormControlInput1">
                                </div>
                                <div class="clearfix">
                                    <button name="general_info_patient_save_button" type="submit" class="btn btn-primary primary_color primary_color_border float-end">Save</button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
  </div>
</div>
</div>
@endsection
