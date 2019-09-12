<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'agent_name',
        'agent_address',
        'locality',
        'agent_city',
    ];
    public function useragent(){
      return $this->belongsToMany('App\User');
  }
  public function property(){
    $this->hasMany('App\Property');
}
}
