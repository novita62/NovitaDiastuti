<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $table = 'pangkat';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_pangkat'];
    public $timestamps = false;

    public function pegawai()
    {
        return $this->hasMany('App\Pegawai', 'id_pangkat');
    }
   
}
