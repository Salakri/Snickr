<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use URL;
use Carbon\Carbon;

class ChannelController extends Controller
{
    //
    public function create(Request $request){
    	$wid = $request->wid;


    	session(['redirectPath'=>URL::previous()]);
		//$request->session()->put('redirectPath', URL::previous());

    	return view('createch')->with('wid',$wid);
    }
    public function check(Request $request){//administrator
    	$wid = $request->wid;
    	//dd($request);
    	$tmp = DB::table('workspace')->select('wname')->where('wid','=',$wid)->first();
    	//dd($wid);
    	$wsname = $tmp->wname;
    	$cname = $_POST['cname'];
    	$ctype = $_POST['ctype'];
    	$creatorid = Auth::user()->id;
    	$ctimedate = Carbon::now();

    	if($cname <> 'general'){
    		$bool = DB::table('channels')->insert(['cname'=>$cname, 'creatorid'=>$creatorid,'ctimedate'=>$ctimedate,'ctype'=>$ctype,'wid'=>$wid]);
            $cid = DB::getPdo()->lastInsertId();
    		$bool1 = DB::table('channelmem')->insert(['cid'=>$cid, 'id'=>$creatorid]);

    		if($bool){
    			return redirect()->action('HomeController@index',['wsid'=>$wid,'wsname'=>$wsname,'ch'=>$cid,'default'=> 0]);
    		}else{
    			//error:插入失败；
    		}
    	}
    	
    	//Does anyone can create channel?
    	//TODO : channel 重名情况

    }
}
