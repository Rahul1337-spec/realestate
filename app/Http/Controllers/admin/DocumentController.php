<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Agent;
use App\Doctype;


class DocumentController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }

    public function index(){
        $user = Auth::user();
        $agents = Agent::where('approval',0)->count();
        $typedata = Doctype::all();
        $city = DB::table('cities')->get()->ToArray();

        return view('admin.document',compact('user','agents','typedata','city'));
    }

    public function addtype(request $request){
        $agents = Agent::where('approval',0)->count();
        $data = $request->ToArray();
        $doc_type = $request->get('docstype');
        $city = DB::table('cities')->get()->ToArray();
        // $type = Input::get('type');
        $valid = Validator::make($data, [
            'docstype' => ['required', 'string', 'max:255'],
        ]);
        // return back()->with('message','validated');
        // return dd($valid);

        if($valid->fails()){
           return back()->withErrors($valid);
       }
       else{
        $query = Doctype::create([
            'name' => $doc_type, 
        ])->save();
        $typedata = Doctype::all();
        
        return back()->with('message','Added Successfuly')->with('agents',$agents)->with('typedata',$typedata)->with('city',$city);
    }
}

public function delete($id){
    $query = DB::table('doctypes')->where('id',$id)->delete();
    if($query){
        $agents = Agent::where('approval',0)->count();
        $typedata = Doctype::all();
        $city = DB::table('cities')->get()->ToArray();
        return back()->with('message','Deleted')->with('agents',$agents)->with('typedata',$typedata)->with('city',$city);
    }
    else{
        $agents = Agent::where('approval',0)->count();
        $typedata = Doctype::all();
        $city = DB::table('cities')->get()->ToArray();
        return back()->with('message','Error In Deleting')->with('agents',$agents)->with('typedata',$typedata)->with('city',$city);
    }
}
}
