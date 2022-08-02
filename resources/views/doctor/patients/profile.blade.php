@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Patient Profile</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="pb-3 p-0 card border-0 rounded-0">
            <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
            </div>
            <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="mb-4 col-8 col-md-3 ">
                                <img class="w-100" src="@if($patient[0]->name == NULL) {{ URL('storage/patient.png') }}@else{{ URL("storage/patients/" . $patient[0]->id . "/" . $patient[0]->image) }}@endif">
                                <div class="btn btn-danger mt-2 " data-bs-toggle="modal" data-bs-target="#deletemodal">Remove Patient</div>
                                <a href="{{ URL('/doctor/patient/chat', $patient[0]) }}" class="btn btn-primary primary_color primary_color_border float-end mt-2">Chat</a>
                                <form class="" action="{{url('/doctor/patients/remove')}}" method="POST">
                                    @csrf
                                    @method('DELETE')   
                                    <input type="hidden" name="patient_id"  value="{{ $patient[0]->id }}" class="form-control" >
                                    <div class="modal" tabindex="-1" id="deletemodal">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title"><b>Remove Patient</b></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <p>Are you sure you want to remove {{ $patient[0]->name }} ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="">
                                    <h4><b>Contact info.</b></h4>
                                </div>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $patient[0]->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>E-mail</b></td>
                                            <td>{{ $patient[0]->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone Number</b></td>
                                            <td>{{ $patient[0]->phone }}</td>
                                            
                                        </tr>
                                        <tr>
                                            <td><b>Alt. Phone Number</b></td>
                                            <td>{{ $patient[0]->alt_phone }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{ $patient[0]->address }}</td>
                                        </tr>
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
    <div class="row justify-content-center mb-5">
        <div class="row">
            <a href="{{ URL('/doctor/visits/index', $patient[0]->id) }}" class="frst col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
                <img class="mb-2" src="{{ URL('/storage/new/hospital.png') }}" style="width: 30%">
                <b>Visits</b>
            </a>
            <a href="{{ URL('/doctor/patient/doctors', $patient[0]->id) }}" class="scnd icons_child col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
                <img class="mb-2" src="{{ URL('/storage/new/stethoscope.png') }}" style="width: 30%">
                <b>Doctors</b>
            </a>
            <a href="{{ URL('doctor/patient/medical-profile', $patient[0]->id) }}" class="thrd col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                <img class="mb-2" src="{{ URL('/storage/new/medical-report.png') }}" style="width: 30%">
                <b>Medical Profile</b>
            </a>
            <a href="{{ URL('/doctor/medication/prescriptions/index', $patient[0]->id) }}" class="frth icons_child col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
                <img class="mb-2" src="{{ URL('/storage/new/capsule.png') }}" style="width: 30%">
                <b>Medication</b>
            </a>
        </div>
        <div class="row">
            <a href="{{ URL('/doctor/allergies/index', $patient[0]->id) }}" class="mfrst col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                <img class="mb-2" src="{{ URL('/storage/new/allergy.png') }}" style="width: 30%">
                <b>Allergies</b>
            </a>
            <a href="{{ URL('/doctor/surgeries/index', $patient[0]->id) }}" class="mscnd col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                <img class="mb-2" src="{{ URL('/storage/new/mask.png') }}" style="width: 30%">
                <b>Surgeries</b>
            </a>
            <a href="{{ URL('doctor/tests/index', $patient[0]->id) }}" class="mthrd col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                <img class="mb-2" src="{{ URL('/storage/new/test-tube.png') }}" style="width: 30%">
                <b>Tests</b>
            </a>
            <a href="{{ URL('doctor/radiology/index', $patient[0]->id) }}" class="mfrth col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                <img class="mb-2" src="{{ URL('/storage/new/x-ray.png') }}" style="width: 30%">
                <b>Radiology</b>
            </a>
        </div>
        <div class="row justify-content-center">
            <a href="{{ URL('doctor/conditions/index', $patient[0]->id) }}" class="frst col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                <img class="mb-2" src="{{ URL('/storage/new/cardiogram.png') }}" style="width: 30%">
                <b>Medical Conditions</b>
            </a>
            <a href="{{ URL('doctor/family/index', $patient[0]->id) }}" class="scnd col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                <img class="mb-2" src="{{ URL('/storage/new/family-silhouette.png') }}" style="width: 30%">
                <b>Family History</b>
            </a>
            <a href="{{ URL('doctor/readings', $patient[0]->id) }}" class="thrd col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                <img class="mb-2" src="{{ URL('/storage/new/blood-pressure.png') }}" style="width: 30%">
                <b>BP / BS Readings</b>
            </a>
        </div>
    </div>
</div>
@endsection
