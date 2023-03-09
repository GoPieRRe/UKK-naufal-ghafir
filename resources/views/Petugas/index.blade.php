@extends('layouts.master')

@section('content')
    <div class="card-header">Petugas</div>
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
          @include('Petugas.addModal')
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Nama Petugas</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Petugas as $i)
                <tr>
                    <td>{{ $i->username }}</td>
                    <td>{{ $i->nama_petugas }}</td>
                    <td>{{ $i->level }}</td>
                    <td>
                        <form onsubmit="return confirm('are you sure want delete {{ $i->nama_petugas}}')" action="{{ route('Petugas.destroy', $i->id) }}" method="post">
                            <button type="button" class="m-2 btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $i->id }}">
                                <i class="fas fa-pen"></i>
                              </button>
                            @csrf
                           @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @include('Petugas.editModal')
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