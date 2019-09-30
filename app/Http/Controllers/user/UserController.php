<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Agent;
use App\Type;
use App\Property;
use App\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        if($user->hasAnyRole('user')){
            return view('user.account')->with('user',$user)->with('city',$city);
        }
        else{
            return route('login');
        }
    }
    public function agentlist(){
        $agent = Agent::Where('approval',1)->get();
        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        return view('user.agentexplorer')->with('agent',$agent)->with('user',$user)->with('city',$city);
    }

    public function propertypage(){
        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        $property = DB::table('properties')->paginate(10);
        $featuredprop = DB::table('properties')->paginate(2);
        // $property = Property::all()->ToArray()->paginate(10);
        return view('user.propertyexplorer')->with('user',$user)->with('property',$property)->with('featuredprop',$featuredprop)->with('city',$city);
    }
    
    public function propertysearch(request $request){
        $user = Auth::user();

        $city = DB::table('cities')->get()->ToArray();
        $featuredprop = DB::table('properties')->paginate(2);

        $input = Input::all();
        // return dd($input);
        if(isset($input['type'])){
            $type = Type::where('name',$input['type'])->get()->ToArray();          
            $type_id = $type[0]['id'];
        }

        $city = DB::table('cities')->get()->ToArray();

        $property = collect(DB::table('properties')
            ->join('property_type','property_type.property_id','=','properties.id')
            ->where('properties.property_state',$input['city'])
            ->get());
        // return dd($property);
        // return dd($bhk_3);
        // $search = $property->where('property_rate','<','6000');
        // return dd($search);
        // if($request->has('city')):
        //     $property->where('property_state','=',$input['city']);
        // endif;
    //     if($request->has('min_price') && $request->has('max_price')):
    //         $property->whereBetween('property_rate',[$request->min_price,$request->max_price]);
    // endif;

        if(isset($input['city'])):
            $search = $property->where('property_state', '=', $input['city']);
        endif;
        if(isset($min) && isset($max)):
         $max = $input['max_price'];
     $min = $input['min_price'];       
     $search = $property->whereBetween('property_rate',[$min,$max]);   
 endif;
 if(isset($type_id)):
    $search = $property->where('type_id','=',$type_id);
endif;
if(isset($input['BHK'])):
    $bhk = $input['BHK'];
    $search = $property->where('asset',$bhk);
endif;
// if(isset($input['3_BHK'])):
//     $bhk_3 = $input['3_BHK'];
//     $search = $property->where('asset',$bhk_3);
// endif;
// return dd($search);
$data = $search->paginate(10);
    // return dd($data);

return view('user.propertyexplorer')->with('user',$user)->with('property',$data)->with('featuredprop',$featuredprop)->with('city',$city);
}
public function search(){
 $data = Input::get('q');
 $user = Auth::user();
 $city = DB::table('cities')->get()->ToArray();
 $featuredprop = DB::table('properties')->paginate(2);
 $property = Property::where('property_name','LIKE','%'.$data.'%')->orWhere('property_type','LIKE','%'.$data.'%')->orWhere('property_state','LIKE','%'.$data.'%')->paginate(10);
 return view('user.propertyexplorer')->with('user',$user)->with('property',$property)->with('featuredprop',$featuredprop)->with('city',$city);
}
}

