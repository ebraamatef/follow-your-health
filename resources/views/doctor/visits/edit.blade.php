@extends('layouts.app')

@section('content')
<div class="mb-5" style="width: 100%; height: 150px; background-image:  url('{{ URL('/storage/doctor_banner.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
        <div class='col-12 col-md-10 text-center'>
            <p class='text-white fs-1'><b>Edit Visit</b></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12 mb-5">
            <div class="pb-4 card border-0 rounded-0">
              <div class="card-header border-1 primary_color mb-4 fs-4 d-flex align-items-center border-0 rounded-0">
                  <a href="{{ URL('/doctor/visits/index', $visit[0]['patient_id']) }}" class="float-start text-decoration-none text-white fs-6">
                      <img src="{{ URL('storage/new/arrow.png') }}" calss="me-5" width="20"><b>    Back To Visits</b>
                  </a>
              </div>
              <div class="card-body"> 
                <div class="row justify-content-center">
                  <div class="col-11 col-sm-10 col-md-8">
                    <div class="row">
                      <div class="col-12 mb-4">
                        <p class="m-0"><b class="fs-6">Patient Name :</b> {{ $visit[0]['patient']['name'] }}</p>
                        <p class="m-0"><b class="fs-6">Doctor :</b> {{ $visit[0]['doctor_name'] }}</p>
                        <p class="m-0"><b class="fs-6">Specialty :</b> {{ $visit[0]['specialty'] }}</p>
                      </div>
                      <div class="col-12">
                        @php $date = date("d/m/Y")@endphp
                        <div class="float-end">
                          <p class="m-0"><b class="fs-6">Date :</b> {{ $visit[0]['date'] }} </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form id="edit_form" action="{{ URL('doctor/visits/update') }} " method="post">
                    @csrf
                    <input type="hidden" value="{{ $visit[0]['id'] }}" name="visit_id">
                    <input type="hidden" value="{{ $visit[0]['patient_id'] }}" name="patient_id">
                    <div class="row justify-content-center mt-4">
                        <div class="col-11 col-sm-10 col-md-8">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Patient Compliant</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="patient_complaint">{{ $visit[0]['patient_complaint'] }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Visit Report</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="visit_report">{{ $visit[0]['visit_report'] }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Action</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="treatment_action">{{ $visit[0]['treatment_action'] }}</textarea>
                            </div>
                            <label for='exampleFormControlTextarea1' class='form-label'><b>Prescription</b></label>
                            <div class="table-responsive mb-2">
                            <table id="" class="table table-hover table-bordered">
                              <thead>
                                  <tr>
                                      <th scope="col">Medication</th>
                                      <th scope="col">Instructions</th>
                                      <th scope="col">Start</th>
                                      <th scope="col">End</th>
                                      <th scope="col">Status</th>
                                      <th scope="col">Delete</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ( $prescriptions as $prescription )
                                  <tr class='clickable-row' data-href=''>
                                    <td>{{ $prescription->medication }}</td>
                                    <td>{{ $prescription->instructions }}</td>
                                    <td>{{ $prescription->start_date }}</td>
                                    <td>{{ $prescription->end_date }}</td>
                                    <td>@if(strtotime($prescription->end_date) < strtotime(date('m/d/Y'))) <span class='text-danger'>Inactive</span> @elseif(strtotime($prescription->end_date) > strtotime(date('m/d/Y'))) <span class='text-success'>Active</span> @endif</td> 
                                    <td>
                                    @if( $visit[0]['doctor_id'] != Auth::user()->doctor->id)
                                      <div class="d-flex flex-row justify-content-evenly">
                                          <input type="hidden" name="id"  value="{{$visit->id}}" class="form-control" id="" >
                                          <button type="submit" 
                                          class="btn btn-light btn-sm">
                                              <img src="/storage/garbage_inactive.png" alt="" width="20px">
                                          </button>
                                      </div>
                                      @elseif($visit[0]['doctor_id'] == Auth::user()->doctor->id)
                                      <form id="delete_btn" action="{{url('/doctor/prescription/delete')}}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                          <div class="d-flex flex-row justify-content-evenly">
                                              <input type="hidden" name="id"  value="{{$visit[0]['id']}}" class="form-control" >
                                              <button form="delete_btn" type="submit" 
                                              class="btn btn-light btn-sm">
                                                  <img src="/storage/garbage.png" alt="" width="20px">
                                              </button>
                                          </div>
                                      </form>
                                    @endif
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            </div>
                            <div id="pres_form_container">
                            <div class="btn btn-primary primary_color primary_color_border add_med meds mt-4"><b>Add Prescription</b></div>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <div class="mt-3">
                                  <button form="edit_form" name="visit_details_doctor_save_button" type="submit" class="btn btn-primary  primary_color primary_color_border float-end">Save</button>
                                </div>
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
</script>
@endsection
