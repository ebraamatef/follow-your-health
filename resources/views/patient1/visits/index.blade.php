@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-3 shadow">
                <div class="card-header border-1 bg-white ps-3 mb-4 pt-3 fs-4">
                    <div class="d-flex justify-content-between">
                        <h3>Visits</h3>
                    </div>
                </div>
            <div class="p-0 card-body">
                <div class="mb-4 row justify-content-center">
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
                </div>
                <div class="mb-4 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            <table class="table table-hover table-bordered">
                            <thead>
                                    <tr>
                                        <th scope="col">Visit No.</th>
                                        <th scope="col">Doctor</th>
                                        <th scope="col">Date</th>
                                        <th class="text-center"scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class='clickable-row' data-href=''>
                                        <td>Amarel</td>
                                        <td>2ml</td>
                                        <td>4/3/2012</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-evenly">
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/garbage.png" alt="" width="20px">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class='clickable-row' data-href=''> 
                                        <td>Concor</td>
                                        <td>5ml</td>
                                        <td>4/3/2012</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-evenly">
                                                <button name="search_button_visits_patient" type="submit" class="btn btn-light btn-sm">
                                                    <img src="/storage/garbage.png" alt="" width="20px">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
