@extends('layouts.master')

@section('content')
    <div class="card-header">Pembayaran</div>
    <div class="card-body">
        <button type="button" id="btnModal" class="m-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
          @include('Pembayaran.addModal')
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
                    {{-- <th>Action</th> --}}
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
                    <td>Rp. {{ number_format($i->spp->nominal) }} - {{ $i->spp->tahun }}</td>
                    <td>Rp. {{ number_format( $i->jumlah_bayar) }}</td>
                    @include('Pembayaran.editModal')
                    {{-- <td>
                        <form onsubmit="return confirm('are you sure want delete {{ $i->nama }}')" action="{{ route('Siswa.destroy', $i->id) }}" method="post">
                            <button type="button" value="{{ $i->id }}" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $i->id }}"><i class="fas fa-pen"></i></button>
                            @csrf
                           @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td> --}}
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
            $('#btnModal').on('click', function () {
                $('#btnSubmit').addClass('disabled');
            });

            $('#btnSubmit').on('click', function () {
                location.reload();
            });

        });
    </script>
    <script>
        $(function () {
            $('#nisn').on('change', function () {
                var nisn = $(this).val();
                $('#berapa').removeAttr('disabled');
                $('#cek').removeClass('d-none');
                
                var berapa = $('#berapa').val();
                $.ajax({
                    url : "{{ url('Pembayaran/getData') }}" + "/" + nisn + "/" + berapa,
                    type : "GET", 
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $('#spp').val(data.nominal);
                        $('#spps').val(data.spp);
                        $('#byr').val(data.nominal);
                        $('#blnku').val(data.buln);
                        $('#bulan_bayar').val(data.bulan);
                        $('#tahun_bayar').val(data.tahun);
                        $('#bulan').val(data.bulan + " " + data.tahun);
                        $('#created').val(data.created);

                    }
                });
            });

            $('#berapa').on('change', function () {
                var brp = $(this).val();
                var spp = $('#spp').val();
                var total = spp * brp;
                $('#byr').val(total);
            });

            $('#bayars').keyup(function () {
                var total = $('#byr').val();
                var bayar = $(this).val();

                if (parseInt(bayar) >= parseInt(total)) {
                    $('#btnSubmit').removeClass('disabled');
                }else{
                    $('#btnSubmit').addClass('disabled');
                }
                
                var sanitized = $(this).val().replace(/[^0-9]/g, '');
                $(this).val(sanitized);
                
                

                var kembali = parseInt(bayar) - parseInt(total);

                $('#kembalian').val(kembali);
            });
        });
    </script>
@endsection