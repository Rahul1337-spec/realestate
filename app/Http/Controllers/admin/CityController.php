<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\City;
use App\Agent;
use Auth;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    public function index(){
        $user = Auth::user();
        $agents = Agent::where('approval',0)->count();
        $city = DB::table('cities')->get()->ToArray();

        return view('admin.city')->with('city',$city)->with('user',$user)->with('agents',$agents);
    }
    public function cityadd(request $request){
        $agents = Agent::where('approval',0)->count();

        $data = $request->ToArray();
        $data_city = $request->get('city');
        // $type = Input::get('type');
        $valid = Validator::make($data, [
            'city' => ['required', 'string', 'max:255'],
        ]);
        // return back()->with('message','validated');
        // return dd($valid);

        if($valid->fails()){
           return back()->withErrors($valid);
       }
       else{
        $query = City::create([
            'name' => $data_city, 
        ])->save();
        $city = City::all();
        return back()->with('message','Added Successfuly')->with('agents',$agents)->with('city',$city);
    }
}
public function delete($id){
   $query = DB::table('cities')->where('id',$id)->delete();
   if($query){
    $agents = Agent::where('approval',0)->count();
    $city = City::all();
    return back()->with('message','Deleted')->with('agents',$agents)->with('city',$city);
}
else{
    $agents = Agent::where('approval',0)->count();
    $typedata = City::all();
    return back()->with('message','Error In Deleting')->with('agents',$agents)->with('city',$city);
}
}
}
