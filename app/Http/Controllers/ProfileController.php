<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\PostModel;
use App\Models\ReelsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function getUserinfo($iduser){
        $user = Auth::id();
        $followersController = new FollowController();
        $profile = User::where('id',$iduser)->first();
        $profile['relationship'] = $followersController->checkfollow(['Myid'=>$user,'iduser' => $iduser]);
        $profile['countposts'] = PostModel::where('iduser',$iduser)->count();
        return response()->json([
            'date' => $profile,
            "status" => "true"
        ]);
    }

    public function getPostsuser($iduser){
        $user = Auth::id();
        $followersController = new FollowController();
        $posts = PostModel::where("iduser",$iduser)->paginate(30);
      
        return response()->json([
            'date' => $posts->items(),
            "status" => "true"
        ]);
    }
    

    public function getReelsuser($iduser){
        $user = Auth::id();
        $followersController = new FollowController();
        $reels = ReelsModel::where("iduser",$iduser)->paginate(30);
        return response()->json([
            'date' => $reels->items(),
            "status" => "true"
        ]);
        
    }
}
