<?php

namespace App\Http\Controllers\agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;
use App\Agent;
use App\Type;
use App\Property;
use App\Image;
use App\City;

class PropertyController extends Controller
{
    public function __construct(){
        $this->middleware('auth.agent');
    }    
    public function index(){
        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        $userid = $user->id;
        $agent = User::join('agent_user', function ($join) use ($userid) {
            $join->on('users.id', '=', 'agent_user.user_id')->where('user_id',$userid);
        })->get()->pluck('agent_id');  

        // foreach($agent as $data){
        //     $agent_id = $data->request['agent_id'];
        // }
        // return dd($agent);
        if($user->hasAnyRole('agent')){
            return view('agent.property')->with('user',$user)->with('agentdata',$agent)->with('city',$city);
        }
        else{
            return route('login');
        }
    }
    
    // public function PostProperty(Request $request){
    //     $data = $request::all();

    //     $data = Property::Create([
    //         $property_name => $request->['property_name'],
    //         $property_address => $request->['property_address'],
    //         $property_rate => $request->['property_rate'],
    //         $property_author => $request->['property_author'],
    //         $property_type => $request->['property_type'],
    //         $property_asset => $request->['property_asset']
    //     ]);

    //     if(!empty($tag)){ 
    //         $data->attach($tag);
    //         return $data;
    //     }
    //     else{
    //         return 'Please Select a Tag To add Property';
    //     }
    // }

    public function PostProperty(request $request){
        // return dd($request);
        /*--------------Data Validation before pushing forward--------------*/ 
        if($request->hasFile('image') && $request->hasFile('featured')){
            $data = $request->ToArray();
            $valid = Validator::make($data,[
                'property_name' => ['required','string','max:255'],
                'property_address' => ['required','string','max:255'],
                'property_type' => 'required|in:old,new',
                'Agent_name' => ['required','string'],
                'property_rate' => ['required','integer'],
                'country' => ['required'],
                'state' => ['required'],
                'type' => ['required'],
                'featured' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            /*------------------------------------------------------------------*/
            /*---------------If Valid Push forward the data---------------------*/ 
            if($valid){
                $type = DB::Table('types')->where('name',$request->type)->get();
                $state = $request->state;
                $stateattach = DB::table('cities')->where('name',$state)->get()->ToArray();

                $state_id = $stateattach[0]->id;

                foreach($type as $data){
                    $type_id = $data->id;
                }

                $agentdata = DB::table('agents')->where('id',$request->Agent_name)->get();
                foreach($agentdata as $data){
                    $agent_id = $data->id;
                    $agent_name = $data->agent_name;
                }

                $featured_image = $request->featured;
                // return dd($request);
                $name = $featured_image->getClientOriginalName();
                    // return dd($name);
                $actual_name = pathinfo($name,PATHINFO_FILENAME);
                $original_name = $actual_name;
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                    // return dd($actual_name);
                $i = 1;
                while(file_exists('images/'.$actual_name.".".$extension))
                {           
                    $actual_name = (string)$original_name.$i;
                    $name = $actual_name.".".$extension;
                    $i++;
                }
                $destinationPath = public_path('images');
                    // return dd($destinationPath);
                $featured_image->move($destinationPath, $name)->getRealPath();
                // $featured_path = $destinationPath.'\\'.$name;

                $postdata = Property::create([
                    'property_name' => $request->property_name,
                    'property_address' => $request->property_address,
                    'property_type' => $request->property_type,
                    'property_author' => $agent_name,
                    'property_country' => $request->country,
                    'property_state' => $request->state,
                    'property_rate' => $request->property_rate,
                    'featured_img' => $name
                ]);

                $postdata->agents()->attach($agent_id);
                $postdata->type()->attach($type_id);
                $postdata->cities()->attach($state_id);
                $postdata->save();

                /*------------Finding the Buy and Rent Types to add up for agent---------------*/
                $type_check = $request->type;
                // return dd($type_check);
                $properties_type = DB::table('agent_property')->where('agent_id',$agent_id)->get();
                $prop_check = DB::table('types')->where('name',$type_check)->get();


                foreach($properties_type as $prop){
                    $data = DB::table('property_type')->where('property_id',$prop->property_id)->get();
                }
                $for_rent = '';
                $for_buy = '';

                foreach($data as $data1){
                    if($prop_check[0]->id == '3'){
                        $for_rent = DB::table('property_type')->where('type_id',3)->count();
                    }elseif($prop_check[0]->id == '4'){
                        $for_buy = DB::table('property_type')->where('type_id',4)->count();
                    }
                    else{}
                }
            
            /*------------------------------------------------------------------------------*/ 

            $property_id = DB::table('properties')->where('id',$postdata->id)->get()->ToArray();
            /*adding property counts to agents table*/
            $count_data = DB::table('agents')->where('id',$agent_id)->get();
            $count = DB::table('agent_property')->where('agent_id',$agent_id)->count();

            $query = DB::table('agents')->where('id',$agent_id)->update(['property_counts'=>$count]);
            if(!$for_rent == ''){
                $query = DB::table('agents')->where('id',$agent_id)->update(['for_rent'=>$for_rent]);
            }
            elseif(!$for_buy == ''){
                $query = DB::table('agents')->where('id',$agent_id)->update(['for_buy'=>$for_buy]);
            }else{}
            /*--------------------------------------*/ 
                // return dd($property_id);
            if($property_id){
                foreach($property_id as $data){
                    $prop = $data->id;
                }
                    // $image = $request->file('image');
                foreach($request->file('image') as $images){
                    $image = $images;
                    // return dd($image);
                    $name = $image->getClientOriginalName();
                    // return dd($name);
                    $actual_name = pathinfo($name,PATHINFO_FILENAME);
                    $original_name = $actual_name;
                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    // return dd($actual_name);
                    $i = 1;
                    while(file_exists('images/'.$actual_name.".".$extension))
                    {           
                        $actual_name = (string)$original_name.$i;
                        $name = $actual_name.".".$extension;
                        $i++;
                    }
                    $destinationPath = public_path('images');
                    // return dd($destinationPath);
                    $image->move($destinationPath, $name)->getRealPath();
                    $path = $destinationPath.'\\'.$name;

                    $property_image = Image::create([
                        'filename' => $name,
                        'path' => $path
                    ]);
                    $property_image->propertyimage()->attach($prop);
                }    
                return back()->with('message','Upload Successful');
            }
            else{
                return back()->with('error','error while storing');
            }
                // return dd($prop);
        }
        else{ 
            return back()->withErrors($valid);
        }
    }else{
     return back()->with('error','please upload property image');
 }
}
Public function PublicFeed(Request $request){

}
}
