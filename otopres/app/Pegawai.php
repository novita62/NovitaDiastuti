<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{

    public $incrementing = false;
    protected $table = 'pegawai';
    protected $primaryKey = 'nip';
    protected $fillable = ['nip','id_jabatan', 'id_pangkat', 'nama', 'jam_masuk', 'jam_pulang'];
    public $timestamps = false;

    public $finger;
    public $manual;
    public $kehadiran;
    public $keterangan;

    public $status;
    public $file;
    public $tanggal_start;
    public $tanggal_end;
    
    public $masuk;
    public $pulang;
    
    public function presensi()
    {
      return $this->hasMany('App\Presensi','nip_pegawai');
    }

    public function nipid() {
        return str_replace(' ', '', $this->nip);
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan', 'id_jabatan');
    }

    public function pangkat()
    {
        return $this->belongsTo('App\Pangkat', 'id_pangkat');
    }
}
