<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function types(){
        $this->belongsToMany('App\Property');
    }
}
