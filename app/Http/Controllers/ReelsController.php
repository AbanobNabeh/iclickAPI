<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\FollowersModel;
use App\Models\Likes;
use App\Models\ReelsModel;
use App\Models\ReplayModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReelsController extends Controller
{
    public function uploadreel(Request $request){
        $user = Auth::user();
        $file_name = time() . '.' . $request->file->getClientOriginalExtension();
        $filepath = $request->file('file')->storeAs("reels/".$user->email,$file_name,'public');
        $reel = ReelsModel::create([
        'iduser' => $user->id,
        'video' => $file_name,
        'caption' => $request->caption,
        'like' =>0,
        'comment'=>0,
        'share'=>0,
        ]);

        return response()->json([
            "message" => "Success",
            "status" => "true"
        ]);
    }

    public function getreels(){
        $followersController = new FollowController();
        $user = Auth::user()->id;
        $reels = ReelsModel::where('iduser','!=', $user)->with('user')->inRandomOrder()->paginate(30);
        foreach($reels as $reel){
            $reel['relationship'] = $followersController->checkfollow(['Myid'=>$user,'iduser' =>$reel['iduser']]);
            $reel['liked'] = Likes::where('link',$reel->id)->where('type',"reel")->where('iduser',$user)->get()->isNotEmpty();
        };
        return $reels;
    }

    public function getreelbyid(Request $request){
        $user = Auth::user()->id;
        $followersController = new FollowController();
        $reel = ReelsModel::where('id',$request->idreel)->with('user')->first();
        $reel['relationship'] = $followersController->checkfollow(['Myid'=>$user,'iduser' =>$reel['iduser']]);
        $reel['liked'] = Likes::where('link',$reel->id)->where('type',"reel")->where('iduser',$user)->get()->isNotEmpty();
        return $reel;
    }

    
}
