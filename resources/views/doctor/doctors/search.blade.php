@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Doctors</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-0">
          <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
              <a href="{{ URL('/doctor/patients/profile', $patient_id) }}" class="float-start text-decoration-none text-white fs-6">
                  <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Profile</b>
              </a>
          </div>
          <div class="card-header border-1 bg-white ps-3 fs-4">
            <form class="row g-3" action="{{ URL('/doctor/doctors/search') }}" method="GET">
              @csrf
              <input type="hidden" value="{{ $patient_id }}" name="patient_id">  
              <div class="col-12 col-sm-6 col-md-4">
                <input type="text" class="form-control" id="searchquery" name="search_term" placeholder="Search..." required>
              </div> 
              <div class="col-auto">
                <button type="submit" class="btn btn-primary primary_color border-0 mb-3">Search</button>
                <a href="{{ URL('/doctor/patient/doctors', $patient_id) }}" class="btn btn-primary primary_color border-0 mb-3" >All Doctors</a>
              </div>
            </form>
          </div>

            <div class="card-body">
                
                  <div class="gap-3 row justify-content-center">
                      @if ($doctors->isEmpty())
                        <p class="text-center">No results for <b>{{ $search_term }}</b>.</p>
                        @else
                        @foreach($doctors as $doctor)
                          <div class="p-0 card" style="width: 13rem;">
                              <div class="card-header">
                              <img src="@if($doctor->image == NULL) {{ URL('storage/doctor.png') }}@else{{ URL('storage/doctors/' . $doctor->user_id . '/' . $doctor->image) }}@endif" class="card-img-top" alt="...">
                              </div>
                              <div class="p-0 card-body text-center">
                              <p class="mb-0 mt-1"><b>Dr. {{ $doctor->name }}</b></p>
                              <p class="mb-0">{{ $doctor->speciality }}</p>
                              <a href="{{ URL('/doctor/doctors/profile', $doctor->id) }}" class="btn btn-primary primary_color border-0 mt-1 mb-2">
                                View Profile
                              </a>
                              </div>
                          </div>
                        @endforeach
                      @endif
                  </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
