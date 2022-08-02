<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'follow your health') }}</title>
    <link rel="icon" type="image/x-icon" href="storage/FYHC-logo.png">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="" style="background: #EFEFEF">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm sticky-top " style="background-color: #2EAAE7;">
            <div class="container">
                <div class="row">
                    <div class="d-flex ">
                        @auth
                        @if(Auth::user()->type == 'patient')
                            <div class=" col-2 me-3  d-flex justify-content-center ">
                                <button class="btn p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                                    <img src="{{ URL('/storage/menu.png') }}" height="30">
                                </button> 
                            </div>
                        @endif
                        @endauth
                        <div class=" col-10 mt-1 ">
                                <a class="navbar-brand" href="{{ url('/check') }}">
                                    <img class="me-2" src="{{ URL('storage/FYHW-logo.png') }}" height="40" alt="FollowYourHealth">
                                    <b><span class="md-visually-hidden logo_text">Follow Your Health</span></b>
                                </a>
                        </div>
                    </div>
                </div>
                
                    
                <div class="">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        <div class="d-flex flex-row">
                            @if (Route::has('login'))
                                <li class="nav-item me-4">
                                    <a class="nav-link" href="{{ route('login') }}"><span class="nav_text">{{ __('Login') }}</span></a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><span class="nav_text">{{ __('Register') }}</span></a>
                                </li>
                            @endif
                        </div>
                        @else
                        <div class="dropdown ">
                            <a class="btn position-relative" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger">
                                    9+
                                </span>
                                <img src="{{ URL('storage/bell.png') }}" alt="" height="22">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end position-absolute shadow overflow-scroll"  style="height: auto; max-height: 500px; width: 350px" aria-labelledby="dropdownMenuLink">
                                <livewire:counter/>
                            </ul>
                        </div>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <span class="text-light me-1">{{ Auth::user()->name }}</span>
                                        <img class="" style="width: 30px; height: 30px;" src="@if(Auth::user()->type == 'patient')
                                                                                                    @if(Auth::user()->patient->image == NULL)
                                                                                                    {{ URL('storage/patient.png') }}
                                                                                                    @else
                                                                                                    {{ URL('storage/patients/' . Auth::user()->patient->id . '/' . Auth::user()->patient->image )}}
                                                                                                    @endif
                                                                                                @elseif (Auth::user()->type == 'doctor')
                                                                                                    @if(Auth::user()->doctor->image == NULL)
                                                                                                    {{ URL('storage/doctor.png') }}
                                                                                                    @else
                                                                                                    {{ URL('storage/doctors/' . Auth::user()->doctor->id . '/' . Auth::user()->doctor->image )}}
                                                                                                    @endif
                                                                                                @elseif (Auth::user()->type == 'lab')
                                                                                                    @if(Auth::user()->lab->image == NULL)
                                                                                                    {{ URL('storage/lab.png') }}
                                                                                                    @else
                                                                                                    {{ URL('storage/labs/' . Auth::user()->lab->id . '/' . Auth::user()->lab->image )}}
                                                                                                    @endif
                                                                                                @endif
                                                                                                " alt="">
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-lg-end position-absolute" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="@if(Auth::user()->type == 'patient')
                                            {{ URL('/patient/profile/edit') }}
                                            @elseif (Auth::user()->type == 'doctor')
                                            {{ URL('/doctor/profile/edit') }}
                                            @elseif (Auth::user()->type == 'lab')
                                            {{ URL('/lab/profile/edit') }}
                                            @endif">My Profile 
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="">
                <div class="offcanvas offcanvas-start" style="background-color: #ffffff;" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header justify-content-between">
                        <img src="{{ URL('/storage/FYHC-logo.png') }}" height="50">
                        <b><span class="text-dark fs-4">Follow Your Health</span></b>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="nav flex-column ps-5">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/visits/index') }}"><span class="text-dark fs-5">Visits</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/doctors/index') }}"><span class="text-dark fs-5">Doctors</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/labs/index') }}"><span class="text-dark fs-5">Labs</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="{{ URL('/patient/medication/prescriptions/index') }}"><span class="text-dark fs-5">Medication</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/allergies/index') }}"><span class="text-dark fs-5">Allergies</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/surgeries/index') }}"><span class="text-dark fs-5">Surgeries</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/tests/index') }}"><span class="text-dark fs-5">Tests</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/radiology/index') }}"><span class="text-dark fs-5">Radiology</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/conditions/index') }}"><span class="text-dark fs-5">Medical Conditions</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="{{ URL('/patient/family/index') }}"><span class="text-dark fs-5">Family History</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/readings') }}"><span class="text-dark fs-5">BP / BS Readings</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/medical-profile') }}"><span class="text-dark fs-5">Medical Profile</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ URL('/patient/profile/edit') }}"><span class="text-dark fs-5">My Profile</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        
        
        <main class="">
        @auth
        @endauth
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>
</html>
