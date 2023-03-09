<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pembayaran;
use App\Models\Spp;
use App\Models\Kelas;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    public $fillable = [
        'nisn',
        'nis',
        'nama',
        'id_kelas',
        'alamat',
        'no_telp',
        'id_spp'
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'nisn', 'nisn');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function spps()
    {
        return $this->belongsTo(Spp::class, 'id_spp');
    }
}
