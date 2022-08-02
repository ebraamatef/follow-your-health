@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Readings</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-0">
                <div class="card-header border-1 primary_color fs-4 mb-4 d-flex align-items-center border-0 rounded-0">
                    <a href="{{ URL('/patient/home') }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Dashboard</b>
                    </a>
                </div>
                <div class="card-header border-1 primary_color_border bg-white mb-2 p-0 fs-5">
                    <a href="{{ URL('/patient/readings/bs/index') }}" class=" me-3 float-end p-1 ps-3 pe-3  text-decoration-none text-white fs-6 primary_color">Blood Sugar</a>
                    <a href="{{ URL('/patient/readings') }}" class="me-4 mb-0 float-end p-1 text-decoration-none text-dark fs-6 ">Blood Pressure</a>
                </div>
            <div class="p-0 card-body">
                <div class="mt-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="table-responsive mb-2">
                                <table id="" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Reading</th>
                                            <th class="text-center" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($readings as $reading)
                                            <tr class='clickable-row' data-href=''>
                                                <td>{{ $reading->date }}</td>
                                                <td>{{ $reading->time }}</td>
                                                <td>{{ $reading->reading }} {{ $reading->unit }}</td>
                                                <td>
                                                    
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <button type="submit" data-value="{{ $reading->id }}" class="btn btn-sm delete" data-bs-toggle="modal" data-bs-target="#deletemodal" >
                                                            <img src="/storage/garbage.png" alt="" width="20px">
                                                        </button>
                                                    </div>
                                                
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- Delete Modal -->

                            <form class="" action="{{url('/patient/readings/bs/delete')}}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <input type="hidden" name="reading_id"  value="" class="form-control" id="del_reading_id" >
                                <div class="modal" tabindex="-1" id="deletemodal">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title"><b>Delete Reading</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure you want to delete this Reading ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </form>

                            <!-- --------------------------------------------------------- -->

                            <div class="d-flex flex-row justify-content-end p-0">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary primary_color  primary_color_border me-2" data-bs-toggle="modal" data-bs-target="#add_modal">
                                   Add New
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Reading</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="" method="POST" action="{{ URL('/patient/readings/bs/create') }}">
                                            @csrf
                                            @method("POST")
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Date</label>
                                                        <input type="date" class="form-control" id="doctor" name="date">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Time</label>
                                                        <input type="time" class="form-control" id="doctor" name="time">
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="reading"> 
                                                    <select class="form-control" id="inputPassword2" name="unit">
                                                        <option value="mmol/L">mmol/L</option>
                                                        <option value="mg/L">mg/dL</option>
                                                    </select>
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
                        
                        <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                            {{ $readings->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".delete").click(function(){
            $('#del_reading_id').attr('value', $(this).data('value'));
        });   
    });
    </script>
@endsection
