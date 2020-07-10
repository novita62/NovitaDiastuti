<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komdanas extends Model
{    
    public $incrementing = false;
    protected $table = 'komdanas';
    protected $primaryKey = 'kode';
    protected $fillable = ['kode', 'keterangan', 'deskripsi'];
    public $timestamps = false;
    
}
