@extends('layouts.app')
{{-- patient --}}
@section('content')
    <div class="container">
        <div class="row  mb-5 mt-5">
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
                            <a  class="text-decoration-none border-0 text-dark" href="{{ URL('patient/medication/prescriptions/index') }}">
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
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('patient/conditions/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="problems" src="{{ URL('storage/folder.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Medical Conditions</h5>
                                </div>
                            </a>
                        </div>
                        <div class="p-4 d-flex flex-row flex-wrap justify-content-center align-items-center container-fluid" style="gap: 100px">
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('patient/family/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="surgeries" src="{{ URL('storage/surgical-mask.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Family History</h5>
                                </div>
                            </a>
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('patient/labs/index') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="surgeries" src="{{ URL('storage/surgical-mask.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Labs</h5>
                                </div>
                            </a>
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('/patient/medical-profile') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="surgeries" src="{{ URL('storage/surgical-mask.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">Medical Profile</h5>
                                </div>
                            </a>
                            <a class="text-decoration-none border-0 text-dark" href="{{ URL('/patient/readings') }}">
                                <div class="card border-0" style="width: 8rem;">
                                    <img id="surgeries" src="{{ URL('storage/surgical-mask.png') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title  text-center p-3">BP / BG Log</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 p-0">
                <div class='bg-white shadow w-100 p-0 mb-4'>
                    <div class="bg-primary text-white p-2">
                        <b>Blood Pressure Measurement</b>
                    </div>
                    <form action="{{ URL('patient/bplog/create') }}" method="get" class="row p-2">
                        @csrf
                        <div class="row">
                            <div class="col-auto">
                                <label for="staticEmail2" class="">Date</label>
                                <input type="date" class="form-control" id="staticEmail2" name="date">
                            </div>
                            <div class="col-auto">
                                <label for="staticEmail2" class="">Time</label>
                                <input type="time" class="form-control" id="staticEmail2" name="time">
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-4">
                            <input type="number" class="form-control" id="inputPassword2" name="reading_top">
                            </div>
                            <div class="col-1 fs-3">
                            <b>/</b>
                            </div>
                            <div class="col-4">
                            <input type="number" class="form-control" id="inputPassword2" name="reading_bottom">
                            </div>
                            <div class="col-4">
                            <button type="submit" class="btn btn-primary mb-3">add</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class='bg-white shadow w-100 p-0 mb-4'>
                    <div class="bg-primary text-white p-2">
                        <b>Blood Sugar Measurement</b>
                    </div>
                    <form action="{{ URL('patient/bplog/create') }}" method="get" class="row p-2">
                        @csrf
                        <div class="row">
                            <div class="col-auto">
                                <label for="staticEmail2" class="">Date</label>
                                <input type="date" class="form-control" id="staticEmail2" name="date">
                            </div>
                            <div class="col-auto">
                                <label for="staticEmail2" class="">Time</label>
                                <input type="time" class="form-control" id="staticEmail2" name="time">
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-4">
                            <input type="number" class="form-control" id="inputPassword2" name="reading_top">
                            </div>
                            <div class="col-1 fs-3">
                            <b>/</b>
                            </div>
                            <div class="col-4">
                            <input type="number" class="form-control" id="inputPassword2" name="reading_bottom">
                            </div>
                            <div class="col-4">
                            <button type="submit" class="btn btn-primary mb-3">add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
