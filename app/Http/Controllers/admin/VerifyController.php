<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Property;
use App\Agent;
use Doc;

class VerifyController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }

    public function index(){

        $user = Auth::user();
        $agents = Agent::where('approval',0)->count();

        $property_data = DB::table('properties')->get()->ToArray();
        
        $da = 78;

        $property_docs[] = collect(DB::table('doc_property')
            ->join('properties','properties.id','=','property_id')
            ->where('property_id',78)
            ->get());
        // foreach($property_data as $da){

        // }

        return dd($property_docs);
        // $property_data = DB::table('doc_property')
        // ->join('properties','properties.id','=','doc_property.property_id')
        // ->join('docs','docs.id','=','doc_id')
        // ->get();

        // ->join('doc_property','doc_property.property_id','=','properties.id')
        // ->get();
        
        // return dd($property_data);


        return view('admin.verify',compact('property_data','user','agents'));
    }

    public function verifydoc(request $request){
        return dd($request);
    }
}
