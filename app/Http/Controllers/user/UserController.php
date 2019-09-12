<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Agent;
use App\Property;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        if($user->hasAnyRole('user')){
            return view('user.account')->with('user',$user);
        }
        else{
            return route('login');
        }
    }
    public function agentlist(){
        $agent = Agent::all();
        $user = Auth::user();
        
        return view('user.agentexplorer')->with('agent',$agent)->with('user',$user);
    }

    public function propertypage(){
        $user = Auth::user();
        $property = DB::table('properties')->paginate(10);
        $featuredprop = DB::table('properties')->paginate(2);
        // $property = Property::all()->ToArray()->paginate(10);
        return view('user.propertyexplorer')->with('user',$user)->with('property',$property)->with('featuredprop',$featuredprop);
    }

    public function search(){
     $data = Input::get('q');
     $user = Auth::user();
     $featuredprop = DB::table('properties')->paginate(2);
     $property = Property::where('property_name','LIKE','%'.$data.'%')->orWhere('property_type','LIKE','%'.$data.'%')->orWhere('property_state','LIKE','%'.$data.'%')->paginate(10);
     return view('user.propertyexplorer')->with('user',$user)->with('property',$property)->with('featuredprop',$featuredprop);
 }
}

