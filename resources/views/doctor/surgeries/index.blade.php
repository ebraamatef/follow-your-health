@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Surgeries</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-0">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-0">
            <div class="p-0 card-body">
                <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
                    <a href="{{ URL('/doctor/patients/profile', $patient_id) }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Profile</b>
                    </a>
                </div>
                <div class="mt-2 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="table-responsive mb-2">
                                <table id="surgeries_table" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Surgery</th>
                                            <th scope="col">Reason</th>
                                            <th scope="col">Foreign Objects</th>
                                            <th scope="col">Doctor/Hospital</th>
                                            <th scope="col">Year</th>
                                            <th class="text-center" scope="col">Edit</th>
                                            <th class="text-center" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($surgeries as $surgery)
                                            <tr class='clickable-row' data-href=''>
                                                <td>{{ $surgery->surgery }}</td>
                                                <td>{{ $surgery->reason }}</td>
                                                <td>{{ $surgery->foreign_object }}</td>
                                                <td>{{ $surgery->doctor }}</td>
                                                <td>{{ $surgery->year }}</td>
                                                <td>
                                                    @if($surgery->added_by != Auth::user()->id)
                                                        <div class="d-flex flex-row justify-content-evenly">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="">
                                                                <img src="/storage/edit_inactive.png" alt="" width="20px">
                                                            </a>
                                                        </div>
                                                    @elseif($surgery->added_by == Auth::user()->id)
                                                        <div class="d-flex flex-row justify-content-evenly">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $surgery->id }}">
                                                                <img src="/storage/edit.png" alt="" width="20px">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @include('doctor.surgeries.modal.edit')
                                                </td>
                                                <td>
                                                    @if($surgery->added_by != Auth::user()->id)
                                                        <div class="d-flex flex-row justify-content-evenly">
                                                            <input type="hidden" name="id"  value="{{$surgery->id}}" class="form-control" id="surgery" >
                                                            <button type="submit" 
                                                            class="btn btn-light btn-sm">
                                                                <img src="/storage/garbage_inactive.png" alt="" width="20px">
                                                            </button>
                                                        </div>
                                                        @elseif($surgery->added_by == Auth::user()->id)
                                                        <div class="d-flex flex-row justify-content-evenly">
                                                            <button type="submit" data-value="{{ $surgery->id }}" class="btn btn-sm delete" data-bs-toggle="modal" data-bs-target="#deletemodal" >
                                                                <img src="/storage/garbage.png" alt="" width="20px">
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>  
                            <!-- Delete Modal -->

                            <form class="" action="{{url('/doctor/surgeries/delete')}}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <input type="hidden" name="surgery_id"  value="" class="form-control" id="del_surgery_id" >
                                <div class="modal" tabindex="-1" id="deletemodal">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title"><b>Delete Surgery</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure you want to delete this surgery ?</p>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Add New (Surgery)</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="surgery_add" method="POST" action="{{ URL('/doctor/surgeries/create') }}">
                                            @csrf
                                            @method("POST")
                                            <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Surgery</label>
                                                  <input type="text" class="form-control" id="surgery" name="surgery_name">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Reason</label>
                                                  <input type="text" class="form-control" id="surgery" name="reason">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Foreing Object</label>
                                                  <input type="text" class="form-control" id="surgery" name="foreign_object">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Doctor/Hospital</label>
                                                  <input type="text" class="form-control" id="surgery" name="doctor">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Year</label>
                                                  <input type="date" class="form-control" id="surgery" name="year">
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
<script>
    $(document).ready(function() {
        $(".delete").click(function(){
            $('#del_surgery_id').attr('value', $(this).data('value'));
        });   
    });
</script>
@endsection
