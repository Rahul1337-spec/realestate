<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Asset;
use App\User;
use App\Agent;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Property;

class AssetsController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }

    public function index(){
     $user = Auth::user();
     $agents = Agent::where('approval',0)->count();
     $city = DB::table('cities')->get()->ToArray();
     $typedata = Asset::all();

     return view('admin.asset',compact('user','agents','typedata','city'));
 }

 public function assetadd(request $request){

    $agents = Agent::where('approval',0)->count();
    $data = $request->ToArray();
    $data_type = $request->get('asset');
        // $type = Input::get('type');
    $valid = Validator::make($data, [
        'asset' => ['required', 'string', 'max:255'],
    ]);
        // return back()->with('message','validated');
        // return dd($valid);

    if($valid->fails()){
       return back()->withErrors($valid);
   }
   else{
    $query = Asset::create([
        'name' => $data_type, 
    ])->save();
    $typedata = Asset::all();
    return back()->with('message','Added Successfuly')->with('agents',$agents)->with('typedata',$typedata);
}
}
public function delete($id){
    $query = DB::table('assets')->where('id',$id)->delete();
    if($query){
        $agents = Agent::where('approval',0)->count();
        $asset = Asset::all();
        return back()->with('message','Deleted')->with('agents',$agents)->with('asset',$asset);
    }
    else{
        $agents = Agent::where('approval',0)->count();
        $asset = Asset::all();
        return back()->with('message','Error In Deleting')->with('agents',$agents)->with('asset',$asset);
    }
}

}
