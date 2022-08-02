@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Visit Details</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="pb-4 mb-5 card border-0 rounded-0">
              <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
                  <a href="{{ URL('/patient/visits/index') }}" class="float-start text-decoration-none text-white fs-6">
                      <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Visits</b>
                  </a>
              </div>
                <div class="card-body">
                    <div class="mb-4 row justify-content-center">
                      <div class="col-11 col-sm-10 col-md-8">
                        <div class="row">
                          <div class="col">
                            <p class="m-0"><b class="fs-6">Patient :</b> {{ $visit[0]['patient']['name'] }}</p>
                            <p class="m-0"><b class="fs-6">Doctor :</b> {{ $visit[0]['doctor_name'] }}</p>
                            <p class="m-0"><b class="fs-6">Specialty :</b> {{ $visit[0]['specialty'] }}</p>
                          </div>
                          <div class="col">
                            <div class="float-end">
                              @php $date = date("d/m/Y")@endphp
                              <p class="m-0"><b class="fs-6">Date :</b> {{ $visit[0]['date'] }}</p>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mb-4 row justify-content-center">
                      <div class="col-11 col-sm-10 col-md-8">
                        <b class="fs-5">Patient complaints</b>
                        <div class="p-2 w-100 border rounded-3 border-dark-50" style="min-height: 150px; height:auto; margin: 10px 0px 25px 0px;">
                          <p>{{ $visit[0]['patient_complaint'] }}</p>
                        </div>
                            
                        <b class="fs-5">Visit Report</b>
                        <div class="p-2 w-100 border rounded-3 border-dark-50" style="min-height: 150px; height:auto; margin: 10px 0px 25px 0px;">
                          <p>{{ $visit[0]['visit_report'] }}</p>
                        </div>
 
                        <b class="fs-5">Action</b>
                        <div class="p-2 w-100 border rounded-3 border-dark-50" style="min-height: 150px; height:auto; margin: 10px 0px 25px 0px;">
                          <p>{{ $visit[0]['treatment_action'] }}</p>
                        </div>
                        <b class="fs-5 mb-5">Prescription</b>
                        <div class="table-responsive mb-2">
                          <table id="" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Medication</th>
                                    <th scope="col">Instructions</th>
                                    <th scope="col">Start</th>
                                    <th scope="col">End</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ( $prescriptions as $prescription )
                                <tr class='clickable-row' data-href=''>
                                  <td>{{ $prescription->medication }}</td>
                                  <td>{{ $prescription->instructions }}</td>
                                  <td>{{ $prescription->start_date }}</td>
                                  <td>{{ $prescription->end_date }}</td>
                                  <td>@if(strtotime($prescription->end_date) < strtotime(date('m/d/Y'))) <span class='text-danger'>Inactive</span> @elseif(strtotime($prescription->end_date) > strtotime(date('m/d/Y'))) <span class='text-success'>Active</span> @endif</td> 
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
