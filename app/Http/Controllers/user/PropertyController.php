<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Images;
use App\User;
use App\Type;
use App\Property;
use App\Image;
use App\City;
use App\Asset;
use App\Doc;
use App\Doctype;

class PropertyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $user = Auth::user();
        $city = DB::table('cities')->get()->ToArray();
        $userid = $user->id;
        $username = $user->name;

        return view('user.upload',compact('userid','city'));
    }

    public function PostProperty(request $request){
        // return "Inside Property blade";
        return dd($request);
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
                'asset' => ['required'],
                'featured' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'document1' => 'required|max:10000|mimes:doc,docx',
                'document2' => 'required|max:10000|mimes:doc,docx'
            ]);
            /*------------------------------------------------------------------*/
            /*---------------If Valid Push forward the data---------------------*/ 
            if($valid){

                $type = DB::Table('types')->where('name',$request->type)->get();
                $asset = $request->asset;
                $state = $request->state;

                $assetattach = DB::table('assets')->where('name',$asset)->get()->ToArray();
                $stateattach = DB::table('cities')->where('name',$state)->get()->ToArray();

                
                $state_id = $stateattach[0]->id;
                $asset_id = $assetattach[0]->id;

                foreach($type as $data){
                    $type_id = $data->id;
                }

                /*Need Modification*/ 
                $userdata = DB::table('users')->where('id',$request->userid)->get();
                // return dd($userdata);
                foreach($userdata as $data){
                    $user_id = $data->id;
                    $user_name = $data->name;
                }
                /*Fetching the image*/ 
                $featured_image = $request->featured; 
                /*Fetching done*/ 
                // return dd($request);
                /*Geting particular data out of the fetched resources*/ 
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
                // return dd($featured_image);
                /*Working code for feature image upload*/ 
                $destinationPath = public_path('images');
                // $featured_image->move($destinationPath, $adder.$name)->getRealPath();
                /*Working code up*/

                /*Working code for image resize as well uploading*/ 
                $img = Images::make($featured_image->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$name);

                /*Un Compress Featured image*/
                $un_featured_image = $request->featured; 
                /*Fetching done*/ 
                /*Geting particular data out of the fetched resources*/ 
                $un_name = $un_featured_image->getClientOriginalName();
                    // return dd($name);
                $un_actual_name = pathinfo($un_name,PATHINFO_FILENAME);

                $un_original_name = $un_actual_name;

                $un_extension = pathinfo($un_name, PATHINFO_EXTENSION);

                    // return dd($actual_name);
                $q = 1;
                while(file_exists('images/'.$un_actual_name.".".$extension))
                {           
                    $un_actual_name = (string)$un_original_name.$i;
                    $un_name = $un_actual_name.".".$un_extension;
                    $q++;
                } 

                $un_destinationPath = public_path('images');
                // return dd($destinationPath);
                $adder = 'un-';
                $un_featured_image->move($un_destinationPath, $adder.$un_name)->getRealPath();
                $nameer = $adder.$un_name;

                /*Un compress image work done*/ 
                // $featured_path = $destinationPath.'\\'.$name;

                /*Document uploading section here*/

                /*Fetching important document main resource*/
                $doc1 = $request->document1;
                $doc2 = $request->document2;
                /*-----------------------------------------*/
                /*Fetching names out of data*/
                $doc1_name = $doc1->getClientOriginalName();
                $doc2_name = $doc2->getClientOriginalName();

                $doc1_actual = pathinfo($doc1_name,PATHINFO_FILENAME);
                $doc2_actual = pathinfo($doc2_name,PATHINFO_FILENAME);

                $doc1_original = $doc1_actual;
                $doc2_original = $doc2_actual;

                $extension1 = pathinfo($doc1_name,PATHINFO_EXTENSION);
                $extension2 = pathinfo($doc2_name,PATHINFO_EXTENSION);
                /*---------------------------*/
                /*Removing chance of any redundancy in documents data*/ 
                $a = 1; 
                while(file_exists('documents/'.$doc1_actual.".".$extension1)){
                    $doc1_actual = (string)$doc1_original.$a;
                    $doc1_name = $doc1_actual.".".$extension1;
                    $a++;
                }
                $b = 1;
                while(file_exists('documents/'.$doc2_actual.".".$extension2)){
                    $doc2_actual = (string)$doc2_original.$b;
                    $doc2_name = $doc2_actual.".".$extension2;
                    $b++;
                } 
                /*Storing document on server*/
                $destinationPathdocs = public_path('documents');
                $doc1->move($destinationPathdocs, $doc1_name)->getRealPath();
                $doc2->move($destinationPathdocs, $doc2_name)->getRealPath();   

                $postdata = Property::create([
                    'property_name' => $request->property_name,
                    'property_address' => $request->property_address,
                    'property_type' => $request->property_type,
                    'property_author' => $user_name,
                    'property_country' => $request->country,
                    'property_state' => $request->state,
                    'property_rate' => $request->property_rate,
                    'asset' => $request->asset,
                    'uncompress_img' => $nameer,
                    'featured_img' => $name,
                ]);

                $postdata->userproperty()->attach($user_id);
                $postdata->type()->attach($type_id);
                $postdata->cities()->attach($state_id);
                $postdata->asset()->attach($asset_id);

                $postdata->save();

                $property_data = DB::table('properties')->where('id',$postdata->id)->get()->ToArray();
                /*------------Adding document property tables--------------*/ 
                /*Document Uploading section ends here*/ 
                if(isset($doc1)):
                    $path = $destinationPathdocs.'\\'.$doc1_name;
                    $docData = Doc::create([
                        'name' => $doc1_name,
                        'path' => $path,
                    ]);
                    
                    $doctype = DB::table('doctypes')->where('name','Document1')->get()->ToArray();
                    $doc_id = $doctype[0]->id;
                    $docData->documenttype()->attach($doc_id);
                    $docData->documents()->attach($property_data[0]->id);
                    $docData->save();
                endif;
                if(isset($doc2)):
                    $path = $destinationPathdocs.'\\'.$doc2_name;
                    $docData = Doc::create([
                        'name' => $doc2_name,
                        'path' => $path,
                    ]);

                    $doctype = DB::table('doctypes')->where('name','Document2')->get()->ToArray();
                    $doc_id = $doctype[0]->id;
                    $docData->documenttype()->attach($doc_id);
                    $docData->documents()->attach($property_data[0]->id);
                    $docData->save();
                endif;

                /*------------Finding the Buy and Rent Types to add up for agent---------------*/
                // $type_check = $request->type;
                
                // $properties_type = DB::table('agent_property')->where('agent_id',$agent_id)->get();
                // $prop_check = DB::table('types')->where('name',$type_check)->get();


                // foreach($properties_type as $prop){
                //     $data = DB::table('property_type')->where('property_id',$prop->property_id)->get();
                // }
                // $for_rent = '';
                // $for_buy = '';

                // foreach($data as $data1){
                //     if($prop_check[0]->id == '3'){
                //         $for_rent = DB::table('property_type')->where('type_id',3)->count();
                //     }elseif($prop_check[0]->id == '4'){
                //         $for_buy = DB::table('property_type')->where('type_id',4)->count();
                //     }
                //     else{}
                // }

                /*------------------------------------------------------------------------------*/ 

                $property_id = DB::table('properties')->where('id',$postdata->id)->get()->ToArray();
                /*adding property counts to agents table*/
                $count_data = DB::table('users')->where('id',$user_id)->get();

                $count = DB::table('property_user')->where('user_id',$user_id)->count();

                $query = DB::table('users')->where('id',$user_id)->update(['property_count'=>$count]);
                if($count_data[0]->hasproperty == 0):
                    $query = DB::table('users')->where('id',$user_id)->update(['hasproperty'=>1]);
                endif;
                /* Functionality only for the agents */ 
                // if(!$for_rent == ''){
                //     $query = DB::table('agents')->where('id',$agent_id)->update(['for_rent'=>$for_rent]);
                // }
                // elseif(!$for_buy == ''){
                //     $query = DB::table('agents')->where('id',$agent_id)->update(['for_buy'=>$for_buy]);
                // }else{}
                /*------------------------------------*/ 
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
}
