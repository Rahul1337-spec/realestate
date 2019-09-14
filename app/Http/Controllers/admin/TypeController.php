<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use App\Agent;
use App\Type;

class TypeController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    public function index(){
        $user = Auth::user();
        $agents = Agent::where('approval',0)->count();
        $typedata = Type::all();

        return view('admin.type')->with('user',$user)->with('agents',$agents)->with('typedata',$typedata);
    }

    public function typeinsert(request $request){
     $agents = Agent::where('approval',0)->count();
     $data = $request->ToArray();
     $data_type = $request->get('type');
        // $type = Input::get('type');
     $valid = Validator::make($data, [
        'type' => ['required', 'string', 'max:255'],
    ]);
        // return back()->with('message','validated');
        // return dd($valid);

     if($valid->fails()){
         return back()->withErrors($valid);
     }
     else{
        $query = Type::create([
            'name' => $data_type, 
        ])->save();
        $typedata = Type::all();
        return back()->with('message','Added Successfuly')->with('agents',$agents)->with('typedata',$typedata);
    }

}
public function delete($id){
    $query = DB::table('types')->where('id',$id)->delete();
    if($query){
        $agents = Agent::where('approval',0)->count();
        $typedata = Type::all();
        return back()->with('message','Deleted')->with('agents',$agents)->with('typedata',$typedata);
    }
    else{
        $agents = Agent::where('approval',0)->count();
        $typedata = Type::all();
        return back()->with('message','Error In Deleting')->with('agents',$agents)->with('typedata',$typedata);
    }
}
}
