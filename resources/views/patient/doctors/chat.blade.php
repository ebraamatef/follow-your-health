@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Chat</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-0">
            <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center text-white border-0 rounded-0">
                <b>Dr. {{ $doctor[0]->name }}</b>
            </div>
            <div class="card-body row justify-content-center">
                <div class="row">
                        @livewire('dchat', ['scnd_party' => $doctor[0]->id])
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
