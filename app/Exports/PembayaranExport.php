<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class PembayaranExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (auth()->user()->level == 'siswa') {
                $siswa = Siswa::where('nis', auth()->user()->username)->first();
            return Pembayaran::where('nisn',$siswa->nisn)->get();
        }else{
            return Pembayaran::all();
        }
    }
}
