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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-4 mb-5 card border-0 rounded-3">

                <div class="card-body">
                    <div class="mb-4 row justify-content-center">
                      <div class="col-11 col-sm-10 col-md-8">
                        <div class="row">
                          <div class="col">
                            <p class="m-0"><b class="fs-6">Patient :</b> {{ $visit[0]['patient']['name'] }}</p>
                            <p class="m-0"><b class="fs-6">Doctor :</b> {{ $visit[0]['doctor_name'] }}</p>
                            <p class="m-0"><b class="fs-6">Specialty :</b> {{ $visit[0]['specialty'] }}</p>
                          </div>
                          <div class="col">
                            <div class="float-end">
                              @php $date = date("d/m/Y")@endphp
                              <p class="m-0"><b class="fs-6">Date :</b> {{ $visit[0]['date'] }}</p>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mb-4 row justify-content-center">
                      <div class="col-11 col-sm-10 col-md-8">
                        <b class="fs-5">Patient complaints</b>
                        <div class="p-2 w-100 border rounded-3 border-dark-50" style="min-height: 150px; height:auto; margin: 10px 0px 25px 0px;">
                          <p>{{ $visit[0]['patient_complaint'] }}</p>
                        </div>
                            
                        <b class="fs-5">Visit Report</b>
                        <div class="p-2 w-100 border rounded-3 border-dark-50" style="min-height: 150px; height:auto; margin: 10px 0px 25px 0px;">
                          <p>{{ $visit[0]['visit_report'] }}</p>
                        </div>
 
                        <b class="fs-5">Action</b>
                        <div class="p-2 w-100 border rounded-3 border-dark-50" style="min-height: 150px; height:auto; margin: 10px 0px 25px 0px;">
                          <p>{{ $visit[0]['treatment_action'] }}</p>
                        </div>
                        <b class="fs-5 mb-5">Prescription</b>
                        <table id="" class="table table-hover table-bordered">
                          <thead>
                              <tr>
                                  <th scope="col">Medication</th>
                                  <th scope="col">Instructions</th>
                                  <th scope="col">Start</th>
                                  <th scope="col">End</th>
                                  <th scope="col">Status</th>
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
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
