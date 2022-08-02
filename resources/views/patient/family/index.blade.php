@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Family History</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-0">
                <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
                    <a href="{{ URL('/patient/home') }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Dashboard</b>
                    </a>
                </div>
            <div class="p-0 card-body">
                <div class="mt-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="table-responsive mb-2">
                                <table id="" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Family Member</th>
                                            <th scope="col">Significant Problem</th>
                                            <th class="text-center" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($families as $family)
                                            <tr class='clickable-row' data-href=''>
                                                <td>{{ $family->member }}</td>
                                                <td>{{ $family->problem }}</td>
                                                <td>
                                                    
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <button type="submit" data-value="{{ $family->id }}" class="btn btn-sm delete" data-bs-toggle="modal" data-bs-target="#deletemodal" >
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

                            <form class="" action="{{url('/patient/family/delete')}}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <input type="hidden" name="problem_id"  value="" class="form-control" id="del_problem_id" >
                                <div class="modal" tabindex="-1" id="deletemodal">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title"><b>Delete Record</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure you want to delete this Record ?</p>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="" method="POST" action="{{ URL('/patient/family/create') }}">
                                            @csrf
                                            @method("POST")
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                  <label class="col-form-label">Significant Problem</label>
                                                  <input type="text" class="form-control"  name="problem">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Family Member</label>
                                                    <select class="form-select" name="member" required="required">
                                                      <option value="">Select Family Member</option>
                                                      <option value="Father">Father</option>
                                                      <option value="Mother">Mother</option>
                                                      <option value="Grandfather">Grandfather</option>
                                                      <option value="Grandmother">Grandmother</option>
                                                      <option value="Son">Son</option>
                                                      <option value="Daughter">Daughter</option>
                                                      <option value="Brother">Brother</option>
                                                      <option value="Sister">Sister</option>
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

                            <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                                {{ $families->links() }}
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
            $('#del_problem_id').attr('value', $(this).data('value'));
        });   
    });
    </script>
@endsection
