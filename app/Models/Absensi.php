<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $fillable = ['pegawai_id', 'tanggal'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    // Method untuk menghitung total absensi pegawai
    public static function totalAbsensi($pegawaiId)
    {
        return self::where('pegawai_id', $pegawaiId)->count();
    }
}