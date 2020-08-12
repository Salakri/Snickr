<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class WelcomeController extends Controller
{
    public function welcome(){

        if(Auth::check()){
            $ws = DB::table('member')->join('workspace','member.wid','=','workspace.wid')->select('workspace.wid','workspace.wname')->where('member.id','=',Auth::user()->id)->get();
            $winv = $this->getWsInv();
            $cinv = $this->getChInv();
            return view('welcome')->with('ws',$ws)->with('winv',$winv)->with('cinv',$cinv);
        }else{
            return view('welcome');
        }       
    }


    public function index(Request $request){
    	if(Auth::check()){
	    	$userId = Auth::user()->id;
	        $wsid = $request->wsid;
	        $wsname = $request->wsname;

	        $channels = DB::table('channelmem')->join('channels','channelmem.cid','=','channels.cid')->select('channels.cid','channels.cname')->where('channelmem.id','=',$userId)->where('channels.wid','=',$wsid)->get();
	        //

	    	$channelsArr = $channels->toArray();
	            //dd($channelsArr);
	        foreach($channelsArr as $ch){
	            if($ch->cname === 'general'){
	                $defaultch = $ch->cid;
	                break;
	            }  
	        }
	    	return redirect()->action('HomeController@index',['wsid'=>$wsid,'wsname'=>$wsname, 'ch'=>$defaultch]);
	    }else{
	    	return view('welcome');
	    }
	}

    public function getWsInv(){
        $userId = Auth::user()->id;
        $data = DB::table('invitation2ws')->join('users','invitation2ws.iwsenduid','=','users.id')->join('workspace','workspace.wid','=','invitation2ws.wid')->select('users.name','users.id','invitation2ws.wid','invitation2ws.iwtimedate','workspace.wname')->where('invitation2ws.iwrecvemail','=',Auth::user()->email)->get();
        return $data;
    }

    public function getChInv(){//TODO:change database
        $userId = Auth::user()->id;
        $data = DB::table('invitation2cha')->join('users','invitation2cha.icsenduid','=','users.id')->join('channels','channels.cid','=','invitation2cha.cid')->select('users.name','users.id','invitation2cha.cid','invitation2cha.ictimedate','channels.cname')->where('invitation2cha.icrecvemail','=',Auth::user()->email)->get();
        return $data;
    }
}
