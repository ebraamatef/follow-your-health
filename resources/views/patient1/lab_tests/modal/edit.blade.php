<form action="{{url('/lab/test/update/'.$test->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="modal fade text-left" id="ModalEdit{{ $test->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit test</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $test->id }}" name="test_id">
                    <div class="mb-3">
                        <label for="test_name" class="col-form-label">Test</label>
                        <input type="text"  value="{{$test->test}}" class="form-control" id="allergy" name="test_name">
                      </div>
                      <div class="mb-3">
                          
                          {{-- <input type="hidden" class="form-control" id="allergy" value="{{$id}}" name="patient_id"> --}}
                        </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">lab</label>
                        <input type="text" value="{{$test->lab_name}}" class="form-control" id="lab" name="lab_name">
                      </div>
                      <div class="mb-3">
                          <label for="recipient-name" class="col-form-label">Doctor</label>
                          <input type="text"  value="{{$test->doctor_name}}" class="form-control" id="doctor" name="doctor_name">
                        
                      </div>
                      <div class="mb-3">
                        <label for="message-text" class="col-form-label">Date</label>
                        <input type="date"value="{{$test->date}}" class="form-control" id="doctor" name="date">
                      </div>
                      <div class="mb-3">
                          <label for="message-text" class="col-form-label">File</label>
                          <input type="file" class="form-control"  id="doctor" name="file_t">
                        </div>
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</form>