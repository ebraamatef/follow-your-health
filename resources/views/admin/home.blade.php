@extends('layouts.app')

@section('content')
<form class="row g-3" action="{{url('/admin/add_med')}}">
    <div class="col-10 col-sm-8 col-md-8">
        <div class="d-flex">
            <div class="col-8 col-sm-10 col-md-8 col-lg-6 me-3">
                <input name="name" type="text" class="form-control" id="searchquery" placeholder="name...">
                <input name="usage" type="text" class="form-control" id="searchquery" placeholder="usage...">

            </div>
            <div class="col-auto">
                <button name="search_button_visits_patient" type="submit" class="btn btn-primary mb-3">Add</button>
            </div>
        </div>
    </div> 
</form>
@endsection
