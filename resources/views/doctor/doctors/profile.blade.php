@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Doctor Profile</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-12">
        <div class="mb-5 pb-3 p-0 card border-0 rounded-0">
            <div class="card-header border-1 primary_color mb-4 fs-4 p-3 d-flex align-items-center border-0 rounded-0">
            </div>
            <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="mb-4 col-8 col-md-3">
                                <img class="w-100" src="@if($doctor[0]->image == NULL) {{ URL('storage/doctor.png') }}@else{{ URL('storage/doctors/' . Auth::user()->id . '/' . $doctor[0]->image) }}@endif">
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="">
                                    <h4><b>Contact info.</b></h4>
                                </div>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $doctor[0]->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Specialty</b></td>
                                            <td>{{ $doctor[0]->speciality }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>E-mail</b></td>
                                            <td>{{ $doctor[0]->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone Number</b></td>
                                            <td>{{ $doctor[0]->phone }}</td>
                                            
                                        </tr>
                                        <tr>
                                            <td><b>Alt. Phone Number</b></td>
                                            <td>{{ $doctor[0]->alt_phone }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td><b>Clinic Address</b></td>
                                            <td>{{ $doctor[0]->clinic_address }}</td>
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
</div>
@endsection
