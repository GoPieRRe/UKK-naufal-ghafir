<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';

    public $fillable = [
        'id_petugas',
        'nisn',
        'tgl_bayar',
        'bulan_dibayar',
        'tahun_dibayar',
        'id_spp',
        'jumlah_bayar'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn');
    }
}
