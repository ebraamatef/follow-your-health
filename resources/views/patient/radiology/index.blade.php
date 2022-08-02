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
                    <a href="{{ URL('/patient/home') }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Dashboard</b>
                    </a>
                </div>
                <div class="card-header border-1 bg-white ps-3 fs-4">
                    <form class="row g-3" action="{{ URL('/patient/radiology/search') }}" method="GET">
                      @csrf
                      <div class="col-12 col-sm-6 col-md-4">
                        <input type="text" class="form-control" id="searchquery" name="name" placeholder="Search..." required>
                      </div> 
                      <div class="col-auto">
                        <button type="submit" class="btn btn-primary primary_color border-0 mb-3">Search</button>
                        <a href="{{ URL('/patient/radiology/index') }}" class="btn btn-primary primary_color border-0 mb-3" >All Radiology</a>
                      </div>
                    </form>
                  </div>
            <div class="p-0 card-body">
                <div class="mt-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="table-responsive mb-2">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Radiology</th>
                                            <th scope="col">Lab</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">File</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                            
                                    </thead>
                                    <tbody>
                                        @foreach ($radiologies as $radiology)
                                            <tr class='clickable-row' data-href=''>
                                                <td>{{$radiology->radiology}}</td>
                                                <td>{{$radiology->lab_name}}</td>
                                                <td>{{$radiology->date}}</td>
                                                <td>
                                                    <a href="{{asset('storage/patients/'. $radiology->patient_id . '/radiology/' . $radiology->file)}}" target="_blank" alt="Photo">
                                                        {{$radiology->file}}
                                                </a>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit{{$radiology->id}}">
                                                            <img src="/storage/edit.png" alt="" width="20px">
                                                        </a>
                                                    </div>
                                                    @include('patient.radiology.modal.edit')
                                                </td>
                                                <td>
                                                        <div class="d-flex flex-row justify-content-evenly">
                                                            <button type="submit" data-value="{{ $radiology->id }}" class="btn btn-sm delete" data-bs-toggle="modal" data-bs-target="#deletemodal" >
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

                            <form class="" action="{{url('/patient/radiology/delete')}}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <input type="hidden" name="radiology_id"  value="" class="form-control" id="del_radiology_id" >
                                <div class="modal" tabindex="-1" id="deletemodal">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title"><b>Delete Radiology</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure you want to delete this Radiology ?</p>
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
                                <button type="button" class="btn btn-primary primary_color primary_color_border me-2 mb-1" data-bs-toggle="modal" data-bs-target="#add_modal">
                                   Add New
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New (Radiology)</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="test" method="POST" action="{{ URL('/patient/radiology/create') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method("POST")
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                  <label for="test_name" class="col-form-label">Radiology</label>
                                                  <input type="text" class="form-control" id="allergy" name="radiology_name">
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
<script>
    $(document).ready(function() {
        $(".delete").click(function(){
            $('#del_radiology_id').attr('value', $(this).data('value'));
    });   
});
</script>
@endsection
