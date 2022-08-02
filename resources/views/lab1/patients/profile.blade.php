@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="mb-5 pb-3 p-0 card border-0 rounded-3 shadow">
          <div class="card-header border-1 bg-white ps-3 mb-4 pt-3 fs-4">
            <b>Patient Profile</b>
          </div>
            <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="mb-4 col-8 col-md-3">
                                <img class="w-100" src="{{ URL('storage/patient.png') }}">
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="my-4">
                                    <h4><b>Contact info.</b></h4>
                                </div>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $patient[0]->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>E-mail</b></td>
                                            <td>{{ $patient[0]->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone Number</b></td>
                                            <td>{{ $patient[0]->phone }}</td>
                                            
                                        </tr>
                                        <tr>
                                            <td><b>Alt. Phone Number</b></td>
                                            <td>{{ $patient[0]->alt_phone }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{ $patient[0]->address }}</td>
                                        </tr>
                                    </tbody> 
                                </table>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 d-flex flex-row flex-wrap justify-content-center align-items-center container-fluid" style="gap: 100px">
                    <a class="text-decoration-none border-0 text-dark" href="{{ route('lab.index.tests',  $patient[0]->id) }}">
                        <div class="card border-0" style="width: 8rem;">
                            <img id="tests" src="{{ URL('storage/microscope.png') }}" class="card-img-top" alt="...">
                            <h5 class="card-title  text-center p-3">Tests</h5>
                        </div>
                    </a>
                    <a class="text-decoration-none border-0 text-dark" href="{{ URL('/lab/radiology/index/'.$patient[0]->id) }}">
                        <div class="card border-0" style="width: 8rem;">
                            <img id="radiology" src="{{ URL('storage/x-ray.png') }}" class="card-img-top" alt="...">
                            <h5 class="card-title  text-center p-3">Radiology</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
