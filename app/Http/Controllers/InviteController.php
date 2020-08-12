<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use URL;
use Carbon\Carbon;

class InviteController extends Controller
{
    //
    public function checkws(Request $resuest){
    	//dd($resuest);
    	//echo("<script> alert('Sorry! Only admin can invite'); history.go(-1);</script>");
    	$wid = $resuest->wid;
    	$currentid = Auth::user()->id;
    	$tmp = DB::table('member')->select('id','wid','adminflag')->where('id','=',$currentid)->where('wid','=',$wid)->first();
    	if($tmp->adminflag <> 1){
    		echo("<script> alert('Sorry! Only admin can invite'); history.go(-1);</script>");
    	}else{
            //session(['returnadd'=>URL::previous()]);
    		return redirect()->action('InviteController@invitews',['wid'=>$wid]);
    	}

    }//check wid and uid administrator

    public function checkch(Request $request){
    	//判断type
    	//dd($request);
    	$cid = $request->chid;
        /*dd($request);*/
        $type = DB::table('channels')->select('ctype','creatorid')->where('cid','=',$cid)->first();
        if($type->ctype === 'public'){
            //redirect to invitation page
            echo("<script> alert('public channels does not need invitations!'); history.go(-1);</script>");
        }else if($type->ctype === 'private'){
            if(Auth::user()->id <> $type->creatorid){
                echo("<script> alert('Sorry! Only admin can invite'); history.go(-1);</script>");
            }else{//
                return redirect()->action('InviteController@invitech',['cid'=>$cid,'ctype'=>($type->ctype)]);
            }
        }else{
            $tmp = DB::table('channelmem')->select('id')->where('cid','=',$cid)->get();
            if(count($tmp) < 2){
                return redirect()->action('InviteController@invitech',['cid'=>$cid,'ctype'=>($type->ctype)]);
            }else{
                echo("<script> alert('This is a direct channel! Only allow 2 users'); history.go(-1);</script>");
            }
        }
    }
    public function invitews(Request $request){
    	$wid = $request->wid;
    	//$currentid = Auth::user()->id;
    	session(['redirectPath'=>URL::previous()]);
    	return view('invitationws')->with('wid',$wid);
    }

    public function invitech(Request $request){
    	$cid = $request->cid;
    	$ctype = $request->ctype;
    	//dd($request);
    	return view('invitationch',['cid'=>$cid, 'ctype'=>$ctype]);//->with('cid',)->with('ctype',);
    }

    public function insertws(Request $request){
    	$wid = $request->wid;
    	//dd($request);

    	$bool = true;
    	for($i = 1; $i < $request->num && $bool; $i++){
    	    if(!empty($_POST['email'.(string)$i]))
    		    $bool = DB::table('invitation2ws')->insert(['iwsenduid'=>Auth::user()->id,'iwrecvemail'=>$_POST['email'.(string)$i],'iwtimedate'=>Carbon::now(),'wid'=>$wid]);
    	}
    	if($bool){
            echo("<script> alert('Invitation(s) sent!')</script>"
                    ."<script> history.go(-2);</script>");//window.location.href=".$url.";
    	}else{
    		//error: MySQL error;
    	}	
    }

    public function insertch(Request $request){
        $cid = $request->cid;
        $bool = true;
        //修改数据库
        for($i = 1; $i < $request->num && $bool; $i++){
            if(!empty($_POST['email'.(string)$i]))
                $bool = DB::table('invitation2cha')->insert(['icsenduid'=>Auth::user()->id,'icrecvemail'=>$_POST['email'.(string)$i],'ictimedate'=>Carbon::now(),'cid'=>$cid]);
        }
        if($bool){
            echo("<script> alert('Invitation(s) sent!')</script>"
                ."<script> history.go(-2);</script>");//window.location.href=".$url.";
        }else{
            //error: MySQL error;
        }
    }

    public function showDecision(Request $request){
            //return view('decision',['sender'=>$request->sender,'type'=>$request->type,'workspacename'=>$request->workspacename, 'workspaceid'=>$request->workspaceid]);
            //dd($request->id);
            return view('decision',['defaultwid'=>$request->defaultwid,'defaultwname'=>$request->defaultwname,'defaultch'=>$request->defaultch,'defaultde'=>$request->defaultde,'sender'=>$request->sender,'senderid'=>$request->senderid,'type'=>$request->type,'name'=>$request->name, 'id'=>$request->id,'time'=>$request->time]);
    }

