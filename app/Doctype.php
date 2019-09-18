<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctype extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function doctypes(){
        $this->belongsToMany('App\Doc');
    }
}