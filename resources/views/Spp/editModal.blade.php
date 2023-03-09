<div class="modal fade" id="staticBackdrop{{ $i->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Spp</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('Spp.update', $i->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nominal" class="form-label">Nominal</label>
                    <input type="number" name="nominal" min="1" value="{{ $i->nominal }}" placeholder="Masukkan Nominal" class="form-control" required>
                </div>
                <div class="form-group mt-2">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" min="1" class="form-control" readonly value="{{ $i->tahun }}" name="tahun" placeholder="Masukkan Tahun" required>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>