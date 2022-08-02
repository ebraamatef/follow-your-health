<form action="{{ route('patient.offmeds.update', $med->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="modal fade text-left" id="ModalEdit{{ $med->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Medication</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $med->id }}" name="allergy_id">
                    <div class="mb-3">
                        <label for="allergy_name" class="col-form-label">Medication</label>
                        <input type="text" class="form-control" list="medications" value="{{ $med->medication }}" name="medication">
                        <datalist id="medications">
                            @foreach ( $medications as $medication )
                                <option> {{ $medication->name }}</option>
                            @endforeach
                        </datalist>
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status">
                          <option value="frequently" @if($med->status == 'frequently') selected @endif>Frequently</option>
                          <option value="occasionally" @if($med->status == 'occasionally') selected @endif>Occasionally</option>
                          <option value="needed" @if($med->status == 'needed') selected @endif>When needed</option>
                          <option value="stopped" @if($med->status == 'stopped') selected @endif>Stopped</option>
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