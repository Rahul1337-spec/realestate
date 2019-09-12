<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Role;
use App\User;
use App\Property;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }

    public function index(){
        $user = Auth::user();    
        if($user->hasAnyRole('admin')){
            return view('admin.account')->with('user',$user);
        }
        else{
            return 'Admin Area';
        }
    }

    public function manageproperty(){
        $user = Auth::user();
        if($user->hasAnyRole('admin')){
            $properties = DB::table('properties')->get()->ToArray();
            return view('admin.property')->with('property',$properties);
        }
    }

    public function searchprop(){
        $q = Input::get('q');
        $properties = DB::table('properties')->where('property_name','LIKE','%'.$q.'%')->orWhere('property_address','LIKE','%'.$q.'%')->orWhere('property_state','LIKE','%'.$q.'%')->orWhere('property_author','LIKE','%'.$q.'%')->get()->ToArray();
        return view('admin.property')->with('property',$properties);
    }

    public function type(request $request){
        return dd($request);
    }
}
