<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Agent;

class AgentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth'=>'verified']);
    }

    public function index(){

    }

    public function regpage(){
       $user = Auth::user();
       $city = DB::table('cities')->get()->ToArray();
       if(Auth::user()->iso_code != 'IN'){
           $agentdata = DB::table('agent_user')->where('user_id',$user->id)->get();

           return view('user.regagent')->with('user',$user)->with('agentdata',$agentdata)->with('city',$city);
       }
       else{
        return back();
    }
}

public function register(Request $request){
        // return dd($request);
    $data = request()->post();
        // return dd($city);
    $user = Auth::user();
        // // return dd($user);
    $name = $user->name;
        // // return dd($name);
    $UserID = User::where('name',$name)->first();
        // // return dd($UserID);
    $subscriber = Agent::create([
        'agent_name' => $data['agent_name'],
        'agent_address' => $data['agent_address'],
        'locality' => $data['locality'],
        'agent_city' => $data['city'],
    ]);
    

        // return dd($subscriber);
    $subscriber->useragent()->attach($UserID);
    $subscriber->save();
        // return dd($user->id);
    
    $query = DB::table('users')->where('id',$user->id)->update(['Applied_agent' => 1]);
    
    return back()->with('success','Sent Data For Approval Thank You');
}
}
