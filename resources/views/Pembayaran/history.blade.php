@extends('layouts.master')

@section('content')
    <div class="card-header">Selamat datang {{ auth()->user()->name }}</div>
    <div class="card-body">
        <div class="row">
            <div class="text-right">
                <a href="/export_excel" class="m-2 btn btn-primary">
                    print <i class="fas fa-print"></i>
                </a>
                  <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Petugas</th>
                            <th>Nisn</th>
                            <th>Tanggal</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Spp</th>
                            <th>Jumlah Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $i)
                        <tr>
                            <td>{{ $i->id_petugas }}</td>
                            <td>{{ $i->nisn }}</td>
                            <td>{{ $i->tgl_bayar }}</td>
                            <td>{{ $i->bulan_dibayar }}</td>
                            <td>{{ $i->tahun_dibayar }}</td>
                            <td>{{ $i->id_spp }}</td>
                            <td>Rp. {{ number_format( $i->jumlah_bayar) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function (){
            var table = $('#table');

            new DataTable(table);
        });
    </script>
@endsection