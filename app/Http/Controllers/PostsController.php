<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\NotificationModel;
use App\Models\PostModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function uploadpost(Request $request)
    {
        $user = Auth::user();
        $file_name = time() . '.' . $request->file->getClientOriginalExtension();
        $filepath = $request->file('file')->storeAs("posts/".$user->email,$file_name,'public');
        $post = PostModel::create([
            'iduser' => $user->id,
            'image' => $file_name,
            'likes' => 0,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        return response()->json([
            "message" => "Add Post Success",
            'date' => $post,
            "status" => "true"
        ]);
    }

    public function getposts()
    {
        $followersController = new FollowController();
        $user = Auth::id();
        $posts = PostModel::where('iduser','!=',$user)->with('user')->inRandomOrder()->paginate(20);
        foreach($posts as $post){
            $post['relationship'] = $followersController->checkfollow(['Myid'=>$user,'iduser' =>$post['iduser']]);
            $post['liked'] = Likes::where('link',$post->id)->where('type',"post")->where('iduser',$user)->get()->isNotEmpty();
        }
        return response()->json([
            'date' => $posts,
            "status" => "true"
        ]);
    }


    public function notifiunseen(){ 
        $user = Auth::id();
        $notifications = NotificationModel::where('touser',$user)->where('seen',0)->count();
        return $notifications;
    }



    public function getpostbyid(Request $request){
        $user = Auth::id();
        $followersController = new FollowController();
        $post = PostModel::where("id" , $request->postid)->with('user')->first();
        $post['relationship'] = $followersController->checkfollow(['Myid'=>$user,'iduser' =>$post['iduser']]);
        $post['liked'] = Likes::where('link',$post->id)->where('type',"post")->where('iduser',$user)->get()->isNotEmpty();
        return $post;
    }
}