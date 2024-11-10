<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahagian extends Model
{
    protected $table = 'tbahagian';

    public function unit()
    {
    	return $this->hasMany('App\Unit');
    }

}
