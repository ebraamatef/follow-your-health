<form action="{{ route('doctor.update.surgeries', $surgery->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="modal fade text-left" id="ModalEdit{{ $surgery->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Allergy</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                    <input type="hidden" value="{{ $surgery->id }}" name="surgery_id">
                    <div class="modal-body">
                        <div class="mb-3">
                          <label for="surgery_name" class="col-form-label">Surgery</label>
                          <input type="text" class="form-control" id="surgery" name="surgery_name" value="{{ $surgery->surgery }}">
                        </div>
                        <div class="mb-3">
                          <label for="surgery_name" class="col-form-label">Reason</label>
                          <input type="text" class="form-control" id="surgery" name="reason" value="{{ $surgery->reason }}">
                        </div>
                        <div class="mb-3">
                          <label for="surgery_name" class="col-form-label">Foreing Object</label>
                          <input type="text" class="form-control" id="surgery" name="foreign_object" value="{{ $surgery->foreign_object }}">
                        </div>
                        <div class="mb-3">
                          <label for="surgery_name" class="col-form-label">Doctor/Hospital</label>
                          <input type="text" class="form-control" id="surgery" name="doctor" value="{{ $surgery->doctor }}">
                        </div>
                        <div class="mb-3">
                          <label for="surgery_name" class="col-form-label">Year</label>
                          <input type="date" class="form-control" id="surgery" name="year" value="{{ $surgery->year }}">
                        </div>
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