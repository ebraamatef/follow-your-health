@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Visits</b></p>
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
                <div class="card-header border-1 primary_color_border bg-white mb-4 p-0 fs-5">
                    <form class="row g-3 ms-2" action="{{ URL('/doctor/visits/search') }}" method="get">
                    @csrf
                        <div class="col-12 col-sm-6 col-md-8">
                            <div class="d-flex">
                                <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                                <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                                    <input name="search_term" type="text" class="form-control" id="searchquery" placeholder="Search...">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary primary_color primary_color_border border-0 mb-3">Search</button>
                                </div>
                            </div>
                            <a href="{{ URL('/doctor/visits/index', $patient_id) }}" class="btn btn-primary primary_color primary_color_border border-0 mb-3">All Visits</a>
                        </div> 
                    </form>
                </div>
            <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="table-responsive mb-2">
                                <table class="table table-hover table-bordered">
                                <thead>
                                        <tr>
                                            <th scope="col">@</th>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Specialty</th>
                                            <th scope="col">Date</th>
                                            <th class="text-center"scope="col">Edit</th>
                                            <th class="text-center"scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visits as $visit )
                                        <tr>
                                            <td id="{{ $visit->id }}" class="expand_details">+</td>
                                            <td class='clickable-row' data-href='{{ URL('/doctor/visits/details', $visit->id) }}'>{{ $visit->doctor_name }}</td>
                                            <td class='clickable-row' data-href='{{ URL('/doctor/visits/details', $visit->id) }}'>{{ $visit->specialty }}</td>
                                            <td class='clickable-row' data-href='{{ URL('/doctor/visits/details', $visit->id) }}'>{{ $visit->date }}</td>
                                            <td>
                                                @if($visit->doctor_id != Auth::user()->doctor->id)
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <input type="hidden" name="id"  value="{{$visit->id}}" class="form-control" id="" >
                                                        <button type="submit" 
                                                        class="btn btn-light btn-sm">
                                                            <img src="/storage/edit_inactive.png" alt="" width="20px">
                                                        </button>
                                                    </div>
                                                    @elseif($visit->doctor_id == Auth::user()->doctor->id)
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <a href="{{url('/doctor/visits/edit', $visit->id)}}" class="btn btn-light btn-sm">
                                                                <img src="/storage/edit.png" alt="" width="20px">
                                                        </a>
                                                    </div>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if($visit->doctor_id != Auth::user()->doctor->id)
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <button type="submit" 
                                                        class="btn btn-light btn-sm">
                                                            <img src="/storage/garbage_inactive.png" alt="" width="20px">
                                                        </button>
                                                    </div>
                                                    @elseif($visit->doctor_id == Auth::user()->doctor->id)
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <button type="submit" data-value="{{ $visit->id }}" class="btn btn-sm delete" data-bs-toggle="modal" data-bs-target="#deletemodal" >
                                                            <img src="/storage/garbage.png" alt="" width="20px">
                                                        </button>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" id="detail_{{ $visit->id }}" class="details" style="display: none">
                                                <iframe src='{{ URL('/doctor/visits/details/iframe', $visit->id) }}' width="100%" height="750"></iframe>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>

                            <!-- Delete Modal -->

                            <form class="" action="{{url('/doctor/visits/delete')}}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <input type="hidden" name="visit_id"  value="" class="form-control" id="del_visit_id" >
                                <div class="modal" tabindex="-1" id="deletemodal">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title"><b>Delete Visit</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure you want to delete this visit ?</p>
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
                                <a href="{{ URL('doctor/visits/new', $patient_id) }}" class="btn btn-primary primary_color  primary_color_border me-2">Start Visit</a>
                            </div> 
                        </div>
                        
                        <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                            {{ $visits->appends(Request::all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });

    $(document).ready(function() {
        $(".delete").click(function(){
            $('#del_visit_id').attr('value', $(this).data('value'));
        });   
    });
    
    $(document).ready(function() {
        $(".expand_details").click(function(){
            $('.details').hide();
            iframe_id = $(this).attr('id');
            $('#detail_' + iframe_id).show();
            // $('#'. iframe_id).attr('src', "{{ URL('') }}");
        });   
    });
</script>
@endsection
