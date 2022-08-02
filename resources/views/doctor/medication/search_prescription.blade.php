@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Medication</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-0">
                <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
                    <a href="{{ URL('/doctor/patients/profile', ) }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Profile</b>
                    </a>
                </div>
                <div class="card-header border-1 primary_color_border bg-white mb-4 p-0 fs-5">
                    <form class="row g-3 ms-2" action="{{ URL('/doctor/prescription/search') }}" method="get">
                    @csrf
                        <div class="col-12 col-sm-6 col-md-8">
                            <div class="d-flex">
                                <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                                <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                                    <input name="search_term" type="text" class="form-control" id="searchquery" placeholder="Search...">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary primary_color border-0 mb-2">Search</button>
                                </div>
                            </div>
                            <a href="{{ URL('/doctor/medication/prescriptions/index', $patient_id) }}" class="btn btn-primary primary_color border-0 mb-3" >All Prescriptions</a>
                        </div> 
                    </form>
                    <a href="{{ URL('/doctor/medication/offTheCounter/index', $patient_id) }}" class="me-4 mb-0 float-end p-1 text-decoration-none text-dark fs-6 ">Off The Counter</a>
                    <a href="{{ URL('/doctor/medication/prescriptions/index', $patient_id) }}" class="me-3 float-end p-1 ps-3 pe-3  text-decoration-none text-white fs-6 primary_color">Prescriptions</a>
                </div>
                <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="table-responsive mb-2">
                                <table id="" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Medication</th>
                                            <th scope="col">Instructions</th>
                                            <th scope="col">Start</th>
                                            <th scope="col">End</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $prescriptions as $prescription )
                                        <tr class='clickable-row' data-href=''>
                                        <td>{{ $prescription->medication }}</td>
                                        <td>{{ $prescription->instructions }}</td>
                                        <td>{{ $prescription->start_date }}</td>
                                        <td>{{ $prescription->end_date }}</td>
                                        <td>@if(strtotime($prescription->end_date) < strtotime(date('m/d/Y'))) <span class='text-danger'>Inactive</span> @elseif(strtotime($prescription->end_date) > strtotime(date('m/d/Y'))) <span class='text-success'>Active</span> @endif</td> 
                                        <td>
                                            @if( $prescription->doctor_id != Auth::user()->doctor->id)
                                            <div class="d-flex flex-row justify-content-evenly">
                                                <a href="#" data-bs-toggle="modal">
                                                    <img src="/storage/edit_inactive.png" alt="" width="20px">
                                                </a>
                                            </div>
                                            @elseif($prescription->doctor_id == Auth::user()->doctor->id)
                                            <div class="d-flex flex-row justify-content-evenly">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit{{$prescription->id}}">
                                                    <img src="/storage/edit.png" alt="" width="20px">
                                                </a>
                                            </div>
                                            @endif
                                            @include('doctor.medication.modal.edit')
                                            </td>
                                            <td>
                                                @if( $prescription->doctor_id != Auth::user()->doctor->id)
                                                <div class="d-flex flex-row justify-content-evenly">
                                                    <button
                                                    class="btn btn-light btn-sm">
                                                        <img src="/storage/garbage_inactive.png" alt="" width="20px">
                                                    </button>
                                                </div>
                                                @elseif($prescription->doctor_id == Auth::user()->doctor->id)
                                                <div class="d-flex flex-row justify-content-evenly">
                                                    <button type="submit" data-value="{{ $prescription->id }}" class="btn btn-sm delete" data-bs-toggle="modal" data-bs-target="#deletemodal" >
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
                            
                            <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                                {{ $prescriptions->appends(Request::all())->links() }}
                            </div>
                            <!-- Delete Modal -->

                            <form class="" action="{{url('/doctor/prescription/delete')}}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <input type="hidden" name="prescription_id"  value="" class="form-control" id="del_prescription_id" >
                                <div class="modal" tabindex="-1" id="deletemodal">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title"><b>Delete Prescription</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure you want to delete this prescription ?</p>
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
                                <button type="button" class="btn btn-primary primary_color border-0 me-2" data-bs-toggle="modal" data-bs-target="#add_modal">
                                   Add New
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Prescription</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form  method="POST" action="{{ URL('/doctor/prescription/create') }}">
                                            @csrf
                                            @method("POST")
                                            <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                                            <div class="modal-body">
                                                <div class="pres_form">
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Medication</label>
                                                        <input type="text" class="form-control" list="medications" name="medication" value="">
                                                        <datalist id="medications">
                                                            @foreach ( $medications as $medication )
                                                                <option> {{ $medication->name }}</option>
                                                            @endforeach
                                                          </datalist>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Instructions</label>
                                                        <textarea class="form-control" name="instructions"></textarea>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="duration_num">
                                                        <select class="form-select" name="duration">
                                                            <option value="days">Days</option>
                                                            <option value="weeks">Weeks</option>
                                                            <option value="months">Months</option>
                                                          </select>
                                                    </div>
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
            $('#del_prescription_id').attr('value', $(this).data('value'));
        });   
    });
</script>
@endsection
