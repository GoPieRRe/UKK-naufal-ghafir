@extends('layouts.master')

@section('content')
    <div class="card-header">Selamat datang {{ auth()->user()->name }}</div>
    <div class="card-body">
        <div class="row">
            @if (auth()->user()->level != 'siswa')
                
            <div class="col">
                <a href="/export_excel" class="m-2 btn btn-primary">
                    print <i class="fas fa-print"></i>
                </a>
            </div>
            @endif
            @if (auth()->user()->level == 'siswa')
            <div class="col-11">
                <h5>{{ auth()->user()->name }} Telah membayar sampai bulan : {{ $bulan->bulan_dibayar }} {{ $bulan->tahun_dibayar }}</h5>
            </div>

            <div class="modal bd-example-modal-lg fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Petugas</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="tables">
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
                                        <td>{{ $i->petugas->name }}</td>
                                        <td>{{ $i->nisn }} - {{ $i->siswa->nama }}</td>
                                        <td>{{ $i->tgl_bayar }}</td>
                                        <td>{{ $i->bulan_dibayar }}</td>
                                        <td>{{ $i->tahun_dibayar }}</td>
                                        <td>{{ $i->spp->tahun }} - {{ $i->spp->tahun+3 }}</td>
                                        <td>Rp. {{ number_format( $i->jumlah_bayar) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <h3 class="text-right">
                <button type="button" id="btnModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fas fa-eye"></i> Lihat</button>
            </h3>
        </div>
            @endif
            
            @if(auth()->user()->level != 'siswa')
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
                            <td>{{ $i->petugas->name }}</td>
                            <td>{{ $i->nisn }} - {{ $i->siswa->nama }}</td>
                            <td>{{ $i->tgl_bayar }}</td>
                            <td>{{ $i->bulan_dibayar }}</td>
                            <td>{{ $i->tahun_dibayar }}</td>
                            <td>{{ $i->spp->tahun }} - {{ $i->spp->tahun+3 }}</td>
                            <td>Rp. {{ number_format( $i->jumlah_bayar) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
    </div>
@endsection

@section('script')
    <script>
        $(function (){
            var table = $('#table');

            new DataTable(table);

            var tables = $('#tables');

            new DataTable(tables);
        });
    </script>
@endsection