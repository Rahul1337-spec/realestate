<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Role;
use App\Agent;
use App\Image;
use App\Property;
use App\Type;
use App\City;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // $user = Auth::user();

        // $agentdata = DB::table('agent_user')->where('user_id',$user->id)->get();
        // // $agents = DB::table('agents')->where('approval', 0)->get()->ToArray;
        // $agents = Agent::where('approval',0)->count();
        // $revoke = Agent::where('approval',1)->count();
        // return view('home')->with('user',$user)->with('agentdata',$agentdata)->with('agents',$agents)->with('revoke',$revoke);

    }
    public function callback(){
        $user = Auth::user();
        if($user){

            $city = DB::table('cities')->get()->ToArray();
            $property_slide = Property::all()->ToArray();
            
            // return dd($property_slide);
            // $prop_id = DB::table('properties')->get()->ToArray();
            // foreach($prop_id as $da)
            // {
            //     $propertyall[] = $da->id;
            // }
            // foreach ($propertyall as $key => $da) {
            //     $data[] = DB::table('properties')
            //     ->join('city_property','city_property.property_id','=','properties.id')
            //     ->where('properties.id',$da)
            //     ->get();
            // }
            // $dataall = $data->ToArray();
            // return dd($dataall);

            $property = DB::table('properties')->paginate(6);
            $property_count = Property::all()->count();
            $agentdata = DB::table('agent_user')->where('user_id',$user->id)->get();
            // $agents = DB::table('agents')->where('approval', 0)->get()->ToArray;
            $for_rent = DB::table('property_type')->where('type_id',3)->count();
            $for_buy = DB::table('property_type')->where('type_id',4)->count();
            $verified_count = DB::table('properties')->where('doc_verified',0)->count();
            $agents = Agent::where('approval',0)->count();
            $revoke = Agent::where('approval',1)->count();
            
            return view('home')->with('user',$user)->with('agentdata',$agentdata)->with('agents',$agents)->with('revoke',$revoke)->with('property',$property)->with('property_count',$property_count)->with('for_rent',$for_rent)->with('for_buy',$for_buy)->with('property_slide',$property_slide)->with('city',$city)->with('verify',$verified_count);
        }
        else{
            // $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR'])->ToArray();
            $arr_ip = geoip()->getLocation('203.187.238.129')->ToArray();

            $location_var = $arr_ip['city'];

            $city = DB::table('cities')->get()->ToArray();

            if($location_var == 'Vadodara'){
                $data = DB::table('cities')->where('name','Vadodara')->get()->ToArray();
                $city_id = $data[0]->id;
                
                $property = DB::table('cities')
                ->join('city_property','city_property.city_id','=','cities.id')
                ->join('properties','properties.id','=','property_id')
                ->join('asset_property','asset_property.property_id','=','properties.id')
                ->join('assets','assets.id','=','asset_id')
                ->join('property_type','property_type.property_id','=','properties.id')
                ->join('types','types.id','=','type_id')
                ->where('cities.id',$city_id)
                ->paginate(3);
                // return dd($property);
                $property_rent = DB::table('cities')
                ->join('city_property','city_property.city_id','=','cities.id')
                ->join('properties','properties.id','=','property_id')
                ->join('property_type','property_type.property_id','=','properties.id')
                ->where('cities.id',$city_id)
                ->get();

                $propertier_rent = $property_rent->where('type_id',4)->count();
                
                $propertier_buy = $property_rent->where('type_id',3)->count();
                
                $prop_rent = $property_rent->where('type_id',4);
                $prop_buy = $property_rent->where('type_id',3);

                $property_total = $property->count();

                return view('welcome')->with('property',$property)->with('city',$city)->with('rent',$propertier_rent)->with('buy',$propertier_buy)->with('prop_total',$property_total)->with('prop_rent',$prop_rent)->with('prop_buy',$prop_buy);    
            }
            
        }
    }
    public function searchcity(request $request){

        $city = DB::table('cities')->get()->ToArray();

        $city_data = DB::table('cities')->where('id',$request->select_city)->get()->ToArray();
        
        $data = DB::table('cities')->where('name',$city_data[0]->name)->get()->ToArray();
        $city_id = $data[0]->id;

        $property = DB::table('cities')
        ->join('city_property','city_property.city_id','=','cities.id')
        ->join('properties','properties.id','=','property_id')
        ->join('property_type','property_type.property_id','=','properties.id')
        ->join('types','types.id','=','type_id')
        ->where('cities.id',$city_id)
        ->paginate(6);

        
        $property_rent = DB::table('cities')
        ->join('city_property','city_property.city_id','=','cities.id')
        ->join('properties','properties.id','=','property_id')
        ->join('property_type','property_type.property_id','=','properties.id')
        ->where('cities.id',$city_id)
        ->get();

        $propertier_rent = $property_rent->where('type_id',4)->count();
        $propertier_buy = $property_rent->where('type_id',3)->count();

        $prop_rent = $property_rent->where('type_id',4);
        $prop_buy = $property_rent->where('type_id',3);

        $property_total = $property->count();
        // return dd($property);
        if($property->isEmpty()):
            $property_null = DB::table('cities')->where('id',$request->select_city)->get();
            return view('welcome')->with('property',$property)->with('city',$city)->with('rent',$propertier_rent)->with('buy',$propertier_buy)->with('prop_total',$property_total)->with('property_null',$property_null)->with('prop_rent',$prop_rent)->with('prop_buy',$prop_buy);
        endif;
        $property_null=NULL;
        return view('welcome')->with('property',$property)->with('city',$city)->with('rent',$propertier_rent)->with('buy',$propertier_buy)->with('prop_total',$property_total)->with('property_null',$property_null)->with('prop_rent',$prop_rent)->with('prop_buy',$prop_buy);    
        
    }
}