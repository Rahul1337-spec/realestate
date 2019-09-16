<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Image;
use App\Property;
use App\Agent;
use App\Type;

class UserPropertyController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        // $user = Auth::user();

        // if($user->hasAnyRole('user')){
        //     return view('user.property')->with('user',$user);
        // }
        // else{
        //     return route('login');
        // }

    }
    public function propertyshow($id){
        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        $property = Property::where('id',$id)->get();
        // return dd($property);
        $data = Property::join('image_property',function($join) use ($id){
            $join->on('image_property.property_id','=','properties.id')->where('property_id',$id);
        })->get()->ToArray();
        
        // return dd($data); 
        foreach($data as $da){
            $images[] = DB::table('image_property')
            ->join('images','images.id','=','image_property.image_id')
            ->where('image_property.image_id','LIKE',$da)
            ->get();
        }
        
        foreach($images as $image){
            $image_path[]=$image[0]->filename;
        }

        foreach($data as $da){
            $featured_img = $da['featured_img'];
            $image_id = $da['image_id'];
            $property_address = $da['property_address'];
            $property_state = $da['property_state'];
            $property_type = $da['property_type'];
            $property_name = $da['property_name'];
            $property_author = $da['property_author'];
            $property_rate = $da['property_rate'];
        }

        $image_data[] = Image::where('id',$image_id)->get()->ToArray();

        // return dd($image_data);

        return view('user.property',compact('user','featured_img','image_id','property_name','image_data','property_address','property_type','property_state','image_path','property_rate','city'));

    }

}
