<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function bahagian(){
        return $this->belongsToMany('App\Bahagian');
    }

    public function unit(){
        return $this->belongsToMany('App\Unit');
    }
    
    //---------------------------------------------------------

    public function hasAnyRoles($roles){
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }
        return false;
    }

    public function hasRoles($role){
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }

    //---------------------------------------------------------

    public function hasAnyBahagians($bahagians){
        if($this->bahagian()->whereIn('id', $bahagians)->first()){
            return true;
        }
        return false;
    }

    public function hasBahagians($bahagian){
        if($this->bahagian()->where('id', $bahagian)->first()){
            return true;
        }
        return false;
    }
    //--------------------------------------------------------------
     public function hasAnyUnits($units){
        if($this->unit()->whereIn('id', $units)->first()){
            return true;
        }
        return false;
    }

    public function hasUnits($unit){
        if($this->unit()->where('id', $unit)->first()){
            return true;
        }
        return false;
    }
}
