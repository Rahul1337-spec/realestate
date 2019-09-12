<?php

namespace App\Http\Controllers\admin\property;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Role;
use User;

class PropertyController extends Controller
{
    public function __contruct(){
        $user = Auth::user();
        if(!$user == ''){
            return route('login');
        }
        
    }
    public function index()
    {
        $user = Auth::user();
        if($user->hasAnyRole('admin')){
            return view('admin.account')->with('user',$user);
        }
        else{
            return route('login');
        }
    }
}
