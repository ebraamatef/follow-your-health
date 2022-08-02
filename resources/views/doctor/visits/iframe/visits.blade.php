<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'follow your health') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-3">
            <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 p-0">
                        <div class="row justify-content-center">
                            <form class="row g-3 ms-2" action="{{ URL('/doctor/visits/iframe/search') }}" method="get">
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
                                    <a href="{{ URL('/doctor/visit/iframe/visits', $patient_id) }}" class="btn btn-primary primary_color primary_color_border border-0 mb-3">All Visits</a>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
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
                                            <td>{{ $visit->doctor_name }}</td>
                                            <td>{{ $visit->specialty }}</td>
                                            <td>{{ $visit->date }}</td>
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
</body>
</html>
