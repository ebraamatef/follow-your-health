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
                 <div class="mb-4 row justify-content-center">
                    <div class="col-11 p-0">
                        <div class="row justify-content-center">
                                <div class="col-8 col-sm-6 col-md-8">
                                    <div class="d-flex">
                                        <input list="europe-countries" placeholder="Start typing...">
                                        <datalist id="europe-countries">
                                            @foreach ( $medications as $medication )
                                                <option> {{ $medication->name }}</option>
                                            @endforeach
                                        </datalist>

                                    </div>
                                </div>
                        </div>
                    </div>
                </div> 
                <div class="my-5 row justify-content-center">
                    <div class="col-11 ">
                        <div class="row justify-content-center">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>
<script type="text/javascript">
    var route = "{{ url('autocomplete-search') }}";
    $('#search').typeahead({
        source: function (query, process) {
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
</script>
@endsection
