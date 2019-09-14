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
            $property = DB::table('properties')->paginate(6);
            $property_count = Property::all()->count();
            $agentdata = DB::table('agent_user')->where('user_id',$user->id)->get();
            // $agents = DB::table('agents')->where('approval', 0)->get()->ToArray;
            $for_rent = DB::table('property_type')->where('type_id',3)->count();
            $for_buy = DB::table('property_type')->where('type_id',4)->count();

            $agents = Agent::where('approval',0)->count();
            $revoke = Agent::where('approval',1)->count();
            return view('home')->with('user',$user)->with('agentdata',$agentdata)->with('agents',$agents)->with('revoke',$revoke)->with('property',$property)->with('property_count',$property_count)->with('for_rent',$for_rent)->with('for_buy',$for_buy)->with('property_slide',$property_slide)->with('city',$city);
        }
        else{
            $arr_ip = geoip()->getLocation('203.187.238.129')->ToArray();
            $location_var = $arr_ip['city'];
            $city = DB::table('cities')->get()->ToArray();

            if($location_var == 'Vadodara'){
                $data = DB::table('cities')->where('name','Vadodara')->get()->ToArray();
                $city_id = $data[0]->id;
                
                $property = DB::table('cities')
                ->join('city_property','city_property.city_id','=','cities.id')
                ->join('properties','properties.id','=','property_id')
                ->where('cities.id',$city_id)
                ->paginate(6);
                
                return view('welcome')->with('property',$property)->with('city',$city);    
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
        ->where('cities.id',$city_id)
        ->paginate(6);

        return view('welcome')->with('property',$property)->with('city',$city);    
        
    }
}