<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone',
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
    public function hasAnyRole($role){
        return null !== $this->roles()->where('name',$role)->first();
    }
    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('name',$roles)->first();
    }
    public function enquire(){
        return $this->hasMany('App\Enquiry');
    }
    public function agents(){
        return $this->belongsToMany('App\Agent');
    }
    public function enquiryuser(){
        $this->belongsToMany('App\Enquiry');
    }
}
