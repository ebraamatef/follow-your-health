@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Readings</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rouded-0">
                <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
                    <a href="{{ URL('/doctor/patients/profile', $patient_id) }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Profile</b>
                    </a>
                </div>
                <div class="card-header border-1 primary_color_border bg-white mb-4 p-0 fs-5">
                    <a href="{{ URL('/doctor/readings/bs/index', $patient_id) }}" class="me-4 mb-0 float-end p-1 ps-3 pe-3 text-decoration-none text-white fs-6 primary_color">Blood Sugar</a>
                    <a href="{{ URL('/doctor/readings', $patient_id) }}" class="me-3 float-end p-1  text-decoration-none text-dark fs-6 ">Blood Pressure</a>
                </div>
            <div class="p-0 card-body">
                <div class=" row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <table id="" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Reading</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($readings as $reading)
                                        <tr class='clickable-row' data-href=''>
                                            <td>{{ $reading->date }}</td>
                                            <td>{{ $reading->time }}</td>
                                            <td>{{ $reading->reading }} {{ $reading->unit }}</td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center w-100 mb-0">
                            {{ $readings->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
