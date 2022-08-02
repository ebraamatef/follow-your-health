@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-3 shadow">
          <div class="card-header border-1 bg-white ps-3 pt-3 fs-4">
            <b>Doctors/Specialists</b>
            <form class="mt-2 row g-3" action="{{ URL('/patient/doctors/search') }}" method="POST">
              @csrf
              <div class="col-6 col-sm-4 col-md-2">
                <select class="form-select" id="searchquery" name="search_in" placeholder="Search...">
                  <option selected>Search In</option>
                  <option value="all">All Patients</option>
                  <option value="my">My Patients</option>
                </select>
              </div>
              <div class="col-6 col-sm-4 col-md-2">
                <select class="form-select" id="searchquery" name="search_by" placeholder="Search...">
                  <option selected>Search By</option>
                  <option value="name">Name</option>
                  <option value="speciality">Speciality</option>
                </select>
              </div>
              <div class="col-9 col-sm-6 col-md-4">
                <input type="text" class="form-control" id="searchquery" name="search_term" placeholder="Search...">
              </div> 
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Search</button>
              </div>
            </form>
          </div>

            <div class="card-body">
                    
              <div class="gap-3 row justify-content-center">
                {{-- {{ dd($doctors) }} --}}
                    @php ($myDoctorsSize = count($myDoctors))
                    @for ($i = 0; $i < $myDoctorsSize; $i++) 
                      <div class="p-0 card" style="width: 13rem;">
                          <div class="card-header">
                          <img src="{{ URL('storage/doctor.png') }}" class="card-img-top" alt="...">
                          </div>
                          <div class="p-2 card-body text-center">
                          <p>
                                {{ $myDoctors[$i]['name'] }}<br> 24, Male</p>

                              <form action="{{ URL('/doctor/requests/create') }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" value="{{ $myDoctors[$i]['id'] }}" name="patient_id">
                                <button type="submit" class="btn btn-primary">More</button>
                              </form>
                          </div>
                      </div>
                @endfor
              </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
