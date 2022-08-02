@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-3 shadow">
                <div class="card-header border-1 bg-white ps-3 mb-4 pt-3 fs-4">
                    <b>Surgeries</b>
                </div>
            <div class="p-0 card-body">
                <!-- <div class="mb-4 row justify-content-center">
                    <div class="col-11 p-0">
                        <div class="row justify-content-center">
                            <form class="row g-3">
                                <div class="col-8 col-sm-6 col-md-8">
                                    <div class="d-flex">
                                        <div class="col-5 col-sm-5 col-md-3 col-lg-2 me-3">
                                            <select name="select_menu_visits_patient" class="form-select" aria-label="Default select example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                                            <input name="search_field_visits_patient" type="text" class="form-control" id="searchquery" placeholder="Search...">
                                        </div>
                                        <div class="col-auto">
                                            <button name="search_button_visits_patient" type="submit" class="btn btn-primary mb-3">Search</button>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="my-5 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <table id="surgeries_table" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Surgery</th>
                                        <th scope="col">Reason</th>
                                        <th scope="col">Foreign Objects</th>
                                        <th scope="col">Doctor/Hospital</th>
                                        <th scope="col">Year</th>
                                        <th class="text-center" scope="col">Edit</th>
                                        <th class="text-center" scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surgeries as $surgery)
                                        <tr class='clickable-row' data-href=''>
                                            <td>{{ $surgery->surgery }}</td>
                                            <td>{{ $surgery->reason }}</td>
                                            <td>{{ $surgery->foregin_object }}</td>
                                            <td>{{ $surgery->doctor }}</td>
                                            <td>{{ $surgery->year }}</td>
                                            <td>
                                                <div class="d-flex flex-row justify-content-evenly">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $surgery->id }}">
                                                        <img src="/storage/edit.png" alt="" width="20px">
                                                    </a>
                                                 </div>
                                                @include('patient.surgeries.modal.edit')
                                            </td>
                                            <td>
                                                <form class="" action="{{url('/patient/surgeries/delete')}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <input type="hidden" name="id"  value="{{$surgery->id}}" class="form-control" id="surgery" >
                                                        <button name="search_button_visits_patient" type="submit" 
                                                        class="btn btn-light btn-sm">
                                                            <img src="/storage/garbage.png" alt="" width="20px">
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="d-flex flex-row justify-content-end p-0">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                                   Add New
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New (Surgery)</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="surgery_add" method="POST" action="{{ URL('/patient/surgeries/create') }}">
                                            @csrf
                                            @method("POST")
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Surgery</label>
                                                  <input type="text" class="form-control" id="surgery" name="surgery_name">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Reason</label>
                                                  <input type="text" class="form-control" id="surgery" name="reason">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Foreing Object</label>
                                                  <input type="text" class="form-control" id="surgery" name="foreign_object">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Doctor/Hospital</label>
                                                  <input type="text" class="form-control" id="surgery" name="doctor">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="surgery_name" class="col-form-label">Year</label>
                                                  <input type="date" class="form-control" id="surgery" name="year">
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </div>
                                        </form>
                                        </div>
                                    </div>
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
