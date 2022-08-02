@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Medication</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-0 ">
                <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
                    <a href="{{ URL('/doctor/patients/profile', $patient_id) }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Profile</b>
                    </a>
                </div>
                <div class="card-header border-1 primary_color_border bg-white mb-4 p-0 fs-5">
                    <form class="row g-3 ms-2" action="{{ URL('/doctor/medication/offTheCounter/search') }}" method="get">
                    @csrf
                        <div class="col-12 col-sm-6 col-md-8">
                            <div class="d-flex">
                                <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                                <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                                    <input name="search_term" type="text" class="form-control" id="searchquery" placeholder="Search...">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary primary_color border-0 mb-3">Search</button>
                                </div>
                            </div>
                        </div> 
                    </form>
                    <a href="{{ URL('/doctor/medication/offTheCounter/index', $patient_id) }}" class="me-4 mb-0 float-end p-1 ps-3 pe-3 text-decoration-none text-white fs-6 primary_color ">Off The Counter</a>
                    <a href="{{ URL('/doctor/medication/prescriptions/index', $patient_id) }}" class="me-3 float-end p-1 text-decoration-none text-dark  fs-6 ">Prescriptions</a>
                </div>
                <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 ">
                             <div class="table-responsive mb-2">
                                <table id="" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Medication</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $meds as $med )
                                        <tr>
                                            <td>{{ $med->medication }}</td>
                                            <td>{{ $med->status }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                              </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                        {{ $meds->appends(Request::all())->links() }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
