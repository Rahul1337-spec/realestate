<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\User;
use App\Role;
use App\Agent;
use App\Image;
use App\Property;
use App\Type;

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

            $property_slide = Property::all()->ToArray();
            $property = DB::table('properties')->paginate(6);
            $property_count = Property::all()->count();
            $agentdata = DB::table('agent_user')->where('user_id',$user->id)->get();
            // $agents = DB::table('agents')->where('approval', 0)->get()->ToArray;
            $for_rent = DB::table('property_type')->where('type_id',3)->count();
            $for_buy = DB::table('property_type')->where('type_id',4)->count();

            $agents = Agent::where('approval',0)->count();
            $revoke = Agent::where('approval',1)->count();
            return view('home')->with('user',$user)->with('agentdata',$agentdata)->with('agents',$agents)->with('revoke',$revoke)->with('property',$property)->with('property_count',$property_count)->with('for_rent',$for_rent)->with('for_buy',$for_buy)->with('property_slide',$property_slide);
        }
        else{

            $property = DB::table('properties')->paginate(6);
            
            return view('welcome')->with('property',$property);
        }
    }
}