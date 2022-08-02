@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Allergies</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-0">
                <div class="card-header border-1 primary_color fs-4 d-flex align-items-center border-0 rounded-0">
                    <a href="{{ URL('/patient/home') }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Dashboard</b>
                    </a>
                </div>
            <div class="p-0 card-body">
                <div class="mt-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="table-responsive mb-2">
                                <table id="allergies_table" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Allergy</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Notes</th>
                                            <th class="text-center" scope="col">Edit</th>
                                            <th class="text-center" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allergies as $allergy)
                                            <tr class='clickable-row' data-href=''>
                                                <td>{{ $allergy->allergy }}</td>
                                                <td>{{ $allergy->type }}</td>
                                                <td>{{ $allergy->status }}</td>
                                                <td>{{ $allergy->doctor }}</td>
                                                <td>{{ $allergy->notes }}</td>
                                                <td>
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $allergy->id }}">
                                                            <img src="/storage/edit.png" alt="" width="20px">
                                                        </a>
                                                    </div>
                                                    @include('patient.allergies.modal.edit')
                                                </td>
                                                <td>
                                                    
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <button type="submit" data-value="{{ $allergy->id }}" class="btn btn-sm delete" data-bs-toggle="modal" data-bs-target="#deletemodal" >
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

                            <form class="" action="{{url('/patient/allergies/delete')}}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <input type="hidden" name="id"  value="" class="form-control" id="del_allergy_id" >
                                <div class="modal" tabindex="-1" id="deletemodal">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title"><b>Delete Allergy</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure you want to delete this Allergy ?</p>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Add New (Allergy)</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="allergy_add" method="POST" action="{{ URL('/patient/allergies/create') }}">
                                            @csrf
                                            @method("POST")
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                  <label for="allergy_name" class="col-form-label">Allergy</label>
                                                  <input type="text" class="form-control" id="allergy" name="allergy_name">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="recipient-name" class="col-form-label">Type</label>
                                                  <select class="form-select" aria-label="Default select example" name="type">
                                                    <option selected>Select Allergy Type</option>
                                                    <option value="food">Food</option>
                                                    <option value="drug">Drug</option>
                                                    <option value="pollen">Pollen</option>
                                                    <option value="pet">Pet</option>
                                                    <option value="other">Other</option>
                                                  </select>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="recipient-name" class="col-form-label">Status</label>
                                                  <select class="form-select" aria-label="Default select example" name="status">
                                                    <option selected>Select Allergy Status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                  </select>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="message-text" class="col-form-label">Notes/Reaction:</label>
                                                  <textarea class="form-control" id="message-text" name="notes"></textarea>
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
                            
                            <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                                {{ $allergies->links() }}
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
            $('#del_allergy_id').attr('value', $(this).data('value'));
        });   
    });
    </script>
@endsection
