<form action="/doctor/prescription/update" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="modal fade text-left" id="ModalEdit{{ $prescription->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Prescription</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $patient_id }}" name="patient_id">
                    <input type="hidden" value="{{ $prescription->id }}" name="prescription_id">
                    <div class="pres_form">
                        <div class="mb-3">
                            <label class="col-form-label">Medication</label>
                            <input type="text" class="form-control" list="medications" name="medication" value="{{ $prescription->medication }}">
                            <datalist id="medications">
                                @foreach ( $medications as $medication )
                                    <option> {{ $medication->name }}</option>
                                @endforeach
                              </datalist>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Instructions</label>
                            <textarea class="form-control" name="instructions">{{ $prescription->instructions }}</textarea>
                        </div>
                        <div class="input-group">
                            <input type="number" class="form-control" name="duration_num">
                            <select class="form-select" name="duration">
                                <option value="days">Days</option>
                                <option value="weeks">Weeks</option>
                                <option value="months">Months</option>
                              </select>
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