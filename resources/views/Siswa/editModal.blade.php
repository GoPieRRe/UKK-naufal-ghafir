<div class="modal fade" id="staticBackdrop{{ $i->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('Siswa.update', $i->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" id="ids" value="{{ $i->id }}">
                <div class="form-group mt-2">
                    <label for="nisn" class="form-label">Nisn</label>
                    <input type="number" value="{{ $i->nisn }}" min="1" class="form-control" name="nisn" placeholder="Masukkan Nisn" required>
                </div>
                <div class="form-group mt-2">
                    <label for="nis" class="form-label">Nis</label>
                    <input type="number"value="{{ $i->nis }}" min="1" class="form-control" name="nis" placeholder="Masukkan Nis" required>
                </div>
                <div class="form-group mt-2">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" value="{{ $i->nama }}" class="form-control" name="nama" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group mt-2">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select name="id_kelas" id="" class="form-control">
                        <option value="{{ $i->id_kelas }}">{{ $i->kelas->nama_kelas }} -{{ $i->kelas->kompetensi_keahlian }}</option>
                        @foreach ($Kelas as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_kelas }}-{{ $s->kompetensi_keahlian }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group mt-2">
                    <label for="nama" class="form-label">alamat</label>
                    <textarea name="alamat" id="" cols="15" class="form-control" rows="5">{{ $i->alamat }}</textarea>
                </div>
                <div class="form-group mt-2">
                    <label for="nama" class="form-label">no telp</label>
                    <input type="number" value="{{ $i->no_telp }}" class="form-control" name="no_telp" placeholder="+62-xxxx-xxxx" required>
                </div>
                <div class="form-group mt-2">
                    <label for="spp" class="form-label">Spp</label>
                    <select class="form-control" name="id_spp" id="spp">
                        <option value="{{ $i->id_spp }}">Rp. {{ number_format($i->spps->nominal) }} - {{ $i->spps->tahun }}</option>
                        @foreach ($Spp as $p)
                        <option value="{{ $p->id }}">Rp. {{ number_format($p->nominal) }} - {{ $p->tahun }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Edit</button>
            </form>
            </div>
        </div>
        </div>
    </div>