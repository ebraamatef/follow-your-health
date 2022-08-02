@extends('layouts.app')
      @section('content')
      <!--Main Navigation-->
  <header>
    <style>
      #intro {
        height: 100vh;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>
    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container d-flex align-items-center justify-content-center text-center h-100">
          <div class="text-white">
            <img class="mb-3" src="{{ URL('storage/FYHW-logo.png') }}" height="150" alt="FollowYourHealth">
            <h1 class="mb-3"><b>Follow Your Health.</b></h1>
            <a class="btn btn-primary btn-lg m-2" href="{{ URL('login') }}" role="button"
              rel="nofollow">Sign In</a>
            <a class="btn btn-primary btn-lg m-2" href="{{ URL('register') }}"
              role="button">Sign Up</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">
      <!--Section: Content-->
      <section>
        <div class="row">
          <div class="col-md-6 gx-5 mb-4">
            <div class="hover-overlay ripple shadow-2-strong rounded-5" data-mdb-ripple-color="light">
              <img src="{{ URL('/storage/doctors2.jpg') }}" class="img-fluid" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a>
            </div>
          </div>

          <div class="col-md-6 gx-5 mb-4">
            <h4><strong>Coved 19</strong></h4>
            <p class="text-muted">
            Clean your hands before, and after putting on the mask.
              Hold your nose, mouth and chin.
              When you remove the mask, store it in a clean plastic bag, and make sure to wash it daily if it is a cloth mask, or dispose of it in the waste bin.</h3>
              Do not use masks with valves.
              Clean your hands before, and after putting on the mask.
              Hold your nose, mouth and chin.
              When you remove the mask, store it in a clean plastic bag, and make sure to wash it daily if it is a cloth mask, or dispose of it in the waste bin.</h3>
              Do not use masks with valves.
            </p>            
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">

    <hr class="m-0" />
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    Follow Your Health
    <br>
    <a href="...">Contact Us</a>
    </div>
  </footer>
  <!--Footer-->
  @endsection
