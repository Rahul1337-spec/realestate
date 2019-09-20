<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Property;
use App\Image;
use App\Type;
use App\Agent;
use App\City; 
use File;

class ManageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function manage(){

        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();

        $property = DB::table('users')
        ->join('property_user','property_user.user_id','=','users.id')
        ->join('properties','properties.id','=','property_id')
        ->where('users.id','LIKE',$user->id)
        ->get();

        return view('user.manage')->with('user',$user)->with('property',$property)->with('city',$city);
    }
    public function clients($id){
        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        
        $data_enquiry = DB::table('enquiry_property')
        ->join('enquiries','enquiries.id','=','enquiry_property.enquiry_id')
        ->where('enquiry_property.property_id',$id)
        ->get();

        return view('user.clients')->with('user',$user)->with('clients',$data_enquiry)->with('city',$city);
    }

    public function delete($id){
        if($id){

            $property = DB::table('properties')
            ->join('property_user','property_user.property_id','=','properties.id')
            ->join('city_property','city_property.property_id','=','properties.id')
            ->join('image_property','image_property.property_id','=','properties.id')
            ->join('images','images.id','=','image_id')
            ->where('properties.id',$id)
            ->get();

            foreach($property as $da){
                $query = File::delete('images/' . $da->filename);
                $query = File::delete('images/' . $da->featured_img);
                $query = DB::table('images')->where('id',$da->image_id)->delete();
                $query = DB::table('image_property')->where('property_id',$da->property_id)->delete();
            }

            $query = DB::table('city_property')->where('city_id',$property[0]->city_id)->delete();
            $query = DB::table('property_user')->where('property_id',$property[0]->property_id)->delete();
            $query = DB::table('property_type')->where('property_id',$property[0]->property_id)->delete();
            $query = DB::table('properties')->where('id',$property[0]->property_id)->delete();
            /*---------------Update new counts for deleted data---------------------------*/

            if($query){
                return back()->with('message','property removed');
            }else{
                return back()->with('message','error in property removal');
            }

        }else{
            return back()->with('message','Property not Found');
        }

    }
}
