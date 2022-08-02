@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-3 shadow">
          <div class="card-header border-1 bg-white ps-3 pt-3 fs-4">
            <b>Doctors</b>
            <form class="mt-2 row g-3" action="{{ URL('/patient/doctors/search') }}" method="POST">
              @csrf
              <div class="col-6 col-sm-4 col-md-2">
                <select class="form-select" id="searchquery" name="search_in" placeholder="Search...">
                  <option selected>Search In</option>
                  <option value="all">All Doctors</option>
                  <option value="my">My Doctors</option>
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
                    @foreach ($doctors as $doctor) 
                          <div class="p-0 card" style="width: 13rem;">
                              <div class="card-header">
                              <img src="{{ URL('storage/patient.png') }}" class="card-img-top" alt="...">
                              </div>
                              <div class="p-2 card-body text-center">
                              <p>
                                    {{ $doctor->name }}<br> 24, Male</p>

                                  <form action="{{ URL('/doctor/requests/create') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" value="{{ $doctor->id }}" name="patient_id">
                                    <button type="submit" class="btn btn-primary">More</button>
                                  </form>
                              </div>
                          </div>
                    @endforeach

                    {{-- @foreach ($myPatients as $myPatient )
                        <div class="p-0 card" style="width: 13rem;">
                            <div class="card-header">
                            <img src="{{ URL('storage/patient.png') }}" class="card-img-top" alt="...">
                            </div>
                            <div class="p-2 card-body text-center">
                            <p>{{ $myPatient['name'] }}<br> 24, Male</p>
                            <a href="{{ URL('/doctor/request/create') }}" class="btn btn-primary">Send Request</a>
                            </div>
                        </div>
                    @endforeach --}}
                    {{-- @endif --}}
                    
                    {{-- <div class="p-0 card" style="width: 13rem;">
                      <div class="card-header">
                        <img src="{{ URL('storage/patient.png') }}" class="card-img-top" alt="...">
                      </div>
                      <div class="p-2 card-body text-center">
                        <p>Nader Mohamed Hamdy<br> 24, Male</p>
                        <a href="{{ URL('profile/patient') }}" class="btn btn-primary">More</a>
                      </div>
                    </div> --}}
                  </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
