<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\AgentConfirmMailable;
use Illuminate\Support\Facades\Input;
use Mail;
use App\User;
use App\Agent;
use App\Role;
use App\Property;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }
    public function index(){
        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        $property = Property::all()->count();
        $data = DB::table('agents')->where('approval',0)->paginate(5);
        $agents = Agent::where('approval',0)->count();
        return view('admin.approval')->with('user',$user)->with('data',$data)->with('agents',$agents)->with('city',$city);
    }
    public function searchar(){
        $c = 0;
        $q = Input::get('q');
        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        $agents = Agent::where('approval',$c)->count();
        $data = DB::table('agents')->whereNotIn('approval',[0])->orWhere('id','LIKE','%'.$q.'%')->orWhere('locality','LIKE','%'.$q.'%')->orWhere('agent_city','LIKE','%'.$q.'%')->where('agent_name','LIKE','%'.$q.'%')->paginate(5);

        return view('admin.approval')->with('user',$user)->with('agents',$agents)->with('data',$data)->with('city',$city);
    }

    public function unapprove(){
        $user = Auth::user();
        $unapprovaldata = DB::table('agents')->where('approval',1)->paginate(5);
        $city = DB::table('cities')->get()->ToArray();
        $agents = Agent::where('approval',0)->count();
        return view('admin.unapprove')->with('user',$user)->with('data',$unapprovaldata)->with('agents',$agents)->with('city',$city);
    }

    public function approvalvalid($id){
        // return dd($id);
        $data = DB::table('agent_user')->where('agent_id',$id)->get()->ToArray();
        $city = DB::table('cities')->get()->ToArray();
        
        foreach($data as $datas){
            $userid = $datas->user_id;
            $agentid = $datas->agent_id;
        }

        $UserRole = Role::where('name','agent')->first();

        $result = DB::insert("insert into role_user (user_id,role_id) values ('{$userid}','{$UserRole->id}')");
        if($result){
            $data3 = DB::table('users')->where('id',$userid)->get()->ToArray();
            $query = DB::table('users')->where('id',$userid)->update(['isAgent'=> 1]);
            $query = DB::table('agents')->where('id',$agentid)->update(['approval'=> 1]);


            /*Mail Sending*/
            $datasend = DB::table('agent_user')->where('agent_id',$id)->get()->ToArray();

            foreach($datasend as $datas){
             $user_id = $datas->user_id;
         }
         $string = DB::table('users')->where('id',$user_id)->get()->ToArray();
         foreach($string as $strings){
            $email = $strings->email; 
        }
        try{
            \Mail::to($email)->send(new AgentConfirmMailable($string));
        }
        catch(\expection $e){

        }
        /*Mail Sending end*/

        return back()->with('success','Agent Approved');
    }
    else{
        return back()->with('error','Error in Approval');
    }


}

public function unapprovevalid($id){

    $data = DB::table('agent_user')->where('agent_id',$id)->get()->ToArray();

    foreach($data as $datas){
        $userid = $datas->user_id;
        $agentid = $datas->agent_id;
    }

    $UserRole = Role::where('name','agent')->first();

    $result = DB::table('role_user')->where('user_id',$userid)->where('role_id',$UserRole->id)->delete();


    if($result){
        $data3 = DB::table('users')->where('id',$userid)->get()->ToArray();
        $query = DB::table('users')->where('id',$userid)->update(['isAgent'=> 0]);
        $query = DB::table('agents')->where('id',$agentid)->update(['approval'=> 0]);
        $query = DB::table('users')->where('id',$userid)->update(['Applied_agent'=>0]);
            // $query = DB::table('agent')->where('id',$agentid)->delete();
            // $query = DB::table('agent_user')->where('user_id',$userid)->delete();
        return back()->with('success','Agent UnApproved');
    }
    else{
        return back()->with('error','Error in UnApproval');
    }
}
}
