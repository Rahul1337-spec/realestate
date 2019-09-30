<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Image;
use App\Agent;
use App\Property;
use App\User;
use App\City;
use App\Type;
use Illuminate\Support\Facades\Input;
use App\Support\Collection;

class GuestPropertyController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user){
            return "registered user";
        }else{
            return "Guest user";
        }
        return view('guest.property');
    }    
    
    public function guestsearch(request $request){
        // return "Property";
        $input = Input::all();
        $featuredprop = DB::table('properties')->paginate(2);
        // return dd($input);
        if($request->city == 'Any'):
            $search = $request->all();
            $city_data = $request->city;
            $city = DB::table('cities')->get()->ToArray();
            // $property = Property::all()->ToArray();
            // return dd($property);

            if(isset($input['type']) == 'Rent' or isset($input['type']) == 'Buy'):
                $property = DB::table('types')
            ->join('property_type','property_type.type_id','=','types.id')
            ->join('properties','properties.id','=','property_id')
            ->join('asset_property','asset_property.property_id','=','properties.id')
            ->join('assets','assets.id','=','asset_id')
            ->where('types.name',$input['type'])
            ->get();
            // return dd($property);
        endif;


        if(isset($input['min_rate']) && isset($input['max_rate'])):
            $min = $input['min_rate'];
        $max = $input['max_rate'];
        $search = $property->whereBetween('property_rate',[$min,$max]);
    endif;
    if(isset($input['check']) && $input['check'] == 0):
        $search = $property->where('doc_verified','=',0);
    endif;
    if(isset($input['check']) && $input['check'] == 1):
        $search = $property->where('doc_verified','=',1);    
    endif;
    // return dd($search);

    $property_data = $search->paginate(10);

    return view('guest.property',compact('property_data','city','featuredprop'));

endif;

if($request->city != 'Any'):

    if(isset($input['city'])):
        $city = DB::table('cities')->get()->ToArray();
        $property = DB::table('properties')
        ->join('property_type','property_type.property_id','=','properties.id')
        ->join('types','types.id','=','type_id')
        ->join('asset_property','asset_property.property_id','=','properties.id')
        ->join('assets','assets.id','=','asset_id')
        ->where('property_state',$input['city'])
        ->get();
    endif;

    // return dd($property);
    
    if(isset($input['min_rate']) && isset($input['max_rate'])):
        $min = $input['min_rate'];
    $max = $input['max_rate'];
    $search = $property->whereBetween('property_rate',[$min,$max]);
endif;
if(isset($input['BHK'])):
    $bhk = $input['BHK'];
        // return dd($bhk);
    $search = $property->where('name','=',$bhk);
endif;

if(isset($input['check']) && $input['check'] == 0):
    $search = $property->where('doc_verified','=',0);
endif;

if(isset($input['check']) && $input['check'] == 1):
    $search = $property->where('doc_verified','=',1);
endif;

// return dd($search);

$property_data = $search->paginate(10);
            // return dd($data);
return view('guest.property',compact('property_data','city','featuredprop'));

endif;

}
}
