<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    Protected $table = 'pegawai';

    public function bahagian()
    {
    	return $this->belongsTo('App\Bahagian');
    }

    public function unit()
    {
    	return $this->belongsTo('App\Unit');
    }

}

