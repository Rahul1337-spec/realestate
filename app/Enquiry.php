<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    public function enquiry(){
        return $this->belongsToMany('App\User');
    }
    public function property_enquiry(){
        return $this->belongsToMany('App\Property');
    }
}
