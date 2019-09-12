<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use App\User;


class UserLoginProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasrole',function($expression){
            if(Auth::user()){
                if(Auth::user()->hasAnyRole($expression)){
                    return true;
                }
                return false;
            }
        });
    }
}
