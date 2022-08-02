@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Lab Profile</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-12">
        <div class="mb-5 pb-3 p-0 card border-0 rounded-0">
            <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
            </div>
            <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="mb-4 col-8 col-md-3">
                                <img class="w-100" src="@if($lab[0]->image == NULL) {{ URL('storage/lab.png') }}@else{{ URL("storage/labs/" . $lab[0]->user_id . "/" . $lab[0]->image) }}@endif">@if(in_array($lab[0]->id, $myLabs))
                                <div class="btn btn-danger float-start mt-2" data-bs-toggle="modal" data-bs-target="#deletemodal">Remove Lab</div>
                                <a href="{{ URL('/patient/labs/chat', $lab[0]->id) }}" class="btn btn-primary primary_color primary_color_border float-end mt-2">Chat</a>
                                <form class="" action="{{url('/patient/labs/remove')}}" method="POST">
                                    @csrf
                                    @method('DELETE')   
                                    <input type="hidden" name="patient_id"  value="{{ $lab[0]->id }}" class="form-control" >
                                    <div class="modal" tabindex="-1" id="deletemodal">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title"><b>Remoce Lab</b></h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <p>Are you sure you want to remove {{ $lab[0]->name }} ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </form>
                                @endif
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="">
                                    <h4><b>Contact info.</b></h4>
                                </div>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $lab[0]->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Type</b></td>
                                            <td>{{ $lab[0]->type }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>E-mail</b></td>
                                            <td>{{ $lab[0]->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone Number</b></td>
                                            <td>{{ $lab[0]->phone }}</td>
                                            
                                        </tr>
                                        <tr>
                                            <td><b>Alt. Phone Number</b></td>
                                            <td>{{ $lab[0]->alt_phone }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td><b>Clinic Address</b></td>
                                            <td>{{ $lab[0]->address }}</td>
                                        </tr>
                                    </tbody> 
                                </table>   
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
