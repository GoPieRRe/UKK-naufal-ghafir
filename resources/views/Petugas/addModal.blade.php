<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Petugas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('Petugas.store') }}" method="post">
                @csrf
                <div class="form-group mt-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="email" class="form-control" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="form-group mt-2">
                    <label for="nama_petugas" class="form-label">Nama Petugas</label>
                    <input type="text" class="form-control" name="nama_petugas" placeholder="Masukkan Nama Petugas" required>
                </div>
                <div class="form-group mt-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                </div>
                <div class="form-group mt-2">
                    <label for="confirm_password" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Masukkan Konfirmasi Password" required>
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