<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Property;
use App\Agent;
use Doc;
use Session;

class VerifyController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }

    public function index(){

        $user = Auth::user();
        $agents = Agent::where('approval',0)->count();
        $city = DB::table('cities')->get()->ToArray();
        $property_data = DB::table('properties')->where('doc_verified',0)->paginate(5);

        return view('admin.verify',compact('property_data','user','agents','city'));
    }

    public function verified($id){
        $user = Auth::user();
        $agents = Agent::where('approval',0)->count();
        $city = DB::table('cities')->get()->ToArray();
        $query = DB::table('properties')->where('id',$id)->update(['doc_verified'=> 1]);

        $property_data = DB::table('properties')->where('doc_verified',0)->paginate(5);
        
        Session::flash('success', 'Verfied successfully');
        
        return view('admin.verify',compact('property_data','user','agents','city'));

        // if($query){
        //     return view('admin.verify')->with('user',$user)->with('agents',$agents)->with('property_data',$property_data)->with('success','Verfied successfuly');
        // }else{
        //     return back()->with('error','Error in verifing');
        // }
    }

    public function verifydoc($id){
       $user = Auth::user();
       $agents = Agent::where('approval',0)->count();
       $city = DB::table('cities')->get()->ToArray();

       $doc_data = DB::table('properties')
       ->join('doc_property','doc_property.property_id','=','properties.id')
       ->join('docs','docs.id','=','doc_id')
       ->where('properties.id',$id)
       ->get();

       return view('admin.propertydoc',compact('user','agents','doc_data','city'));

   }
   public function download($filename)
   {
    // Check if file exists in public/documents folder
    $destinationPath = public_path('documents');
    $file_path =  $destinationPath.'\\'.$filename;
    $headers = array(
        'Content-Type: doc',
        'Content-Disposition: attachment; filename='.$filename,
    );
    if ( file_exists( $file_path ) ) {
            // Send Download
        return \Response::download( $file_path, $filename, $headers );
    } else {
            // Error
        exit( 'Requested file does not exist on our server!' );
    }
}
}
