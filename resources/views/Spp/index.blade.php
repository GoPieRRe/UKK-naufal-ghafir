@extends('layouts.master')

@section('content')
    <div class="card-header">Spp</div>
    <div class="card-body">
        <button type="button" class="m-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            add <i class="fas fa-plus"></i>
          </button>
          @include('Spp.addModal')
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>Nominal</th>
                    <th>Tahun</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Spp as $i)
                <tr>
                    <td>Rp. {{ number_format($i->nominal) }}</td>
                    <td>{{ $i->tahun }} - {{ $i->tahun+3 }}</td>
                    <td>
                        <form onsubmit="return confirm('are you sure want delete spp tahun: {{ $i->tahun }}')" action="{{ route('Spp.destroy', $i->id) }}" method="post">
                            <button type="button" class="m-2 btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $i->id }}"><i class="fas fa-pen"></i></button>
                            @csrf
                           @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @include('Spp.editModal')
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