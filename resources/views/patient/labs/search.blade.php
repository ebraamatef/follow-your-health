@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Find Labs</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-12">
        <div class="pb-3 card border-0 rounded-0">
          <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
              <a href="{{ URL('/patient/home') }}" class="float-start text-decoration-none text-white fs-6">
                  <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Dashboard</b>
              </a>
          </div>
          <div class="card-header border-1 primary_color_border bg-white mb-4 p-0 fs-5">
            <form class="row g-3 ms-2 mb-3" action="{{ URL('/patient/labs/search') }}" method="get">
            @csrf
                <div class="col-12 col-sm-6 col-md-8">
                    <div class="d-flex">
                        <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                          <input type="hidden" value="all" name="search_in"> 
                          <input name="search_term" type="text" class="form-control" id="searchquery" placeholder="Search...">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary primary_color border-0 mb-2">Search</button>
                        </div>
                    </div>
                </div> 
            </form>
            <a href="{{ URL('/patient/labs/requests') }}" class="me-3 mb-0 float-end p-1 text-decoration-none text-dark fs-6 ">Requests</a>
            <a href="{{ URL('/patient/labs/find') }}" class="me-1 float-end p-1 ps-3 pe-3  text-decoration-none text-white fs-6 primary_color">Find Labs</a>
            <a href="{{ URL('/patient/labs/index') }}" class="me-1 mb-0 float-end p-1 text-decoration-none text-dark fs-6">My Labs</a>
        </div>

            <div class="card-body">
                  <div class="gap-3 row justify-content-center">
                      @if($labs->isEmpty())
                          <p class="text-center fs-5">There are no results for "{{ $search_term }}"@if($search_in == 'my') in your labs
                            @endif.</p>
                        @else
                        @foreach ($labs as $lab)
                          <div class="p-0 card" style="width: 13rem;">
                              <div class="card-header">
                              <img src="@if($lab->image == NULL) {{ URL('storage/lab.png') }}@else{{ URL("storage/labs/" . $lab->user_id . "/" . $lab->image) }}@endif" class="card-img-top" alt="...">
                              </div>
                              <div class="p-2 card-body text-center">
                              <p class="mb-0 mt-1"><b>{{ $lab->name }}</b></p>
                              <p class="mb-1">{{ $lab->type }}</p>
                              <a href="{{ URL('/patient/labs/profile', $lab->id) }}" class="btn btn-primary primary_color border-0 mt-1 mb-2">
                                View Profile
                              </a>
                              </div>
                          </div>
                        @endforeach
                      @endif
                  </div>

                  
            <div class="d-flex justify-content-center w-100 mb-0  mt-3">
              {{ $labs->appends(Request::all())->links() }}
          </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
