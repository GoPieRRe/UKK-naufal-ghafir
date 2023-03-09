@extends('layouts.master')

@section('content')
    <div class="card-header">Siswa</div>
    <div class="card-body">
        <button type="button" class="m-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            add <i class="fas fa-plus"></i>
          </button>
          
          @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
          </div>
        @endif

        @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
          </div>
        @endif
          @include('Siswa.addModal')
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>Nisn</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Spp</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Siswa as $i)
                <tr>
                    <td>{{ $i->nisn }}</td>
                    <td>{{ $i->nis }}</td>
                    <td>{{ $i->nama }}</td>
                    <td>{{ $i->kelas->nama_kelas }}-{{ $i->kelas->kompetensi_keahlian }}</td>
                    <td>{{ $i->alamat }}</td>
                    <td>{{ $i->no_telp }}</td>
                    <td>Rp. {{ number_format($i->spps->nominal) }} - ({{ $i->spps->tahun }} - {{ $i->spps->tahun+3 }})</td>
                    @include('Siswa.editModal')
                    <td>
                        <form onsubmit="return confirm('are you sure want delete {{ $i->nama }}')" action="{{ route('Siswa.destroy', $i->id) }}" method="post">
                            <button type="button" value="{{ $i->id }}" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $i->id }}"><i class="fas fa-pen"></i></button>
                            @csrf
                           @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(function () {

            var data = $('#table');

            new DataTable(data);

        });
    </script>
@endsection