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
                    <a href="{{ URL('/patient/home') }}" class="float-start text-decoration-none text-white fs-6">
                        <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Dashboard</b>
                    </a>
                </div>
                <div class="card-header border-1 mb-4 bg-white ps-3 fs-4">
                    <form class="row g-3" action="{{ URL('/patient/visits/search') }}" method="GET">
                      @csrf
                      <div class="col-12 col-sm-6 col-md-4">
                        <input type="text" class="form-control" id="searchquery" name="search_term" placeholder="Search..." required>
                      </div> 
                      <div class="col-auto">
                        <button type="submit" class="btn btn-primary primary_color border-0 mb-3">Search</button>
                        <a href="{{ URL('/patient/visits/index') }}" class="btn btn-primary primary_color border-0 mb-3" >All Visits</a>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visits as $visit )
                                        <tr>
                                            <td id="{{ $visit->id }}" class="expand_details">+</td>
                                            <td class='clickable-row' data-href='{{ URL('/patient/visits/details', $visit->id) }}'>{{ $visit->doctor_name }}</td>
                                            <td class='clickable-row' data-href='{{ URL('/patient/visits/details', $visit->id) }}'>{{ $visit->specialty }}</td>
                                            <td class='clickable-row' data-href='{{ URL('/patient/visits/details', $visit->id) }}'>{{ $visit->date }}</td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="6" id="detail_{{ $visit->id }}" class="details" style="display: none">
                                                <iframe src='{{ URL('/patient/visits/details/iframe', $visit->id) }}' width="100%" height="750"></iframe>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
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
