<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
    ];

    public function documents(){
        return $this->belongsToMany('App\Property');
    }

    public function documenttype(){
        return $this->belongsToMany('App\Doctype');
    }

}
