@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="pb-3 p-0 card border-0 rounded-3 shadow">
                <div class="card-header border-1 bg-white ps-3 mb-4 pt-3 fs-4">
                    <b>Allergies</b>
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
                            <table id="allergies_table" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Allergy</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Doctor</th>
                                        <th scope="col">Notes</th>
                                        <th class="text-center" scope="col">Edit</th>
                                        <th class="text-center" scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allergies as $allergy)
                                        <tr class='clickable-row' data-href=''>
                                            <td>{{ $allergy->allergy }}</td>
                                            <td>{{ $allergy->type }}</td>
                                            <td>{{ $allergy->status }}</td>
                                            <td>{{ $allergy->doctor }}</td>
                                            <td>{{ $allergy->notes }}</td>
                                            <td>
                                                <div class="d-flex flex-row justify-content-evenly">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $allergy->id }}">
                                                        <img src="/storage/edit.png" alt="" width="20px">
                                                    </a>
                                                 </div>
                                                @include('patient.allergies.modal.edit')
                                            </td>
                                            <td>
                                                <form class="" action="{{url('/patient/allergies/delete')}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <input type="hidden" name="id"  value="{{$allergy->id}}" class="form-control" id="allergy" >
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
                                            <h5 class="modal-title" id="exampleModalLabel">Add New (Allergy)</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="allergy_add" method="POST" action="{{ URL('/patient/allergies/create') }}">
                                            @csrf
                                            @method("POST")
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                  <label for="allergy_name" class="col-form-label">Allergy</label>
                                                  <input type="text" class="form-control" id="allergy" name="allergy_name">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="recipient-name" class="col-form-label">Type</label>
                                                  <select class="form-select" aria-label="Default select example" name="type">
                                                    <option selected>Select Allergy Type</option>
                                                    <option value="food">Food</option>
                                                    <option value="drug">Drug</option>
                                                    <option value="pollen">Pollen</option>
                                                    <option value="pet">Pet</option>
                                                    <option value="other">Other</option>
                                                  </select>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="recipient-name" class="col-form-label">Status</label>
                                                  <select class="form-select" aria-label="Default select example" name="status">
                                                    <option selected>Select Allergy Status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                  </select>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="message-text" class="col-form-label">Notes/Reaction:</label>
                                                  <textarea class="form-control" id="message-text" name="notes"></textarea>
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
<script>
    $(document).ready(function(){
        $("#test").click(function(){
            $("#test").hide();
        });
    });
</script>
<script>
    $("#allergy_add").submit(function(e){
        e.preventdefault();
        let allergy = $("#allergy").val();
        let type = $("#type").val();
        let status = $("#status").val();
        let notes = $("#notes").val();
        let _token = $("inpute[name=_token]").val();

        $.ajax({
            url : "{{ route('patient.create.allergies') }}",
            type : "POST",
            data : {
                allergy:allergy,
                type:type,
                status:status,
                notes:notes
            },
            success:function(response)
            {
                if(response){
                    $("#allergies_table tbody").prepend('<tr><td>'+ response->allergy +'</td><td>'+ response->type +'</td><td>'+ response->status +'</td><td>'+ response->notes +'</td><td>'+ - +'</td></tr>');
                    $("#allergy_add")[0].reset();
                    $("#add_modal").modal('hide');
                }
            }
        });
    })
</script>
@endsection
