<form action="{{url('/lab/radiology/update/'.$radiology->id) }}" method="post" enctype="multipart/form-data">
    @csrf
   
    @method('POST')
    <div class="modal fade text-left" id="ModalEdit{{ $radiology->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $radiology->id }}" name="radiology_id">
                    <div class="mb-3">
                        <label for="radiology_name" class="col-form-label">Radiology</label>
                        <input type="text"  value="{{$radiology->radiology}}" class="form-control" id="allergy" name="radiology">
                      </div>
                      <div class="mb-3">
                          
                          <input type="hidden" class="form-control" id="allergy" value="{{$id}}" name="patient_id">
                        </div>
                      <div class="mb-3">
                        <label for="message-text" class="col-form-label">Date</label>
                        <input type="date"value="{{$radiology->date}}" class="form-control" id="doctor" name="date">
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