@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-4 card border-0 rounded-3 shadow">
              <div class="card-header border-0 bg-white ps-3 pt-3 fs-4"><b>Visit Details</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-4 row justify-content-center">
                      <div class="col-11 col-sm-10 col-md-8">
                        <div class="row">
                          <div class="col">
                            <p class="m-0"><b class="fs-6">Patient :</b> Sameer El Ayan</p>
                            <p class="m-0"><b class="fs-6">Doctor :</b> {{ $doctor_name }}</p>
                            <p class="m-0"><b class="fs-6">Specialty :</b> {{ $specialty }}</p>
                          </div>
                          <div class="col">
                            <div class="float-end">
                              <p class="m-0"><b class="fs-6">Date :</b> {{ $visit->date }}</p>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mb-4 row justify-content-center">
                      <div class="col-11 col-sm-10 col-md-8">
                        <b class="fs-5">Patient complaints</b>
                        <p>{{ $visit->patient_complaint }}</p>

                            
                        <b class="fs-5">Visit Report</b>
                        <p>{{ $visit->visit_report }}</p>

                            
                            <b class="fs-5">Treatment Plan</b>
                            <p>{{ $visit->treatment_action }}</p>
                      </div>
                    </div>
                    <form action="{{ URL('doctor/visits/index') }}" method='post'>
                      @csrf
                    <div class="row d-flex justify-content-center">
                          <a href="{{ URL('/doctor/visits/index', $visit->patient_id) }}" class="btn btn-primary">Back to Visits</a>
                    </div>
                    </form>
                    {{-- <div class="row justify-content-center">
                      <div class="col-11 col-sm-10 col-md-8">
                        <b class="fs-5">Precription</b>
                        <div class="row">
                          <div class="col pt-2 fs-6 overflow-hidden border-bottom border-dark"><b>Medication</b></div>
                          <div class="col pt-2 overflow-hidden border-bottom border-dark"><b>Concentration</b></div>
                          <div class="col pt-2 overflow-hidden border-bottom border-dark"><b>SIG</b></div>
                          <div class="col pt-2 overflow-hidden border-bottom border-dark"><b>From</b></div>
                          <div class="col pt-2 overflow-hidden border-bottom border-dark"><b>To</b></div>
                        </div>
                        <div class="row">
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">Amarel</div>
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">2ml</div>
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">Before breakfast</div>
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">4/3/2012</div>
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">4/5/2012</div>
                        </div>
                        <div class="row">
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">Concor</div>
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">5ml</div>
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">Before bed</div>
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">4/3/2012</div>
                          <div class="col pt-3 pb-1 overflow-hidden border-bottom border-dark">4/5/2012</div>
                        </div>
                      </div>
                      <div>
                      <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Medication</th>
                            <th scope="col">Concentration</th>
                            <th scope="col">SIG</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class='clickable-row' data-href='visit_details.html'>
                            <td>Amarel</td>
                            <td>2ml</td>
                            <td>@Before breakfast</td>
                            <td>4/3/2012</td>
                            <td>4/5/2012</td>
                          </tr>
                          <tr class='clickable-row' data-href='visit_details.html'>
                            <th scope="row">2</th>
                            <td>Concor</td>
                            <td>5ml</td>
                            <td>Before bed</td>
                            <td>4/3/2012</td>
                            <td>4/5/2012</td>
                          </tr>
                        </tbody>
                      </table>
                      </div>
                    </div> --}}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
