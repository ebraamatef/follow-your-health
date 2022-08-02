@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-3 shadow">
          <div class="card-header border-1 bg-white ps-3 pt-3 fs-4">
            <b>Patients</b>
            <form class="mt-2 row g-3" action="{{ URL('/lab/patients/search') }}" method="GET">
              @csrf
              <div class="col-auto">
                <a href="{{ URL('/lab/home') }}" class="btn btn-primary mb-3" >Show My Patients</a>
              </div>
              <div class="col-6 col-sm-4 col-md-2">
                <select class="form-select" id="searchquery" name="search_in" placeholder="Search...">
                  <option value="all">All Patients</option>
                  <option value="my">My Patients</option>
                </select>
              </div>
              <div class="col-9 col-sm-6 col-md-4">
                <input type="text" class="form-control" id="searchquery" name="search_term" placeholder="Search..." required>
              </div> 
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3" >Search</button>
              </div>
            </form>
          </div>

            <div class="card-body">
                  <div class="gap-3 row justify-content-center">
                      @if($patients->isEmpty())
                          <p class="text-center fs-5">There are no results for "{{ $search_term }}"@if($search_in == 'my') in your patients
                            @endif.</p>
                        @else
                        @foreach ($patients as $patient)
                          <div class="p-0 card" style="width: 13rem;">
                              <div class="card-header">
                              <img src="{{ URL('storage/patient.png') }}" class="card-img-top" alt="...">
                              </div>
                              <div class="p-2 card-body text-center">
                              <p>{{ $patient->name  }}<br> 24, Male</p>
                              @if(dd(empty($myPatients)))
                              <form  action="{{ URL('/lab/requests/create') }}" method="POST">
                                @csrf
                                  <input type="hidden" value="{{ $patient->id }}" name="patient_id">
                                  <button type="submit" class="btn btn-primary">
                                    Send Request
                                  </button>
                              </form>
                              @endif
                              @for ($i = 0; $i < count($myPatients); $i++)
                                @if(in_array($patient->id, $request_ids))
                                  <form  action="{{ URL('/lab/requests/delete') }}" method="POST">
                                  @csrf
                                    @method('POST')
                                    <input type="hidden" value="{{ $patient->id }}" name="patient_id">
                                    <button type="submit" class="btn btn-danger">
                                      Cancel Request
                                    </button>
                                  </form>
                                  @break
                                  @elseif (!in_array($patient->id, $myPatients) || empty($myPatients))
                                  <form  action="{{ URL('/lab/requests/create') }}" method="POST">
                                    @csrf
                                      <input type="hidden" value="{{ $patient->id }}" name="patient_id">
                                      <button type="submit" class="btn btn-primary">
                                        Send Request
                                      </button>
                                  </form>
                                  @break
                                  @else

                                  <form  action="{{ URL('/lab/patients/profile') }}" method="POST">
                                    @csrf
                                      <input type="hidden" value="{{ $patient->id }}" name="patient_id">
                                      <button type="submit" class="btn btn-primary">
                                        More
                                      </button>
                                  </form>
                                  @break

                                @endif
                              @endfor
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
