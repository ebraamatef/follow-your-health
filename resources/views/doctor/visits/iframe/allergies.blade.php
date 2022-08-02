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
                                                    @if($allergy->added_by != Auth::user()->id)
                                                        <div class="d-flex flex-row justify-content-evenly">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="">
                                                                <img src="/storage/edit_inactive.png" alt="" width="20px">
                                                            </a>
                                                        </div>
                                                    @elseif($allergy->added_by == Auth::user()->id)
                                                        <div class="d-flex flex-row justify-content-evenly">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $allergy->id }}">
                                                                <img src="/storage/edit.png" alt="" width="20px">
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @include('doctor.allergies.modal.edit')
                                                    </td>
                                                    <td>
                                                            <div class="d-flex flex-row justify-content-evenly">
                                                                <button type="submit" data-value="{{ $allergy->id }}" class="btn btn-sm delete" data-bs-toggle="modal" data-bs-target="#deletemodal" >
                                                                    <img src="/storage/garbage.png" alt="" width="20px">
                                                                </button>
                                                            </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Delete Modal -->
    
                                <form class="" action="{{url('/doctor/allergies/delete')}}" method="POST">
                                    @csrf
                                    @method('DELETE')   
                                    <input type="hidden" name="allergy_id"  value="" class="form-control" id="del_allergy_id" >
                                    <div class="modal" tabindex="-1" id="deletemodal">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title"><b>Delete Allergy</b></h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <p>Are you sure you want to delete this allergy ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </form>
    
                                <!-- --------------------------------------------------------- -->
    
                                <div class="d-flex flex-row justify-content-end p-0">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary primary_color primary_color_border border-0 me-2" data-bs-toggle="modal" data-bs-target="#add_modal">
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
                                            <form id="allergy_add" method="POST" action="{{ URL('/doctor/allergies/create') }}">
                                                @csrf
                                                @method("POST")
                                                <input type="hidden" value="{{ $patient_id }}" name="patient_id">
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
                                
                                <div class="d-flex justify-content-center w-100 mb-0  mt-3">
                                    {{ $allergies->appends(Request::all())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".delete").click(function(){
                $('#del_allergy_id').attr('value', $(this).data('value'));
            });   
        });
    </script>
</body>
</html>