    public function join(Request $request){//Transaction
        $uid = Auth::user()->id;
        if($request->type === 'ws'){//join a workspace and all the public channels
            DB::beginTransaction();
            try{
                $bool1 = DB::table('member')->insert(['adminflag'=> 0, 'id'=> $uid, 'jointimedate'=>Carbon::now(),'wid'=>$request->id]);
                if(!$bool1) throw new \Exception("1");
                $pub = DB::table('channels')->select('cid')->where('wid','=',$request->id)->where('ctype','=','public')->get();
                $bool2 = true;
                foreach($pub as $pc){
                    $bool2 = DB::table('channelmem')->insert(['cid'=>$pc->cid,'id'=>$uid]) && $bool2;
                    if(!$bool2) throw new \Exception("2");
                }
                $bool3 = DB::table('invitation2ws')->where('iwsenduid','=',$request->senderid)->where('iwrecvemail','=',Auth::user()->email)->where('iwtimedate','=',$request->time)->delete();
                if(!$bool3) throw new \Exception("3");
                DB::commit();
                return redirect()->action('HomeController@index',['wsid'=>$request->id,'wsname'=>$request->name,'default'=>-1]);
            }catch(\Exception $e){
                DB::rollback();
                echo $e->getMessage();
            }
        }else{//join a channel at the same workspace
            $wsid = DB::table('channels')->select('wid')->where('cid','=',$request->id)->first()->wid;
            $wsname = DB::table('workspace')->select('wname')->where('wid','=',$wsid)->first()->wname;
            DB::beginTransaction();
            try{
                $bool = DB::table('channelmem')->insert(['cid'=>$request->id,'id'=>$uid]);
                if(!$bool) throw new \Exception("4");
                $bool2 =DB::table('invitation2cha')->where('icsenduid','=',$request->senderid)->where('icrecvemail','=',Auth::user()->email)->where('ictimedate','=',$request->time)->delete();
                if(!$bool2) throw new \Exception("5");
                DB::commit();
                return redirect()->action('HomeController@index',['wsid'=>$wsid,'wsname'=>$wsname,'ch'=>$request->id,'default'=>0]);
            }catch(\Exception $e){
                DB::rollback();
                echo $e->getMessage();
            }
        }
    }

    /*public function join(Request $request){
        $uid = Auth::user()->id;
        //dd($request);
        if($request->type === 'ws'){//join a workspace and all the public channels

            $bool1 = DB::table('member')->insert(['adminflag'=> 0, 'id'=> $uid, 'jointimedate'=>Carbon::now(),'wid'=>$request->id]);
            //未执行
            $pub = DB::table('channels')->select('cid')->where('wid','=',$request->id)->where('ctype','=','public')->get();

            $bool2 = true;
            foreach($pub as $pc){
                $bool2 = DB::table('channelmem')->insert(['cid'=>$pc->cid,'id'=>$uid]) && $bool2;
            }
            $bool3 = DB::table('invitation2ws')->where('iwsenduid','=',$request->senderid)->where('iwrecvemail','=',Auth::user()->email)->where('iwtimedate','=',$request->time)->delete();
            //dd($bool1&&$bool2&&$bool3)
            if($bool1&&$bool2&&$bool3)
                return redirect()->action('HomeController@index',['wsid'=>$request->id,'wsname'=>$request->name,'default'=>-1]);
        }else{//join a channel at the same workspace
            $wsid = DB::table('channels')->select('wid')->where('cid','=',$request->id)->first()->wid;
            $wsname = DB::table('workspace')->select('wname')->where('wid','=',$wsid)->first()->wname;
            $bool = DB::table('channelmem')->insert(['cid'=>$request->id,'id'=>$uid]);
            $bool2 =DB::table('invitation2cha')->where('icsenduid','=',$request->senderid)->where('icrecvemail','=',Auth::user()->email)->where('ictimedate','=',$request->time)->delete();
            if($bool&&$bool2)
                return redirect()->action('HomeController@index',['wsid'=>$wsid,'wsname'=>$wsname,'ch'=>$request->id,'default'=>0]);
        }
    }*/

    public function refuse(Request $request){
        $uid = Auth::user()->id;
        if($request->type === 'ws'){
            DB::beginTransaction();
            try{
                $bool = DB::table('invitation2ws')->where('iwsenduid','=',$request->senderid)->where('iwrecvemail','=',Auth::user()->email)->where('iwtimedate','=',$request->time)->delete();
                if(!$bool) throw new \Exception("6");
                DB::commit();
                }catch(\Exception $e){
                    DB::rollback();
                    echo $e->getMessage();
                }
        }else{
            DB::beginTransaction();
            try{
                $bool2 =DB::table('invitation2cha')->where('icsenduid','=',$request->senderid)->where('icrecvemail','=',Auth::user()->email)->where('ictimedate','=',$request->time)->delete();
                if(!$bool2) throw new \Exception("7");
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                echo $e->getMessage();
            }
        }
        if($request->defaultwid === -1) return redirect()->action('WelcomeController@welcome');
        return redirect()->action('HomeController@index',['wsid'=>$request->defaultwid,'wsname'=>$request->defaultwname,'ch'=>$request->defaultch,'default'=>$request->defaultde]);
    }
}
