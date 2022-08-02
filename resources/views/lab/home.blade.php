@extends('layouts.app')
{{-- patient --}}
@section('content')

<div class="mb-5" style="width: 100%; height: 200px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Welcome, {{ Auth::user()->name }}</b></p>
        </div>
    </div>
</div>
<div class="container pb-5">
    <div class="row p-2 mb-5 justify-content-center">
        <a href="{{ URL('/lab/patients/index') }}" class="scnd  col-10 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
            <img class="mb-2" src="{{ URL('/storage/new/people.png') }}" style="width: 30%">
            <b>My Patients</b>
        </a>
        <a href="{{ URL('/lab/patients/find') }}" class="frst icons_child col-10 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
            <img class="mb-2" src="{{ URL('/storage/new/searching-a-person.png') }}" style="width: 30%">
            <b>Find Patients</b>
        </a>
        <a href="{{ URL('/lab/requests/index') }}" class="scnd icons_child col-10 col-lg-3 d-flex flex-column text-white text-decoration-none justify-content-center align-items-center" style="aspect-ratio: 1 / 1">
            <img class="mb-2" src="{{ URL('/storage/new/add-friend.png') }}" style="width: 30%">
            <b>Requests</b>
        </a>
    </div>
</div>
@endsection
