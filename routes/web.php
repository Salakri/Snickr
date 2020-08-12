<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@welcome');

Auth::routes();

Route::get('/home','HomeController@index');
Route::get('/home/{userid}/{cid}/{message}', 'HomeController@messageUpdate');
Route::get('/home/changeworkspace','HomeController@changeworkspace');
Route::get('/home/listusrinfo/{wid}',"HomeController@listUserInfo");



//workspace Route
Route::get('/createws',"WorkspaceController@create");
Route::post('/createws/check',"WorkspaceController@check");
Route::get('/createws/back',function(Request $request){
	//return back()->withInput();
	$url = session('redirectPath');//->get('redirectPath');
 	//dd(session('redirectPath'));
	session()->forget('redirectPath');
	//dd(session()->all());
	return redirect($url);
});

//Channel Route
Route::get('/createch',"ChannelController@create");
Route::post('/createch/check',"ChannelController@check");
Route::get('/createch/back',function(){
	//return back()->withInput();
	$url = session('redirectPath');//->get('redirectPath');
 	//dd(session('redirectPath'));
	session()->forget('redirectPath');
	//dd(session()->all());
	return redirect($url);
});

//invitation
Route::get('/invitews', "InviteController@invitews");
Route::get('/invitews/checkws',"InviteController@checkws");
Route::get('/invitews/back',function(){
	$url = session('redirectPath');//->get('redirectPath');
 	//dd(session('redirectPath'));
	session()->forget('redirectPath');
	//dd(session()->all());
	return redirect($url);
});
Route::get('/invitews/insertws',"InviteController@invitews");
Route::post('/invitews/insertws',"InviteController@insertws");


Route::get('/invite/decision',"InviteController@showDecision");
Route::get('/invite/join',"InviteController@join");
Route::get('/invite/refuse',"InviteController@refuse");


Route::get('/invitech',"InviteController@invitech");
Route::get('/invitech/checkch',"InviteController@checkch");
Route::get('/invitech/insertch',"InviteController@invitech");
Route::post('/invitech/insertch',"InviteController@insertch");

