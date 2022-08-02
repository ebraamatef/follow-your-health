@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="bg-white pb-3 p-0 border-0 rounded-3 shadow">
        <div class="card-header border-1 bg-white  mb-4 ps-3 pt-3 fs-4">
          <b> Doctor Profile</b>
        </div>
        <div class="p-0 card-body">
            <form action="{{ URL('/doctor/profile/update') }}" method="POST">
                @csrf
                <div class="mb-4 row justify-content-center">
                <div class="col-11 ">
                    <div class="row justify-content-center">
                        <div class="mb-4 col-8 col-md-3">
                            <img class="w-100" src="{{ URL('storage/doctor.png') }}">
                            <div class="mt-3">  
                                {{-- <input class="form-control" type="file" id="formFile"> --}}
                            </div> 
                        </div>   
                    <div class="col-12 col-md-9">
                                <div class="">
                                    <h3><b>Account Settings</b></h3>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                    <div class="">
                                        <input name="name" type="text" class="form-control" placeholder="" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" placeholder="" value="PASSWORD" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">National ID</label>
                                    <input name="national_id" type="text" class="form-control" placeholder="Enter your National ID" value="{{ $user->doctor->national_id }}">
                                </div>                                            
                    </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-11">
                            <div class="mb-4">
                                <h4><b>General Info.</b></h4>
                            </div>
                            <div class="mb-2">
                                <div class="col-sm-10">
                                    <label for="exampleFormControlInput1" class="form-label me-2"><b>Gender :</b></label>
                                    <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" @if ($user->doctor->gender == "male") checked @endif>
                                    <label class="form-check-label" for="gridRadios1">
                                        Male
                                    </label>
                                    </div>
                                    <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female" @if ($user->doctor->gender == "female") checked @endif>
                                    <label class="form-check-label" for="gridRadios2">
                                        Female
                                    </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Speciality</label>
                                    <input name="speciality" type="text" class="form-control" placeholder="Speciality" value="{{ $user->doctor->speciality }}">
                                </div> 
                            </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-11">
                            <div class="">
                                <h4><b>Contact Information</b></h4>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <div class="">
                                    <input name="email" type="email" class="form-control" placeholder="" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                                    <input name="phone" type="text" class="form-control" placeholder="" value="{{ $user->doctor->phone }}">
                                </div>
                                <div class="col mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Alternate Phone Number</label>
                                    <input name="alt_phone" type="text" class="form-control" placeholder="" value="{{ $user->doctor->alt_phone }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Clinic Address</label>
                                <input name="clinic_address" type="text" class="form-control" placeholder="" value="{{ $user->doctor->clinic_address }}">
                            </div>
                            <div class="clearfix">
                                <button name="contact_info_patient_edit_button" type="submit" class="btn btn-primary float-end">Edit</button>
                            </div>
                    </div>
                </div>
              </div>
            </form> 
          </div>
      </div>
  </div>
  </div>
</div>
</div>
@endsection
