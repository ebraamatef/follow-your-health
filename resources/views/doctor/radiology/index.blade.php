@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Radiology</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-0">
                <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
                    <a href="{{ URL('/doctor/patients/profile', $patient_id) }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Profile</b>
                    </a>
                </div>
                <div class="card-header border-1 bg-white ps-3 fs-4">
                  <form class="row g-3" action="{{ URL('/doctor/radiology/search') }}" method="GET">
                    @csrf
                    <input type="hidden" value="{{ $patient_id }}" name="patient_id">  
                    <div class="col-12 col-sm-6 col-md-4">
                      <input type="text" class="form-control" id="searchquery" name="name" placeholder="Search..." required>
                    </div> 
                    <div class="col-auto">
                      <button type="submit" class="btn btn-primary primary_color border-0 mb-3">Search</button>
                    </div>
                  </form>
                </div>
            <div class="p-0 card-body">
                <div class="my-5 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="table-responsive mb-2">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">radiology</th>
                                            <th scope="col">Lab</th>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">File</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($radiologies as $radiology)
                                            <tr class='clickable-row' data-href=''>
                                                <td>{{$radiology->radiology}}</td>
                                                <td>{{$radiology->lab_name}}</td>
                                                <td>{{$radiology->doctor_name}}</td>
                                                <td>{{$radiology->date}}</td>
                                                <td>
                                                    <a href="{{asset('storage/patients/'. $radiology->patient_id . '/radiology/' . $radiology->file)}}" alt="Photo">
                                                        {{$radiology->file}}
                                                </a>
                                                </td>
                                                
                                            
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                                {{ $radiologies->appends(Request::all())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
