<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use URL;
use Carbon\Carbon;

class WorkspaceController extends Controller
{
    //
    public function create(Request $request){
    	//$wid = $request->wid;


    	session(['redirectPath'=>URL::previous()]);
		//$request->session()->put('redirectPath', URL::previous());

    	return view('createws');//->with('uid',Auth::user()->id);
    }

    public function check(){
    	$wsname = $_POST['wsname'];
    	$wsdescription = $_POST['wsdescription'];

    	/*dd($_POST);*/

		//transaction:
    	$bool = DB::table('workspace')->insert(['wname'=>$wsname,'wdescription'=>$wsdescription,'wtimedate'=>Carbon::now()]);//create workspace
    	if($bool){
    		$wid = DB::getPdo()->lastInsertId();
    		$uid = Auth::user()->id;
    		//$wid = $tmp->wid;
    		$adminflg = 1;
    		$bool2 = DB::table('member')->insert(['id'=>$uid, 'wid'=>$wid,'adminflag'=> $adminflg,'jointimedate'=>Carbon::now()]);

    		//create default 'general' channel
    		$bool3 = DB::table('channels')->insert(['ctimedate'=>Carbon::now(),'cname'=>'general','wid'=>$wid,'ctype'=>'public','creatorid'=>$uid]);
    		$cid = DB::getPdo()->lastInsertId();

    		//insert into channelmem
    		$bool4 = DB::table('channelmem')->insert(['id'=>$uid,'cid'=>$cid]);
    	}
    	if($bool && $bool2 && $bool3 && $bool4){//successfully insert
    		//dd($_POST);
    		return redirect()->action('HomeController@index',['wsid'=>$wid,'wsname'=>$wsname,'ch'=>$cid,'default'=> 0]);
    	}else{
    		//error
    	}
    }
}
