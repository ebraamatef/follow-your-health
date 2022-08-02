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
            <form action="{{ URL('/doctor/profile/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 row justify-content-center">
                <div class="col-11 ">
                    <div class="row justify-content-center">
                        <div class="mb-4 col-8 col-md-3">
                            <img class="mb-3 w-100" 
                            src="
                            @if($user->doctor->image == NULL)
                            {{ URL('storage/doctor.png') }}
                            @else
                            {{ URL('storage/doctors/' . $user->doctor->id . '/' . $user->doctor->image )}}
                            @endif
                            ">
                            <input class="form-control" type="file" name="image" value="{{  $user->doctor->image }}">
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
                                    <label for="exampleFormControlInput1" class="form-label">Speciality</label>
                                    <input name="speciality" type="text" class="form-control" placeholder="Speciality" value="{{ $user->doctor->speciality }}">
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
                <div class="row justify-content-center p-0">
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
                                    <label for="exampleFormControlInput1" class="form-label">Alt. Phone Number</label>
                                    <input name="alt_phone" type="text" class="form-control" placeholder="" value="{{ $user->doctor->alt_phone }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Clinic Address</label>
                                <input name="clinic_address" type="text" class="form-control" placeholder="" value="{{ $user->doctor->clinic_address }}">
                            </div>
                            <div class="clearfix">
                                <button name="contact_info_patient_edit_button" type="submit" class="btn btn-primary primary_color primary_color_border float-end">Save</button>
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
