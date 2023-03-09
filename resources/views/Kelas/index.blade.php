@extends('layouts.master')

@section('content')
    <div class="card-header">Kelas</div>
    <div class="card-body">
        <button type="button" class="m-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add <i class="fas fa-plus"></i></button>
        
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
          @include('Kelas.addModal')
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>Tingkatan</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $i)
                <tr>
                    <td>{{ $i->nama_kelas }}</td>
                    <td>{{ $i->kompetensi_keahlian }}</td>
                    <td>
                        <form onsubmit="return confirm('are you sure want delete {{ $i->nama_kelas . '-' .$i->kompetensi_keahlian }}')" action="{{ route('Kelas.destroy', $i->id) }}" method="post">
                            <button type="button" class="m-2 btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $i->id }}"><i class="fas fa-pen"></i></button>
                            @csrf
                           @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @include('Kelas.editModal')
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
    <script>
        $(function () {
            $("#none").each(function() {
                $(this).siblings('[value="'+ this.value +'"]').remove();
            });
        });
    </script>
@endsection