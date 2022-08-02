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
                    <div class="my-3 row justify-content-center">
                        <div class="col-11 ">
                            <div class="row justify-content-center">
                                <div class="table-responsive">
                                    <table id="" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Condition</th>
                                                <th scope="col">Doctor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($conditions as $condition)
                                                <tr class='clickable-row' data-href=''>
                                                    <td>{{ $condition->condition }}</td>
                                                    <td>{{ $condition->condition }}</td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                                    {{ $conditions->appends(Request::all())->links() }}
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
