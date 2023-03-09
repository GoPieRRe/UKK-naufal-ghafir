<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('Pembayaran.store') }}" method="post">
                @csrf
                <div class="form-group mt-2">
                    <label for="nisn" class="form-label">Nisn</label>
                    <select name="nisn" id="nisn" class="form-control">
                        <option>--Pilih--</option>
                        @foreach ($siswa as $a)
                            <option value="{{ $a->nisn }}">{{ $a->nisn }} - {{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="created" id="created">
                <div class="d-none" id="cek">

                    <div class="form-group mt-2">
                        <label for="Spp" class="form-label">Spp</label>
                        <input type="text" class="form-control" readonly id="spp">
                    </div>
                    <div class="form-group mt-2">
                        <label for="nisn" class="form-label">Bayar Berapa Bulan</label>
                        <select name="bayar_berapa" id="berapa" class="form-control" disabled>
                            <option value="1">1 Bulan</option>
                            <option value="2">2 Bulan</option>
                            <option value="3">3 Bulan</option>
                            <option value="4">4 Bulan</option>
                            <option value="5">5 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="7">7 Bulan</option>
                            <option value="8">8 Bulan</option>
                            <option value="9">9 Bulan</option>
                            <option value="10">10 Bulan</option>
                            <option value="11">11 Bulan</option>
                        <option value="12">12 Bulan</option>
                    </select>
                </div>
                <input type="hidden" name="bulans" id="bulan_bayar">
                <input type="hidden" name="blns" id="blnku">
                <input type="hidden" name="spps" id="spps">
                <input type="hidden" name="tahuns" id="tahun_bayar">
                <div class="form-group mt-2">
                    <label for="nis" class="form-label">Terakhir Bayar</label>
                    <input type="text" class="form-control" id="bulan" disabled>
                </div>
                <div class="form-group mt-2">
                    <label for="nis" class="form-label">Total pembayaran</label>
                    <input type="text" id="byr" class="form-control" readonly name="total_bayar">
                </div>
                <div class="form-group mt-2">
                    <label for="total_bayar" class="form-label">Bayar</label>
                    <input type="text" id="bayars" class="form-control" placeholder="Bayar" name="jumlah_bayar" required>
                </div>
                <div class="form-group mt-2">
                    <label for="total_bayar" class="form-label">Kembalian</label>
                    <input type="text" id="kembalian" class="form-control" readonly name="kembalian">
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Bayar</button>
            </form>
            </div>
        </div>
        </div>
    </div>