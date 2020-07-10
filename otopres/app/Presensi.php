<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{    
    protected $table = 'presensi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis', 'id_finger', 'nip_pegawai', 'nama_file',  'tanggal', 'jam_masuk', 'jam_pulang', 'terlambat', 'pulang_cepat', 'jumlah_jam', 'status_komdanas', 'keterangan', 'file'
    ];
    public $timestamps = false;
    public $keterangan;
    
    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'nip_pegawai');
    }
}
