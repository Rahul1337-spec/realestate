<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;

class Property extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'property_name',
        'property_type',
        'property_author',
        'property_address',
        'property_country',
        'property_state',
        'property_rate',
        'asset',
        'sqft',
        'uncompress_img',
        'featured_img',
    ];
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    public function images(){
        return $this->hasMany('App\Image');
    }
    // public function allimg(){
    //     return $this->belongsTo('App\Image');
    // }
    public function agents(){
        return $this->belongsToMany('App\Agent');
    }
    public function type(){
        return $this->belongsToMany('App\Type');
    }
    public function cities(){
        return $this->belongsToMany('App\City');
    }
    public function asset(){
        return $this->belongsToMany('App\Asset');
    }
    public function payuid(){
        $this->belongsToMany('\vendor\tzsk\payu\src\Model\PayuPayment');
    }
    public function enquireprop(){
        $this->belongsToMany('App\Enquiry');
    }
    public function document(){
        $this->belongsToMany('App\Doc');
    }
    public function userproperty(){
        return $this->belongsToMany('App\User');
    }
    // public function index(request $request){
    //     $user = Auth::user();
    //     if($user->hasAnyRole('user')){
    //         return view('user.property')->with('user',$user);
    //     }
    //     else{
    //         return view('login');
    //     }
    // }
}
