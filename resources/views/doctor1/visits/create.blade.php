@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-4 card border-0 rounded-3 shadow">
              <div class="card-header border-1 bg-white ps-3 mb-4 pt-3 fs-4">
                  <b>Visit Details</b>
              </div>
              <div class="card-body"> 
                <div class="mb-4 row justify-content-center">
                  <div class="col-11 col-sm-10 col-md-8">
                    <div class="row">
                      <div class="col">
                        <p class="m-0"><b class="fs-6">Patient Name :</b> {{ $patient_name }}</p>
                        <p class="m-0"><b class="fs-6">Doctor :</b> {{ $doctor_name }}</p>
                        <p class="m-0"><b class="fs-6">Specialty :</b> {{ $doctor_specialty }}</p>
                      </div>
                      <div class="col">
                        @php $date = date("d/m/Y")@endphp
                        <div class="float-end">
                          <p class="m-0"><b class="fs-6">Date :</b> {{ $date }} </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form action="{{ URL('doctor/visits/create') }} " method="post">
                    @csrf
                    <div class="mb-4 row justify-content-center">
                        <input type="hidden" value="{{ $date }}" name="date">
                        <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                        <div class="col-11 col-sm-10 col-md-8">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Patient Compliant</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="patient_complaint"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Visit Report</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="visit_report"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Action</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="treatment_action"></textarea>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <div class="mt-3 me-3">
                                <a target="blank" href="{{ URL('doctor/patient/medication') }}" class="btn btn-primary float-end">Make Prescription</a>
                                </div>
                                <div class="mt-3">
                                <button name="visit_details_doctor_save_button" type="submit" class="btn btn-primary float-end">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
