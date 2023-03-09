<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('Siswa.store') }}" method="post">
                @csrf
                <div class="form-group mt-2">
                    <label for="nisn" class="form-label">Nisn</label>
                    <input type="number" min="1" class="form-control" name="nisn" placeholder="Masukkan Nisn" required>
                </div>
                <div class="form-group mt-2">
                    <label for="nis" class="form-label">Nis</label>
                    <input type="number" min="1" class="form-control" name="nis" placeholder="Masukkan Nis" required>
                </div>
                <div class="form-group mt-2">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group mt-2">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select name="id_kelas" id="" class="form-control">
                        <option>--Pilih--</option>
                        @foreach ($Kelas as $i)
                            <option value="{{ $i->id }}">{{ $i->nama_kelas }}-{{ $i->kompetensi_keahlian }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="nama" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" id="" cols="15" rows="5"></textarea>
                </div>
                <div class="form-group mt-2">
                    <label for="no_telp" class="form-label">Number phone</label>
                    <input class="form-control" type="number" name="no_telp" placeholder="+62-xxxx-xxxx">
                </div>
                <div class="form-group mt-2">
                    <label for="Spp" class="form-label">Spp</label>
                    <select name="id_spp" class="form-control">
                        <option>--Pilih--</option>
                        @foreach ($Spp as $i)
                            <option value="{{ $i->id }}">Rp. {{ number_format($i->nominal) }}-{{ $i->tahun }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        </div>
        </div>
    </div>