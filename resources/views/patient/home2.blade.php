@extends('layouts.app')
{{-- patient --}}
@section('content')

<div class="mb-5" style="width: 100%; height: 200px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='ms-4 text-white fs-1'><b>Welcome, {{ Auth::user()->name }}</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mb-0 p-2">
        <div class="col-12 col-lg-9 mb-4 px-4">
            <div class="row">
                <a href="{{ URL('patient/visits/index') }}" class="frst col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
                    <img class="mb-2" src="{{ URL('/storage/new/hospital.png') }}" style="width: 30%">
                    <b>Visits</b>
                </a>
                <a href="{{ URL('patient/doctors/index') }}" class="scnd icons_child col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
                    <img class="mb-2" src="{{ URL('/storage/new/stethoscope.png') }}" style="width: 30%">
                    <b>Doctors</b>
                </a>
                <a href="{{ URL('patient/labs/index') }}" class="thrd icons_child col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
                    <img class="mb-2" src="{{ URL('/storage/new/microscope.png') }}" style="width: 30%">
                    <b>Labs</b>
                </a>
                <a href="{{ URL('patient/medication/prescriptions/index') }}" class="frth icons_child col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
                    <img class="mb-2" src="{{ URL('/storage/new/capsule.png') }}" style="width: 30%">
                    <b>Medication</b>
                </a>
            </div>
            <div class="row">
                <a href="{{ URL('patient/allergies/index') }}" class="mfrst col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                    <img class="mb-2" src="{{ URL('/storage/new/allergy.png') }}" style="width: 30%">
                    <b>Allergies</b>
                </a>
                <a href="{{ URL('patient/surgeries/index') }}" class="mscnd col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                    <img class="mb-2" src="{{ URL('/storage/new/mask.png') }}" style="width: 30%">
                    <b>Surgeries</b>
                </a>
                <a href="{{ URL('patient/tests/index') }}" class="mthrd col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                    <img class="mb-2" src="{{ URL('/storage/new/test-tube.png') }}" style="width: 30%">
                    <b>Tests</b>
                </a>
                <a href="{{ URL('patient/radiology/index') }}" class="mfrth col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                    <img class="mb-2" src="{{ URL('/storage/new/x-ray.png') }}" style="width: 30%">
                    <b>Radiology</b>
                </a>
            </div>
            <div class="row">
                <a href="{{ URL('patient/conditions/index') }}" class="frst col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                    <img class="mb-2" src="{{ URL('/storage/new/cardiogram.png') }}" style="width: 30%">
                    <b>Medical Conditions</b>
                </a>
                <a href="{{ URL('patient/family/index') }}" class="scnd col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                    <img class="mb-2" src="{{ URL('/storage/new/family-silhouette.png') }}" style="width: 30%">
                    <b>Family History</b>
                </a>
                <a href="{{ URL('patient/readings') }}" class="thrd col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                    <img class="mb-2" src="{{ URL('/storage/new/blood-pressure.png') }}" style="width: 30%">
                    <b>BP / BS Readings</b>
                </a>
                <a href="{{ URL('patient/medical-profile') }}" class="frth col-6 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1 ">
                    <img class="mb-2" src="{{ URL('/storage/new/medical-report.png') }}" style="width: 30%">
                    <b>Medical Profile</b>
                </a>
            </div>
        </div>
        {{-- <div class="col-1"></div> --}}
        <div class="col-12 col-lg-3">
            <div class="primary_color text-white p-2 ">
                <b>Reminders</b>
                <img class="float-end" src="/storage/new/alarm-clock.png" width="20">
            </div>
            {{-- <div class='bg-white w-100 p-2 py-4 text-center'>
                You don't have reminders right now.
            </div> --}}
            <div class='bg-white w-100 text-center mb-4'>
                <div class="border-bottom border-black-50 text-start p-2">
                    Medication 
                    <img class="float-end" src="/storage/new/close.png" width="20">
                </div>
                <div class="text-start p-2">
                    <p class="text-start mb-2">Batrafen 1% topical soln. 15 ml</p>
                    <p class="text-end mb-0">12:30 PM</p>
                </div>
            </div>
            <div class='bg-white w-100 text-center mb-4'>
                <div class="border-bottom border-black-50 text-start p-2">
                    Readings 
                    <img class="float-end" src="/storage/new/close.png" width="20">
                </div>
                <div class="text-start p-2">
                    <p class="text-start mb-2">Blood Pressure Reading</p>
                    <p class="text-end mb-0">5:30 AM</p>
                </div>
            </div>
            <div class='bg-white w-100 text-center mb-4'>
                <div class="border-bottom border-black-50 text-start p-2">
                    Medication 
                    <img class="float-end" src="/storage/new/close.png" width="20">
                </div>
                <div class="text-start p-2">
                    <p class="text-start mb-2">Sanso bronchi syrup 100 ml</p>
                    <p class="text-end mb-0">12:30 PM</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".icons:a").hover(function(){
            $(this).hide();
        });
    }); 
</script>
@endsection
