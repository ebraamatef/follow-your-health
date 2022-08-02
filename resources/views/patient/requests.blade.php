@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-3 shadow">
          <div class="card-header border-1 bg-white ps-3 pt-3 fs-4">
            <b>Requests</b>
          </div>

            <div class="card-body">
                
                  <div class="gap-3 row justify-content-center"> 
                    @foreach ($doctors as $doctor)
                      <div class="p-0 card" style="width: 13rem;">
                        <div class="card-header">
                        <img src="{{ URL('storage/patient.png') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="p-2 card-body text-center">
                          <p><br>{{ $doctor->name }} 24, Male</p>
                          <form action="{{ URL('/patient/requests/accept') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" value="{{ $doctor->id }}" name="doctor_id">
                            <button type="submit" class="btn btn-primary">Accept</button>
                          </form>
                          <form action="{{ URL('/doctor/requests/create') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" value="" name="patient_id">
                            <button type="submit" class="btn btn-danger">Deny</button>
                          </form>
                          </div>
                      </div>
                    @endforeach
                        
                    {{-- <div class="p-0 card" style="width: 13rem;">
                      <div class="card-header">
                        <img src="{{ URL('storage/patient.png') }}" class="card-img-top" alt="...">
                      </div>
                      <div class="p-2 card-body text-center">
                        <p>Nader Mohamed Hamdy<br> 24, Male</p>
                        <a href="{{ URL('profile/patient') }}" class="btn btn-primary">More</a>
                      </div>
                    </div> --}}
                  </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
