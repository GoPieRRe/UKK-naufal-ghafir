<div class="modal fade" id="staticBackdrop{{ $i->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('Kelas.update', $i->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_kelas" class="form-label">Jurusan</label>
                    <select name="nama_kelas" class="form-control select2" id="none" required>
                        <option value="{{ $i->nama_kelas }}">{{ $i->nama_kelas }}</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian</label>
                    <input type="text" class="form-control" name="kompetensi_keahlian" value="{{ $i->kompetensi_keahlian }}" placeholder="Masukkan Jurusan" required>
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

    