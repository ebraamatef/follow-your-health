@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Lab Request</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-o">
          <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
              <a href="{{ URL('/patient/home') }}" class="float-start text-decoration-none text-white fs-6">
                  <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Dashboard</b>
              </a>
          </div>
          <div class="card-header border-1 primary_color_border bg-white mb-4 p-0 fs-5">
            <a href="{{ URL('/patient/labs/requests') }}" class="me-1 float-end p-1 ps-3 pe-3  text-decoration-none text-white fs-6 primary_color">Requests</a>
            <a href="{{ URL('/patient/labs/find') }}" class="me-3 mb-0 float-end p-1 text-decoration-none text-dark fs-6 ">Find Labs</a>
            <a href="{{ URL('/patient/labs/index') }}" class="me-3 mb-0 float-end p-1 text-decoration-none text-dark fs-6 ">My Labs</a>
          </div>

            <div class="card-body">
                
                  <div class="gap-3 row justify-content-center">
                      @if ($requests->isEmpty())
                        You have no requests pending at the moment.
                        @else
                        @foreach($requests as $request)
                          <div class="p-0 card" style="width: 13rem;">
                              <div class="card-header">
                              <img src="@if($request->image == NULL) {{ URL('storage/lab.png') }}@else{{ URL("storage/labs/" . $request->user_id . "/" . $request->image) }}@endif" class="card-img-top" alt="...">
                              </div>
                              <div class="p-0 card-body text-center">
                              <p class="mb-0 mt-1"><b>{{ $request->name }}</b></p>
                              <p class="mb-1">{{ $request->type }}</p>
                              <form  class="mb-3" action="{{ URL('/patient/labs/accept_request') }}" method="POST">
                                @csrf
                                  @method('POST')
                                  <input type="hidden" value="{{ $request->id }}" name="lab_id">
                                  <button type="submit" class="btn btn-primary  primary_color border-0 mt-1">
                                    Accept Request
                                  </button>
                              </form>
                              <form  action="{{ URL('/patient/labs/delete_request') }}" method="POST">
                                @csrf
                                  @method('POST')
                                  <input type="hidden" value="{{ $request->id }}" name="lab_id">
                                  <button type="submit" class="btn btn-danger mb-2">
                                    Cancel Request
                                  </button>
                              </form>   
                              </div>
                          </div>
                        @endforeach
                      @endif
                  </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
