@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-3 shadow">
                <div class="card-header border-1 bg-white ps-3 mb-4 pt-3 fs-4">
                    <b>Tests</b>
                </div>
            <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 p-0">
                        <div class="row justify-content-center">
                            <form class="row g-3" action="{{url('/lab/tests/search')}}">
                                <div class="col-10 col-sm-8 col-md-8">
                                    <div class="d-flex">
                                        <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                                            <input name="search" type="text" class="form-control" id="searchquery" placeholder="Search...">
                                            <input type="hidden" class="form-control" id="allergy" value="{{ $tests[0]->id }}" name="patient_id">

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
                <div class="my-5 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Test</th>
                                        <th scope="col">Lab</th>
                                        <th scope="col">Doctor</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">File</th>
                                        <th class="text-center" scope="col">Edit</th>
                                        <th class="text-center" scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tests as $test)
                                        <tr class='clickable-row' data-href=''>
                                            <td>{{$test->test}}</td>
                                            <td>{{$test->lab_name}}</td>
                                            <td>{{$test->doctor_name}}</td>
                                            <td>{{$test->date}}</td>
                                            <td>
                                                <a href="{{asset('lab/tests/'.$test->file)}}"  target="blank" alt="Photo">
                                                    {{$test->file}}
                                            </a>
                                            </td>
                                            
                                            <td>
                                                <div class="d-flex flex-row justify-content-evenly">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit{{$test->id}}">
                                                        <img src="/storage/edit.png" alt="" width="20px">
                                                    </a>
                                                 </div>
                                                @include('lab.lab_tests.modal.edit')
                                            </td>
                                            <td>
                                                <form class="" action="{{url('/lab/test/delete')}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <input type="hidden" name="id"  value="{{$test->id}}" class="form-control" id="allergy" >
                                                        <button name="search_button_visits_patient" type="submit" 
                                                        class="btn btn-light btn-sm">
                                                            <img src="/storage/garbage.png" alt="" width="20px">
                                                        </button>
                                                    </div>
                                                    
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex flex-row justify-content-end p-0">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                                   Add New
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New (test)</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="test" method="POST" action="{{ URL('/lab/test/create') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method("POST")
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                  <label for="test_name" class="col-form-label">Test</label>
                                                  <input type="text" class="form-control" id="allergy" name="test_name">
                                                </div>
                                                <div class="mb-3">
                                                    
                                                    <input type="hidden" class="form-control" id="allergy" value="{{$id}}" name="patient_id">
                                                  </div>
                                                <div class="mb-3">
                                                  <label for="recipient-name" class="col-form-label">lab</label>
                                                  <input type="text" class="form-control" id="lab" name="lab_name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Doctor</label>
                                                    <input type="text" class="form-control" id="doctor" name="doctor_name">
                                                  
                                                </div>
                                                <div class="mb-3">
                                                  <label for="message-text" class="col-form-label">Date</label>
                                                  <input type="date" class="form-control" id="doctor" name="date">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">File</label>
                                                    <input type="file" class="form-control" id="doctor" name="file_t" required>
                                                  </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
