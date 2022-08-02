@extends('layouts.app')
{{-- patient --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card border-0 rounded-3 shadow">
                
                    <div class="card-header border-1 bg-white  mb-4 ps-3 pt-3 fs-4  "><b>Dashboard</b></div>
                    <div class="p-0 card-body">
                        <div class="p-4 d-flex flex-row flex-wrap justify-content-center align-items-center container-fluid" style="gap: 100px">
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('patient/visits/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="visits" src="{{ URL('storage/hospital.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Visits</h5>
                                </div>
                            </a>
                            <a  class="text-decoration-none border-0 text-dark" href="{{ URL('/patient/doctors/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="doctors" src="{{ URL('storage/stethoscope.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Doctors</h5>
                                </div>
                            </a>
                            <a  class="text-decoration-none border-0 text-dark" href="{{ URL('patient/medication/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="medication" src="{{ URL('storage/tablet.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Medication</h5>
                                </div>
                            </a>
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('patient/allergies/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="allergies" src="{{ URL('storage/antibiotic.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Allergies</h5>
                                </div>
                            </a>
                        </div>
                        <div class="p-4 d-flex flex-row flex-wrap justify-content-center align-items-center container-fluid" style="gap: 100px">
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('patient/surgeries/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="surgeries" src="{{ URL('storage/surgical-mask.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Surgeries</h5>
                                </div>
                            </a>
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('patient/tests/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="tests" src="{{ URL('storage/microscope.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Tests</h5>
                                </div>
                            </a>
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('patient/radiology/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="radiology" src="{{ URL('storage/x-ray.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Radiology</h5>
                                </div>
                            </a>
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('patient/doctors/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="problems" src="{{ URL('storage/folder.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Problems</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 bg-white shadow ">
                <div id="app1"></div>
            </div>
        </div>
    </div>
    @if (Session::has('successMsg'))
        <div class="alert alert-success"> {{ Session::get('successMsg') }}</div>
    @endif
@endsection
