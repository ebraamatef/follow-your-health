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
                        <div class="p-0 card" style="width: 13rem;">
                            <div class="card-header">
                            <img src="{{ URL('storage/patient.png') }}" class="card-img-top" alt="...">
                            </div>
                            <div class="p-2 card-body text-center">
                            <p><br> 24, Male</p>
                            <a href="{{ URL('/doctor/request/create') }}" class="btn btn-primary">Accept</a>
                            <a class="btn btn-danger" href="{{ URL('/doctor/request/create') }}" class="btn btn-primary">Deny</a>
                            </div>
                        </div>
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
