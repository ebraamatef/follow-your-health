@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Find Patients</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-0">
          <div class="card-header border-1 primary_color  mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
          </div>
          <div class="card-header border-1 primary_color_border bg-white mb-4 p-0 fs-5">
              <form class="row g-3 ms-2 mb-3" action="{{ URL('/doctor/patients/search') }}" method="get">
              @csrf
                  <div class="col-12 col-sm-6 col-md-8">
                      <div class="d-flex">
                          <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                            <input type="hidden" value="all" name="search_in"> 
                            <input name="search_term" type="text" class="form-control" id="searchquery" placeholder="Search...">
                          </div>
                          <div class="col-auto">
                              <button type="submit" class="btn btn-primary primary_color border-0 mb-2">Search</button>
                          </div>
                      </div>
                  </div> 
              </form>
              <a href="{{ URL('doctor/requests/index') }}" class="me-3 mb-0 float-end p-1 text-decoration-none text-dark fs-6 ">Requests</a>
              <a href="{{ URL('/doctor/patients/find') }}" class="me-1 float-end p-1 ps-3 pe-3  text-decoration-none text-white fs-6 primary_color">Find Patients</a>
              <a href="{{ URL('/doctor/patients/index') }}" class="me-1 mb-0 float-end p-1 text-decoration-none text-dark fs-6">My Patients</a>
          </div>
            <div class="card-body">
                  <div class="gap-3 row justify-content-center">
                      Find patients by name.
                  </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
