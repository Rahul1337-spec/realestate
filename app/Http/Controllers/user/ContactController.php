<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactInfoMailable;
use Mail;
use Auth;
use App\Property;
use App\User;
use App\Enquiry;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware(['auth'=>'verified']);
    }
    public function index($id){
        /*----Cruical variable data----*/ 
        $property_id = $id;
        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        $emptyvar = '';
        /*---- Fetch full data with join--------*/ 
        $property_data = DB::table('properties')->where('id',$property_id)->get();
        
        $enquiry_check = DB::table('enquiry_user')
        ->join('users','users.id','=','enquiry_user.user_id')
        ->join('enquiry_property','enquiry_property.enquiry_id','=','enquiry_user.enquiry_id')
        ->where('user_id',$user->id)
        ->where('property_id',$property_id)
        ->get();
        
        return view('user.enquiry')->with('user',$user)->with('property',$property_data)->with('check',$enquiry_check)->with('city',$city);

        // if(!$enquiry_check == ''){
        //       return dd($enquiry_check);
        //         return view('user.enquiry')->with('user',$user)->with('property',$property_data)->with('check',$enquiry_check);
        // }
        // else{
        //     return view('user.enquiry')->with('user',$user)->with('property',$property_data)->with('check',$emptyvar);
        // }   
    }
    public function contactdata(Request $request){


        $data = $request->ToArray();

        $valid = Validator::make($data,[
            'Name' => ['required','string','max:255'],
            'Email' => ['required','email'],
            'Phone' => ['required','numeric','digits_between:10,13']
        ]);
        if($valid->fails()){
            return back()->withErrors($valid);
        }
        else{

            $postdata = Enquiry::create([
                'name' => $request->Name,
                'email' => $request->Email,
                'phone' => $request->Phone
            ]);
            $postdata->enquiry()->attach($request->user_id);
            $postdata->property_enquiry()->attach($request->property_id);
            $postdata->save();

            $phoneno = $postdata->phone;
            $data = [
                'phone' => '91'.$phoneno, // Receivers phone
                'body' => 'Thank you for using our service, Your request has been forwarded to respected property owner', // Message
            ];
            $json = json_encode($data); // Encode data to JSON
            // URL for request POST /message
            $url = 'https://eu64.chat-api.com/instance67188/sendMessage?token=834ge52oeiyd6t46';

            // Make a POST request

            $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
            // Send a request
            $result = file_get_contents($url, false, $options);

            if($postdata){
                // Sending mail to property agent 
             $agent = DB::table('properties')
             ->join('agent_property','agent_property.property_id','=','properties.id')
             ->where('properties.id',$request->property_id)
             ->get();
             // return dd($agent);
             if(!$agent->isEmpty()){
                 $property_agent = DB::table('properties')
                 ->join('agent_property','agent_property.property_id','=','properties.id')
                 ->join('agent_user','agent_user.agent_id','=','agent_property.agent_id')
                 ->join('users','users.id','=','agent_user.user_id')
                 ->where('properties.id',$request->property_id)
                 ->get();
                 
             }else{
                $property_agent = DB::table('properties')
                ->join('property_user','property_user.property_id','=','properties.id')
                ->join('users','users.id','=','property_user.user_id')
                ->where('properties.id',$request->property_id)
                ->get();
            }


            $enquiry_count = DB::table('enquiry_property')->where('property_id',$request->property_id)->count();
            $query = DB::table('properties')->where('id',$request->property_id)->update(['enquiry_count'=>$enquiry_count]);

            $email = $property_agent[0]->email;

            try{
                \Mail::to($email)->send(new ContactInfoMailable($property_agent));
            }
            catch(\expection $e){

            }
            /*Mail Sending end*/

            return back()->with('success','Contact request made successfuly');
        }
    }
}
}
