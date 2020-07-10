<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{    
    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_jabatan'];
    public $timestamps = false;

    public function barang()
    {
      return $this->hasMany('App\Pegawai','id_jabatan');
    }
}
