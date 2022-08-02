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
                                <form class="row g-3" action="{{url('/doctor/visit/iframe/search/tests')}}" method="get" >
                                    <div class="col-10 col-sm-8 col-md-8">
                                        <div class="d-flex">
                                            <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                                                <input name="patient_id" type="hidden" value="{{ $patient_id }}">
                                                <input name="name" type="text" class="form-control" id="searchquery" placeholder="Search...">
                                            </div>
                                            <div class="col-auto">
                                                <button name="search" type="submit" class="btn btn-primary primary_color primary_color_border border-0 mb-3">Search</button>
                                            </div>
                                        </div>
                                        <a href="{{ URL('/doctor/visit/iframe/tests', $patient_id) }}" class="btn btn-primary primary_color primary_color_border border-0 mb-3 me-3" >All Tests</a>
                                    </div> 
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="my-3 row justify-content-center">
                        <div class="col-11 ">
                            <div class="row justify-content-center">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Test</th>
                                                <th scope="col">Lab</th>
                                                <th scope="col">Doctor</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">File</th>
                                                
                                        </thead>
                                        <tbody>
                                            @foreach ($tests as $test)
                                                <tr class='clickable-row' data-href=''>
                                                    <td>{{$test->test}}</td>
                                                    <td>{{$test->lab_name}}</td>
                                                    <td>{{$test->doctor_name}}</td>
                                                    <td>{{$test->date}}</td>
                                                    <td>
                                                        <a href="{{asset('storage/patients/'. $test->patient_id . '/testing/' . $test->file)}}" target="_blank" alt="Photo">
                                                            {{$test->file}}
                                                    </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                                    {{ $tests->appends(Request::all())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
