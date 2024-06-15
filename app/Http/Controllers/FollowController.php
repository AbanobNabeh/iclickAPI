<?php

namespace App\Http\Controllers;

use App\Models\FollowersModel;
use App\Models\NotificationModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    
    public function follow(Request $request){
        $user = Auth::id();
        $NotificationController = new NotificationController();
        $resource = FollowersModel::where('fromuser', $user)
            ->where('touser', $request->iduser)
            ->first();
        if($resource){
            $check = $this->checkfollow(['Myid'=>$user,'iduser' =>$request->iduser]);
            return response()->json([
                "message" => $check,
                "status" => "false"
            ]);
        }else{
            $checknotifiy=  NotificationModel::where('fromuser',$user)
                                                    ->where('touser',$request->iduser)
                                                    ->where('type','follow')
                                                    ->where( 'link',  $request->iduser)
                                                    ->first();
            if(!$checknotifiy){
                $NotificationController->addnotifi([
                    'fromuser' =>  $user,
                    'touser'=>  $request->iduser,
                    'type'=>  'follow',
                    'link'=>  $request->iduser,
                ]);
            }
            User::where('id',$user)->increment('following');
            User::where('id',$request->iduser)->increment('followers');
            $follow = FollowersModel::create([
                'fromuser' => $user,
                'touser' => $request->iduser]);
            $check = $this->checkfollow(['Myid'=>$user,'iduser' =>$request->iduser]);
            return response()->json([
                "message" => $check,
                "status" => "true"
            ]);
        }
    }


    public function unfollow(Request $request){
        $user = Auth::id();
        $resource = FollowersModel::where('fromuser', $user)
        ->where('touser', $request->iduser)
        ->first();
        if($resource){
            User::where('id',$user)->decrement('following');
            User::where('id',$request->iduser)->decrement('followers');
            $follow = FollowersModel::where([
                'fromuser' => $user,
                'touser' => $request->iduser])->delete();
            $check = $this->checkfollow(['Myid'=>$user,'iduser' =>$request->iduser]);
            return response()->json([
                "message" => $check,
                "status" => "true"
            ]);
        }else{
            
            $check = $this->checkfollow(['Myid'=>$user,'iduser' =>$request->iduser]);
            return response()->json([
                "message" => $check,
                "status" => "false"
            ]);
        }
    }

    public function checkfollow(array $data){
        if($data['Myid'] == $data['iduser']){
            return 'me';
        }else{
            $follow = FollowersModel::where('fromuser',$data['Myid'])->where('touser',$data['iduser'])->first();
            $following = FollowersModel::where('touser',$data['Myid'])->where('fromuser',$data['iduser'])->first();
            if($follow != null){
                if($following != null){
                    return "double";
                }else{
                    return "follow";
                }
            }else if($following != null){
                if($follow != null){
                    return "double";
                }else{
                    return "following";
                }
            }else{
                return "nothing";
            }
        }
    }
}
