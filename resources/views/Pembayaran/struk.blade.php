<html>
<head>
<title> Struk Pembayaran Spp</title>
<style>
    #tabel
        {
            font-size:15px;
            border-collapse:collapse;
        }
    #tabel  td
        {
            padding-left:5px;
            border: 1px solid black;
        }
</style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
            <span style='font-size:12pt'><b>SMK Wikrama 1 Garut</b></span></br>
            Jalan Otto Iskandardinata kampung tanjung RT 003/RW 013, Pasawahan, Kec. Tarogong Kaler, Kabupaten Garut, Jawa Barat 44151
        </br>
                Telp : -
            </td>
        </table>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                Nama Siswa : {{ $siswa->nama }}</br>
                Alamat : {{ $siswa->alamat }}
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                No Telp : {{ $siswa->no_telp }}
            </td>
        </table>
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
  
            <tr align='center'>
                <td width='15%'>Tanggal bayar</td>
                <td width='25%'>Bulan dibayar</td>
                <td width='13%'>Tahun dibayar</td>
                <td width='10%'>jumlah_bayar</td>
                
                
                <tr>
                    @foreach ($pembayaran as $item)
                    <td>{{ $item->tgl_bayar }}</td>
                    <td>{{ $item->bulan_dibayar }}</td>
                    <td>{{ $item->tahun_dibayar }}</td>
                    <td>{{ $item->jumlah_bayar }}</td>
                    <tr>
                    @endforeach
                    <td colspan = '5'><div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div></td>
                    <td style='text-align:right'>Rp. {{ number_format($total) }}</td>
                </tr>
                <tr>
                    <td colspan = '5'><div style='text-align:right'>Cash : </div></td>
                    <td style='text-align:right'>Rp. {{ number_format($jumlah) }}</td>
                </tr>
                <tr>
                    <td colspan = '5'><div style='text-align:right'>Kembalian : </div></td><td style='text-align:right'>Rp. {{ number_format($kembali) }}</td>
                </tr>
            </table>
  
    <table style='width:650; font-size:7pt;' cellspacing='2'>
        <tr>
            <td align='center'>Diterima Oleh,<br><br><br><br><u>({{ $siswa->nama }})</u></td>
            <td style='padding:5px; text-align:left; width:30%'></td>
            <td align='center'>TTD,<br><br><br><br><u>(...........)</u></td>
        </tr>
    </table>
        </center>
    </body>
</html>