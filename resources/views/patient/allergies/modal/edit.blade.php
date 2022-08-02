<form action="{{ route('patient.update.allergies', $allergy->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="modal fade text-left" id="ModalEdit{{ $allergy->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Allergy</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $allergy->id }}" name="allergy_id">
                    <div class="mb-3">
                        <label for="allergy_name" class="col-form-label">Allergy</label>
                        <input type="text" class="form-control" id="allergy" name="allergy_name" value="{{ $allergy->allergy }}">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Type</label>
                        <select class="form-select" aria-label="Default select example" name="type">
                        <option @if ($allergy->type == NULL)
                            selected @endif>Select Allergy Type</option>
                        <option value="food" @if ($allergy->type == 'food')
                            selected @endif>Food</option>
                        <option value="drug" @if ($allergy->type == 'drug')
                            selected @endif>Drug</option>
                        <option value="pollen" @if ($allergy->type == 'pollen')
                            selected @endif>Pollen</option>
                        <option value="pet" @if ($allergy->type == 'pet')
                            selected @endif>Pet</option>
                        <option value="other" @if ($allergy->type == 'other')
                            selected @endif>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status">
                        <option @if ($allergy->status == NULL)
                            selected @endif>Select Allergy Status</option>
                        <option value="active" @if ($allergy->status == 'active')
                            selected @endif>Active</option>
                        <option value="inactive" @if ($allergy->status == 'inactive')
                            selected @endif>Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Notes/Reaction:</label>
                        <textarea class="form-control" id="message-text" name="notes">{{ $allergy->notes }}</textarea>
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