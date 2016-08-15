<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use Hash;
use View;

class CommonController extends Controller
{
    public function __construct()
      {
        $privileges=AdminModel::privilegedSections(Auth::user()->role_id);
        View::share('privileges', $privileges);
      }
    public function changePassword(Request $request){
        $oldPass=$request->input('old_password');
        $pass=$request->input('password');
        $passConf=$request->input('password_confirmation');
        $rule=[
        'password' => 'required|confirmed|min:6',
        ];
        $hashedPassword=DB::table('users')->where('id',Auth::user()->id)->value('password');
        if (Hash::check($oldPass, $hashedPassword)) {
             $validator = Validator::make($request->all(),$rule);
             if ($validator->fails()) 
             {
                return back()
                      ->withErrors($validator)
                        ->withInput();
             }
             else{
               DB::table('users')
               ->where('id',Auth::user()->id)
               ->update(array(
                    'password'=>bcrypt($request->input('password')),
                ));
               return back()->with('message','Password Changed..');
             }
                
            }
        else{
            return back()->with('error','. Old Password Does Not Mach!!');
        }
    }
    public function changeEmail(Request $request){
    	$oldEmail=$request->input('old_email');
    	$newEmail=$request->input('new_email');

    	$userCurrEmail=DB::table('users')->where('id',Auth::user()->id)->value('email');
    	if($userCurrEmail==$oldEmail){

    		DB::table('users')->where('id',Auth::user()->id)->update(array(
    				'email'=>$newEmail,
    			));

    		return back()->with('message','Email Changed..');
    	}
    	else{
    		return back()->with('error','Email Address Does Not Match..');
    	}
    }

    public function sendEmail(Request $request){

		$name=$request->input('name');
		$email=$request->input('email');
		$subject=$request->input('subject');
		$message=$request->input('message');

		$to = "md.ashikuzzaman.ashik@gmail.com,";
		$subject =$subject;

		$message = "
		<html>
		<head>
		<title>$subject</title>
		</head>
		<body>
		<p>$message</p>
		<table>
		<tr>
		<th>Name: $name</th>		
		<th>Email: $email</th>
		</tr>
		
		</table>
		</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <contact@asrtmcaab.com>' . "\r\n";
		

		mail($to,$subject,$message,$headers);

		return back()->with('messageSend','Message Send!');
    }
}
