@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>New Visit</b></p>
        </div>
    </div>
</div>
<div class="container">
  <div class="row justify-content-center mb-5">
            <div class="pb-4 card border-0 rounded-0">
              <div class="card-header border-1 primary_color mb-0 fs-4 d-flex align-items-center border-0 rounded-0">
                  <a href="{{ URL('/doctor/visits/index', $patient_id) }}" class="float-start text-decoration-none text-white fs-6">
                      <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Visits</b>
                  </a>
              </div>
              <div class="card-header border-1 bg-white ps-3 mb-1 pt-3 fs-4">
                  <div id="ivisits" class="btn btn-primary mb-2 primary_color primary_color_border ifr">Visits</div>
                  <div id="itests" class="btn btn-primary mb-2 primary_color primary_color_border ifr">Tests</div>
                  <div id="iradiology" class="btn btn-primary mb-2 primary_color primary_color_border ifr">Radiology</div>
                  <div id="iallergies" class="btn btn-primary mb-2 primary_color primary_color_border ifr">Allergies</div>
                  <div id="isurgeries" class="btn btn-primary mb-2 primary_color primary_color_border ifr">Surgeries</div>
                  <div id="ireadings" class="btn btn-primary mb-2 primary_color primary_color_border ifr">BP / BS Readings</div>
                  <div id="ifamily" class="btn btn-primary mb-2 primary_color primary_color_border ifr">Family History</div>
                  <div id="iconditions" class="btn btn-primary mb-2 primary_color primary_color_border ifr">Conditions</div>
                  <div id="imedicalprofile" class="btn btn-primary mb-2 primary_color primary_color_border ifr">Medical Profile</div>
              </div>
              <div class="card-body"> 
  
                <iframe class="mb-5 border border-primary primary_color_border" style="display:none" src="" width="100%" height="500"></iframe>
                
                <div class="row justify-content-center">
                  <div class="col-11 col-sm-10 col-md-8">
                    <div class="row">
                      <div class="col">
                        <p class="m-0"><b class="fs-6">Patient Name :</b> {{ $patient_name }}</p>
                        <p class="m-0"><b class="fs-6">Doctor :</b> {{ $doctor_name }}</p>
                        <p class="m-0"><b class="fs-6">Specialty :</b> {{ $doctor_specialty }}</p>
                      </div>
                      <div class="col">
                        @php $date = date("d/m/Y")@endphp
                        <div class="float-end">
                          <p class="m-0"><b class="fs-6">Date :</b> {{ $date }} </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form action="{{ URL('doctor/visits/create') }} " method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <input type="hidden" value="{{ $date }}" name="date">
                        <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                        <div class="col-11 col-sm-10 col-md-8 mt-4">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Reason for visit</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="patient_complaint"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Visit Report</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="visit_report"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Action</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="treatment_action"></textarea>
                            </div>
                            <label for='exampleFormControlTextarea1' class='form-label'><b>Prescription</b></label>
                            <div id="pres_form_container">
                            <div class="btn btn-primary  primary_color primary_color_border add_med mt-4"><b>Add Prescription</b></div>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <div class="mt-3">
                                  <button name="visit_details_doctor_save_button" type="submit" class="btn btn-primary  primary_color primary_color_border float-end">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function(){
    var med_form = '<div class="pres_form col-12 col-lg-6 mb-4">\
                                <div class="mb-3">\
                                    <label class="col-form-label">Medication</label>\
                                    <input type="text" class="form-control" list="medications" name="medication[name][]" value="">\
                                    <datalist id="medications">\
                                        @foreach ( $medications as $medication )\
                                            <option> {{ $medication->name }}</option>\
                                        @endforeach\
                                      </datalist>\
                                </div>\
                                <div class="mb-3">\
                                    <label class="col-form-label">Instructions</label>\
                                    <textarea class="form-control" name="medication[instructions][]"></textarea>\
                                </div>\
                                <div class="input-group">\
                                    <input type="number" class="form-control" name="medication[duration_num][]">\
                                    <select class="form-select" name="medication[duration][]">\
                                        <option value="days">Days</option>\
                                        <option value="weeks">Weeks</option>\
                                        <option value="months">Months</option>\
                                      </select>\
                                </div>\
                                <div class="p-2 py-0 fs-6 text-white border-1 rounded-2 bg-danger float-end my-3 remove"><b>X</b></div>\
                            </div>'

    $('#pres_form_container').on('click', '.add_med', function(){
      $(med_form).insertBefore('.add_med');
    });
  });

  $(document).ready(function(){
    $("#pres_form_container").on("click", ".remove", function() {
      $(this).parent().remove();
    });
  });

  $(document).ready(function(){
    $('.ifr').click( function(){
      $('iframe').show();
    });
    $("#ivisits").click( function() {
        $('iframe').attr('src', "{{ URL('/doctor/visit/iframe/visits', $patient_id) }}");
    });
    $("#itests").click( function() {
        $('iframe').attr('src', "{{ URL('/doctor/visit/iframe/tests', $patient_id) }}");
    });
    $("#iradiology").click( function() {
        $('iframe').attr('src', "{{ URL('/doctor/visit/iframe/radiology', $patient_id) }}");
    });
    $("#iallergies").click( function() {
        $('iframe').attr('src', "{{ URL('/doctor/visit/iframe/allergies', $patient_id) }}");
    });
    $("#isurgeries").click( function() {
        $('iframe').attr('src', "{{ URL('/doctor/visit/iframe/surgeries', $patient_id) }}");
    });
    $("#ireadings").click( function() {
        $('iframe').attr('src', "{{ URL('/doctor/visit/iframe/readings', $patient_id) }}");
    });
    $("#imedicalprofile").click( function() {
        $('iframe').attr('src', "{{ URL('/doctor/visit/iframe/medical-profile', $patient_id) }}");
        $('iframe').attr('height', '500');
    });
    $("#ifamily").click( function() {
        $('iframe').attr('src', "{{ URL('/doctor/visit/iframe/family', $patient_id) }}");
    });
    $("#iconditions").click( function() {
        $('iframe').attr('src', "{{ URL('/doctor/visit/iframe/conditions', $patient_id) }}");
    });
  });
</script>
@endsection
