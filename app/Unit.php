<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'tunit';

    public function pegawai()
    {
    	return $this->hasMany('App\Pegawai');
    }  

}

