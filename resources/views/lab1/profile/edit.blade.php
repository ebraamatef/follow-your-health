@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="bg-white pb-3 p-0 border-0 rounded-3 shadow">
        <div class="card-header border-1 bg-white  mb-4 ps-3 pt-3 fs-4">
          <b>Profile</b>
        </div>
        <div class="p-0 card-body">
            <form action="{{ URL('/lab/profile/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 row justify-content-center">
                <div class="col-11 ">
                    <div class="row justify-content-center">
                        <div class="row justify-content-center">
                            <div class="mb-4 col-8 col-md-3">
                              <img class="mb-3 w-100" 
                              src="
                              @if($lab[0]->image == NULL)
                              {{ URL('storage/lab.png') }}
                              @else
                              {{ URL('storage/labs/' . $user->id . '/' . $lab[0]->image )}}
                              @endif
                              ">
                              <input class="form-control" type="file" name="image" value="{{  $lab[0]->image }}">
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
                                    <label for="exampleFormControlInput1" class="form-label">Type</label>
                                    <div class="">
                                        <input name="type" type="text" class="form-control" placeholder="" value="{{ $user->type }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" placeholder="" value="PASSWORD" disabled>
                                </div>                                        
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
                                    <input name="phone" type="text" class="form-control" placeholder="" value="{{ $user->lab->phone }}">
                                </div>
                                <div class="col mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Alternate Phone Number</label>
                                    <input name="alt_phone" type="text" class="form-control" placeholder="" value="{{ $user->lab->alt_phone }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Clinic Address</label>
                                <input name="clinic_address" type="text" class="form-control" placeholder="" value="{{ $user->lab->address }}">
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
