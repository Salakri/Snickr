<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //登录后进入workspace选择界面；
    //private $wid = NULL;

    public function index(Request $request){
        $userId = Auth::user()->id;

        $wsid = $request->wsid;

        //$this->wid = $wsid;

        $wsname = $request->wsname;
        $defaultch = NULL;
        $cname = NULL;

        $wsinvations = $this->getWsInv();
        $chinvations = $this->getChInv();

        $channels = DB::table('channelmem')->join('channels','channelmem.cid','=','channels.cid')->select('channels.cid','channels.cname','channels.ctype')->where('channelmem.id','=',$userId)->where('channels.wid','=',$wsid)->get();
        
        
        //dd($message);

        /*DB::table('member')->join('workspace','member.wid','=','workspace.wid')->select('workspace.wid','workspace.wname')->where('member.id','=',$userId)->first();//workspace*/
        if($request->default <> 0){
            $channelsArr = $channels->toArray();
            //dd($channelsArr);
            foreach($channelsArr as $ch){
                if($ch->cname === 'general'){
                    $defaultch = $ch->cid;
                    $cname = $ch->cname;
                    break;
                }  
            }
        }else{
            $defaultch = $request->ch;
            $cname = DB::table('channels')->select('cname')->where('cid','=',$defaultch)->first()->cname;
        }
        
        $message = $this->getMesssages($defaultch);
        //dd($defaultch);
        return view('home')->with('workspacename',$wsname)->with('channels',$channels)->with('winv',$wsinvations)->with('cinv',$chinvations)->with('message',$message)->with('workspaceid',$wsid)->with('ch',$defaultch)->with('cname',$cname)->with('default',$request->default);
    }


    //进入某个WorkSpace的channels界面
    public function channels($workspace)
    {
        //$data = DB::select("select wid from workspace")
        $data = $this->userWsChannel($workspace);
        return view('wsChannels')->with('workspace',$data);
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

    protected function userWsChannel($workspace){
        $userId = Auth::user()->id;
        $data = DB::table('channelMem')->join('channels','channelMem.cid','=','channels.cid')->select('channels.cid','channels.cname')->where('channelMem.id','=',$userId)->where('channels.wid','=',$workspace)->get();
        return $data;
    }


    public function messageUpdate(Request $request){
        //dd(1111111);
        //insert into database;
        $content = $request->message;
        $userid = $request->userid;
        $cid = $request->cid;

        //
        $bool = DB::table('message')->insert(['uid'=>$userid, 'cid'=>$cid, 'content'=>$content, 'mtimedate'=>Carbon::now()]);

        //return
        $message = $this->getMesssages($cid);


        return response()->view('messagebox',['message'=> $message]);
    }

    public function getMesssages($channels){
        $data = DB::table('message')->join('users','message.uid','=','users.id')->select('users.name','users.id','message.content','message.mtimedate')->where('message.cid','=',$channels)->orderby('message.mtimedate','asc')->get();
        return $data;
    }

    public function changeworkspace(){
        $data = $this->getWorkspace();
        return response()->view('homechoosews',['ws'=>$data]);//.with('ws',$data);
    }

    public function getWorkspace(){
        $data = DB::table('member')->join('workspace','member.wid','=','workspace.wid')->select('member.wid','workspace.wname')->where('member.id','=',Auth::user()->id)->get();
        return $data;
    }

    public function listUserInfo(Request $request){

        $data = $this->getUsers($request->wid);
        //dd($request->wid);
        return response()->view('homeusertable',['data'=>$data]);
    }

    public function getUsers($wid){
        $data = DB::table('member')->join('users','users.id','=','member.id')->select('users.name','users.email','member.adminflag')->where('member.wid','=',$wid)->get();
        return $data;
    }
}
