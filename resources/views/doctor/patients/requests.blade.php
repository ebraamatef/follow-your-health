@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Requests</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-12">
        <div class=" card border-0 rounded-0">
          <div class="card-header border-1 primary_color  mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
          </div>
          <div class="card-header border-1 primary_color_border bg-white mb-2 p-0 fs-5">
             
              <a href="{{ URL('doctor/requests/index') }}" class="me-1 float-end p-1 ps-3 pe-3  text-decoration-none text-white fs-6 primary_color">Requests</a>
              <a href="{{ URL('/doctor/patients/find') }}" class="me-1 mb-0 float-end p-1 text-decoration-none text-dark fs-6">Find Patients</a>
              <a href="{{ URL('/doctor/patients/index') }}" class="me-1 mb-0 float-end p-1 text-decoration-none text-dark fs-6">My Patients</a>
          </div>

            <div class="card-body">
                
                  <div class="gap-3 row justify-content-center">
                      @if ($requests->isEmpty())
                        You have no requests pending at the moment.
                        @else
                        @foreach($requests as $request)
                          <div class="p-0 card" style="width: 13rem;">
                              <div class="card-header">
                              <img src="@if($request->name == NULL) {{ URL('storage/patient.png') }}@else{{ URL("storage/patients/" . $request->id . "/" . $request->image) }}@endif" class="card-img-top" alt="...">
                              </div>
                              <div class="p-0 card-body text-center">
                              <p class="mb-0 mt-1"><b>{{ $request->name  }}</b></p>
                              <form  action="{{ URL('/doctor/requests/delete') }}" method="POST">
                                @csrf
                                  @method('POST')
                                  <input type="hidden" value="{{ $request->id }}" name="patient_id">
                                  <button type="submit" class="btn btn-danger border-0 mt-1 mb-2">
                                    Cancel Request
                                  </button>
                                </form>
                              </div>
                          </div>
                        @endforeach
                      @endif
                  </div>
                  
                  <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
