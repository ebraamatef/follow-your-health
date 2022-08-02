@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-3 shadow">
                <div class="card-header border-1 bg-white ps-3 mb-4 pt-3 fs-4">
                    <b>Medications</b>
                </div>
            <div class="p-0 card-body">
                <div class="my-5 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="mb-2 p-0">
                                <h4><b>Prescribed</b></h4>
                            </div>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Drug</th>
                                        <th scope="col">Strength</th>
                                        <th scope="col">SIG</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Doctor</th>
                                        <th class="text-center"scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class='clickable-row' data-href=''>
                                        <td>Surgery</td>
                                        <td>Some Reason</td>
                                        <td>None</td>
                                        <td>Dr.A</td>
                                        <td>2008</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-evenly">
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/edit.png" alt="" width="20px">
                                                </button>
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/garbage.png" alt="" width="20px">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class='clickable-row' data-href=''> 
                                        <td>Surgery</td>
                                        <td>Some Reason</td>
                                        <td>None</td>
                                        <td>Dr.A</td>
                                        <td>2008</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-evenly">
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/edit.png" alt="" width="20px">
                                                </button>
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/garbage.png" alt="" width="20px">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex flex-row justify-content-end p-0 mb-5">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                   Add
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <div class="mb-2 p-0">
                                <h4><b>Off the counter</b></h4>
                            </div>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Drug</th>
                                        <th scope="col">Strength</th>
                                        <th scope="col">SIG</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Doctor</th>
                                        <th class="text-center"scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class='clickable-row' data-href=''>
                                        <td>Surgery</td>
                                        <td>Some Reason</td>
                                        <td>None</td>
                                        <td>Dr.A</td>
                                        <td>2008</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-evenly">
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/edit.png" alt="" width="20px">
                                                </button>
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/garbage.png" alt="" width="20px">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class='clickable-row' data-href=''> 
                                        <td>Surgery</td>
                                        <td>Some Reason</td>
                                        <td>None</td>
                                        <td>Dr.A</td>
                                        <td>2008</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-evenly">
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/edit.png" alt="" width="20px">
                                                </button>
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/garbage.png" alt="" width="20px">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex flex-row justify-content-end p-0">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                   Add
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
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
</div>
@endsection
