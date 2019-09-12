<?php

namespace App\Http\Controllers\user\form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class FormController extends Controller
{
    public function __construct(){
        $this->middleware('auth.user');
    }

    public function index(){
        $user = Auth::user();
        if($user->hasAnyRole('user')){
            return view('user.form');
        }
        else
        {
            return route('login');
        }
    }

    public function ContactSaveData(Request $request){

    }
}
