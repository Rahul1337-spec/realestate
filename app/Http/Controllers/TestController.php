<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\AgentConfirmMailable;
use App\Mail\ContactInfoMailable;
use Mail;
use Auth;
use App\User;
use App\Role;
use App\Agent;
use App\Property;
use App\Image;
use App\City;
use App\Type;

class TestController extends Controller
{

    public function index(){
        $property_id = 2;
        /*Mail Sending*/
        
        $property_agent = DB::table('properties')
        ->join('agent_property','agent_property.property_id','=','properties.id')
        ->join('agent_user','agent_user.agent_id','=','agent_property.agent_id')
        ->join('users','users.id','=','agent_user.user_id')
        ->where('properties.id',$property_id)
        ->get();
        
        $email = $property_agent[0]->email;

        
        
        try{
            \Mail::to($email)->send(new ContactInfoMailable($property_agent));
        }
        catch(\expection $e){

        }

     // $phoneno = '9638246271';
     // $data = [
     //            'phone' => '91'.$phoneno, // Receivers phone
     //            'body' => 'Hello, Andrew! 2 for 1', // Message
     //        ];
     //        $json = json_encode($data); // Encode data to JSON
     //        // URL for request POST /message
     //        $url = 'https://eu68.chat-api.com/instance64993/sendMessage?token=tfdzfg3cvw5nqk2h';

     //        // Make a POST request

     //        $options = stream_context_create(['http' => [
     //            'method'  => 'POST',
     //            'header'  => 'Content-type: application/json',
     //            'content' => $json
     //        ]
     //    ]);
     //        // Send a request
     //        $result = file_get_contents($url, false, $options);

        // return view('testpage');
        // $city_id = 1;
        // $city = City::join('city_property',function ($join) use ($city_id){
        //     $join->on('cities.id','=','city_property.city_id')->where('city_id',$city_id);
        //     $join->on('properties.id','=','city_property.property_id');
        // })->get();



        /*----Join multiple table using a Pivot Table Connector----*/

        // $data = User::join('role_user', function ($join) {
        //     $join->on('users.id', '=', 'role_user.role_id')->where('role_id','3');
        // })->get();      

        // $UserRole = Role::where('name','agent')->first();
        // $UserID = User::where('name','tester')->first();

        // return dd($UserID);

        // $data = ([
        //     'name'=>'test',
        //     'local'=>'asdas',
        //     'agent_address'=>'asdasd'
        // ]);
        // return dd($data);
        // $subscriber = Agent::create([
        //     'agent_name' => $data['name'],
        //     'locality' => $data['local'],
        //     'agent_address' => $data['agent_address'],
        // ]);

        // $subscriber->useragent()->attach($UserID);
        // return $subscriber;

        // return $subscriber;
        // $data2 = Agent::join('')
        // return dd($data);

        // $UserRole = Role::where('name','agent')->first();

        // $data = User::join('agent_user', function ($join) {
        //     $join->on('users.id', '=', 'agent_user.user_id')->where('user_id','2');
        // })->get()->ToArray(); 

        // foreach($data as $datas){
        //     $id = $datas['user_id'];
        //     $id2 = $datas['agent_id'];
        // }
        // // return dd($id2);

        // $data2 = User::where('id',$id)->get()->ToArray();

        // DB::insert("insert into role_user (user_id,role_id) values ('{$id}','{$UserRole->id}')");


        // $user = Auth::user();

        // $data = DB::table('agent_user')->where('user_id',$user->id)->get();

        // if(!empty($data)){
        //     return 'entry is there';
        // }
        // else
        // {

        // }

    //     $id = 40;

    //     $data = DB::table('agent_user')->where('agent_id',$id)->get()->ToArray();

    //     foreach($data as $datas){
    //        $user_id = $datas->user_id;
    //    }
    //          // return dd($user_id);

    //    $query = DB::table('users')->where('id',$user_id)->get()->ToArray();

    //          // return dd($query);
    //    try{
    //     \Mail::to('webdev@gmail.com')->send(new AgentConfirmMailable($query));
    //     echo 'Mail Send Successfully';
    // }
    // catch(\expection $e){
    //     echo 'unsuccessful';
    // }
        /*Image module full*/
        /*Success with below code*/ 
        // $user = Auth::user();

        /* To Create Type Role */ 
        // $query = Type::create([
        //     'name' => 'Rent',
        // ]);
        /*---------------------*/ 

        // $type = DB::table('types')->where('name','Rent')->get();

        // foreach($type as $data){
        //     $type_id = $data->id;
        // }
        // $agentdata = DB::table('agents')->where('agent_name',$user->name)->get()->ToArray();
        // foreach($agentdata as $data){
        //     $agentid = $data->id;
        // }

        // $Property_data = Property::create([
        //     'property_name' => 'Test Property',
        //     'property_type' => 'Rent',
        //     'property_address' => 'test address',
        //     'property_author' => 'tester',
        //     'property_country' => 'india',
        //     'property_state' => 'gujarat'
        // ]);
        // $Property_data->agents()->attach($agentid);
        // $Property_data->type()->attach($type_id);

        // $property_id = DB::table('properties')->where('id',$Property_data->id)->get()->ToArray();
        // foreach($property_id as $data){
        //     $prop = $data->id;
        // }

        // $property_image = Image::create([
        //     'filename' => 'asdasdasdasd',
        // ]);

        // $property_image->propertyimage()->attach($prop);
        /*----------working logic for property-----------*/

        /*----------logic for image fetch-----------*/

    //     $agent_id = ['35'];
    //     foreach($agent_id as $agent_ids){

    //         // $agentss = $agent_ids;

    //         $data = Agent::join('agent_property', function ($join) use ($agent_ids) {
    //             $join->on('agent_property.agent_id', '=', 'agents.id')->where('agent_id',$agent_ids);
    //         })->get(); 
    //         // return dd($data);
    //         foreach($data as $da){
    //             $agentid = $da->agent_id;
    //             $propertyid = $da->property_id;
    //         }

    //         $prop = Property::join('image_property', function ($join) use ($propertyid){
    //             $join->on('image_property.property_id','=','properties.id')->where('property_id',$propertyid);
    //         })->get();
    //         // return dd($prop);
    //         foreach($prop as $data){
    //             $imageid = $data->image_id;
    //             $image_fetched = Image::where('id',$imageid)->get()->ToArray();
    //             foreach($image_fetched as $img){
    //                 $image_path[] = $img['path'];
    //             }
    //         }
    //         $imageall = $image_fetched;
    //         // $imageall->ToArray();
    //     }
    //     // return dd($data);
    //     return dd($image_path);

    // }
        /*----------Image Fetch and display as product-------------*/
    // public function imagegal(){
    //     $agent_id = ['35'];
    //     foreach($agent_id as $agent_ids){

    //         // $agentss = $agent_ids;

    //         $data = Agent::join('agent_property', function ($join) use ($agent_ids) {
    //             $join->on('agent_property.agent_id', '=', 'agents.id')->where('agent_id',$agent_ids);
    //         })->get(); 
    //         // return dd($data);
    //         foreach($data as $da){
    //             $agentid = $da->agent_id;
    //             $propertyid = $da->property_id;
    //         }

    //         $prop = Property::join('image_property', function ($join) use ($propertyid){
    //             $join->on('image_property.property_id','=','properties.id')->where('property_id',$propertyid);
    //         })->get();
    //         // return dd($prop);
    //         foreach($prop as $data){
    //             $imageid = $data->image_id;
    //             $image_fetched = Image::where('id',$imageid)->get()->ToArray();
    //             foreach($image_fetched as $img){
    //                 $image_path[] = $img['filename'];
    //             }
    //         }
    //         $imageall = $image_fetched;
    //         // $imageall->ToArray();
    //     }
    //     // return dd($data);
    //     return view('testpage')->with('images',$imageall)->with('image_path',$image_path);
    // }  
        /*-----------------------------------------------------------------------------------------------*/

        // $propid = Property::all();

        // $propid = 12;

        // $data = Property::join('image_property',function($join) use ($propid){
        //     $join->on('image_property.property_id','=','properties.id')->where('property_id',$propid);
        // })->get();
        // return dd($data);

        /*-----------------3 Table Join agent_user,users,agents-----------------*/ 
        // $data = DB::table('agent_user')
        // ->join('users', 'users.id', '=', 'agent_user.user_id')
        // ->join('agents', 'agents.id', '=', 'agent_user.agent_id')
        // ->where('agent_user.id', '=', 16)
        // ->get();

        /*------------------Multiple Tables Join agents,users,agent_user,properties,image_property,agent_property*/ 
        // $searchdata = 74;
        // $agentid = 35;

        // $data1 = DB::table('properties')
        // ->join('image_property', 'image_property.property_id', '=', 'properties.id')
        // ->join('agent_property', 'agent_property.property_id', '=', 'properties.id')
        // ->join('agents', 'agents.id', '=', 'agent_property.agent_id')
        // ->join('agent_user','agent_user.agent_id','=','agents.id')
        // ->join('users','users.id','=','agent_user.user_id')
        // ->where('properties.id', 'LIKE', "%$searchdata%")
        // ->get();
        // return dd($data1);

        /*------------------------------------City Search data swap-------------------------------------------*/ 
        // $q = 2;
        // $data = DB::table('cities')
        // ->join('city_property','city_property.city_id','=','cities.id')
        // ->join('properties','properties.id','=','city_property.property_id')
        // ->where('cities.id','LIKE', '%'.$q.'%')
        // ->get();

        // return dd($data);
        /*------------------------------------------------------------------------------------------------------*/
        /*------------------------------------Agent User Property Join Table -----------------------------------*/
        // $id = 5; 

        // $property = DB::table('properties')
        // ->join('agent_property','agent_property.property_id','=','properties.id')
        // ->join('city_property','city_property.property_id','=','properties.id')
        // // ->join('image_property','image_property.property_id','=','properties.id')
        // // ->join('images','images.id','=','image_id')
        // ->where('properties.id',$id)
        // ->get();
        // return dd($property);

        // $count_data = DB::table('agents')->where('id',$agent)->get();
        // $count = DB::table('agent_property')->where('agent_id',$agent)->count();
        // $query = DB::table('agents')->where('id',$agent)->update(['property_counts'=>$count]);
        // $properties_type = DB::table('agent_property')->where('agent_id',$agent)->get();
        // foreach($properties_type as $prop){
        //     $data[] = DB::table('property_type')->where('property_id',$prop->property_id)->get();
        // }
        // foreach($data as $data1){
        //     $for_rent = DB::table('property_type')->where('type_id',4)->count();
        //     $for_buy = DB::table('property_type')->where('type_id',3)->count();
        // }

        // $type_data[] = DB::table('agents')
        // ->join('agent_property','agent_property.agent_id','=','agents.id')
        // ->where('agents.id',$agent)
        // ->get()
        // ->ToArray();
        // return dd($type_data);
        // foreach($type_data as $data){
        //     $datas[] = $data[0]->property_id;
        // }

        // return dd($datas);

        /*--------------Contact agent for property-----------------*/ 

        /*------------------------------------------------------------------------------------------------------*/ 
    }
    /*----------------------------------------------*/

    /*--------------Multi Select logic--------------*/ 
    // public function test(){
    //     return view('testpage');
    // }
    // public function imagegal(request $request){
    //     $data = $request->ToArray();
    //     $serialized_array = serialize($data["data"]);
    //     $data2 = unserialize($serialized_array);
    //     return dd($data2);
    // }
    /*-----------------------------------------------*/ 
}