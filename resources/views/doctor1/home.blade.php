@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-3 shadow">
          <div class="card-header border-1 bg-white ps-3 pt-3 fs-4">
            <b>Patients</b>
            <form class="mt-2 row g-3" action="{{ URL('/doctor/patient/search') }}" method="GET">
              @csrf
              <div class="col-6 col-sm-4 col-md-2">
                <select class="form-select" id="searchquery" name="search_in" placeholder="Search...">
                  <option value="all" selected="selected">All Patients</option>
                  <option value="my">My Patients</option>
                </select>
              </div>
              <div class="col-9 col-sm-6 col-md-4">
                <input type="text" class="form-control" id="searchquery" name="search_term" placeholder="Search..." required>
              </div> 
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Search</button>
              </div>
            </form>
          </div>

            <div class="card-body">
                
                  <div class="gap-3 row justify-content-center">
                    @if (empty($myPatients))
                        You don't have any patients
                        @else
                        @php ($myPatientsSize = count($myPatients[0]['patients']))
                        @for($i = 0; $i < $myPatientsSize; $i++)
                          <div class="p-0 card" style="width: 13rem;">
                              <div class="card-header">
                              <img src="{{ URL('storage/patient.png') }}" class="card-img-top" alt="...">
                              </div>
                              <div class="p-2 card-body text-center">
                              <p>{{ $myPatients[0]['patients'][$i]['name'] }}<br> 24, Male</p>
                              <form  class="mb-2" action="{{ URL('/doctor/patient/profile') }}" method="POST">
                                @csrf
                                  <input type="hidden" value="{{ $myPatients[0]['patients'][$i]['id'] }}" name="patient_id">
                                  <button type="submit" class="btn btn-primary">
                                    Start Visit
                                  </button>
                              </form>
                              <form  action="{{ URL('/doctor/patient/profile') }}" method="POST">
                                @csrf
                                  <input type="hidden" value="{{ $myPatients[0]['patients'][$i]['id'] }}" name="patient_id">
                                  <button type="submit" class="btn btn-primary">
                                    View Profile
                                  </button>
                              </form>
                              </div>
                          </div>
                        @endfor
                      @endif
                  </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
