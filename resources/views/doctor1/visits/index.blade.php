@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-3 shadow">
                <div class="card-header border-1 bg-white ps-3 mb-4 pt-3 fs-4">
                    <div class="d-flex justify-content-between">
                        <h3>Visits</h3>
                    </div>
                </div>
            <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 p-0">
                        <div class="row justify-content-center">
                            <form class="row g-3">
                                <div class="col-8 col-sm-6 col-md-8">
                                    <div class="d-flex">
                                        <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                                            <input name="search_field_visits_patient" type="text" class="form-control" id="searchquery" placeholder="Search...">
                                        </div>
                                        <div class="col-auto">
                                            <button name="search_button_visits_patient" type="submit" class="btn btn-primary mb-3">Search</button>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <table class="table table-hover table-bordered">
                            <thead>
                                    <tr>
                                        <th scope="col">Doctor</th>
                                        <th scope="col">Specialty</th>
                                        <th scope="col">Date</th>
                                        <th class="text-center"scope="col">Edit</th>
                                        <th class="text-center"scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visits as $visit )
                                    <tr class='clickable-row' data-href=''>
                                        <td>{{ $visit->doctor_name }}</td>
                                        <td>{{ $visit->specialty }}</td>
                                        <td>{{ $visit->date }}</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-evenly">
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/edit.png" alt="" width="20px">
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            @if($visit->doctor_id != Auth::user()->doctor->id)
                                                <div class="d-flex flex-row justify-content-evenly">
                                                    <input type="hidden" name="id"  value="{{$visit->id}}" class="form-control" id="" >
                                                    <button type="submit" 
                                                    class="btn btn-light btn-sm">
                                                        <img src="/storage/garbage_inactive.png" alt="" width="20px">
                                                    </button>
                                                </div>
                                                @elseif($visit->doctor_id == Auth::user()->doctor->id)
                                                <form class="" action="{{url('/doctor/visits/delete')}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <input type="hidden" name="id"  value="{{$visit->id}}" class="form-control" >
                                                        <button name="" type="submit" 
                                                        class="btn btn-light btn-sm">
                                                            <img src="/storage/garbage.png" alt="" width="20px">
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="d-flex flex-row justify-content-end p-0">
                                <form action="{{ URL('doctor/visits/new') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                                    <button type="submit" class="btn btn-primary">
                                    Start Visit
                                    </button>
                                </form> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
