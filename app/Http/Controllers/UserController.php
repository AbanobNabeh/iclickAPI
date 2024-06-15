<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerify;
use App\Http\Requests\ForgotPasswrodReq;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SignInReq;
use App\Mail\ResetPassword;
use App\Mail\VerifyMail;
use App\Models\StoriesModel;
use App\Models\User;
use App\Models\VerifyModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function verifyotp(EmailVerify $request){
    VerifyModel::where('email', $request->email)->delete();
    $check = User::where('email', $request->email)->first();
    $otp = rand(100000, 999999);
    if (empty($check)) {
        Mail::to($request->email)->send(new VerifyMail($request->email,$otp,$request->firstname));
        VerifyModel::create([
          'email'=>$request->email,
          'otp' => $otp
        ]);
        return response()->json([
          "message" => "The OTP Has Been Sent Successfully",
          "status" => "true"
      ]);
    } else {
        return response()->json([
            "message" => "This Email Already Used",
            "status" => "used"
        ]);
    }
    
 
    }
    public function signup(RegisterRequest $request){
     
      $checkotp = VerifyModel::where('email', $request->email)->where('otp', $request->otp)->first();
      if (empty($checkotp)){
          return response()->json([
              "message" => "The verification code is invalid",
              "status" => "codeisinvalid"
          ]);
      }else{
         try{
            $user= User::create(
                [
                    'firstname'=> $request->firstname,
                    'lastname'=> $request->lastname,
                    'username' => "user" . Str::random(25),
                    'email'=> $request->email,
                    'password' => hash::make($request->password),
                    'followers'=> '0',
                    'following'=> '0',
                ]
                );
                
                $token = $user->createToken('signup');
                VerifyModel::where('email', $request->email)->delete();
                return response()->json([
                    "message" => "Success",
                    "token" => $token->plainTextToken,
                    "status" => "true"
                ]);
         }catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to create user",
                "error" => $e->getMessage() // Optional: Include the specific error message
            ], 500); //
         }
      }
  }

public function checkmail(Request $request){
    VerifyModel::where('email', $request->email)->delete();
    $check = User::where('email', $request->email)->first();
    $otp = rand(100000, 999999);
    if (empty($check)) {
      return response()->json([
        "message" => "This email address is not registered with us",
        "status" => "notused"
    ]);
    } else {
        Mail::to($request->email)->send(new ResetPassword($request->email,$otp,$check->firstname));
        VerifyModel::create([
          'email'=>$request->email,
          'otp' => $otp
        ]);
        return response()->json([
          "message" => "The OTP Has Been Sent Successfully",
          "status" => "true"
      ]);
    }
}


public function forgotpassword(ForgotPasswrodReq $request){
    $checklogin =   VerifyModel::where('email', $request->email)->where('otp', $request->otp)->first();
    if (empty($checklogin)){
        return response()->json([
            "message" => "The verification code is invalid",
            "status" => "codeisinvalid"
        ]);
    }else{
        $user = User::where('email', $request->email)->update(
            [
                "password" => hash::make($request->password)
            ]
            );
            VerifyModel::where('email', $request->email)->delete();
            return response()->json([
                "message" => "Success",
                "status" => "true"
            ]);
    }
}


    public function signin(SignInReq $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            $usere =  User::where('email', $request->email)->first();
            $token = $usere->createToken('signin');
            return response()->json([
                "message" => "Success",
                "token" =>  $token->plainTextToken,
                "status" => "true"
            ]);
        }else{
            return response()->json([
                "message" => "Email Or Password is invalid",
                "status" => "loginisinvalid"
            ]);
        }
    }


    public function getmyprofile(){
        $id = Auth::user();
        return $id;

    }



    
}
