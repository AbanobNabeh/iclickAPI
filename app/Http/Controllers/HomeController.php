<?php
namespace App\Http\Controllers;

use App\Events\ChatListEvent;
use App\Events\CommentEvent;
use App\Events\OrderShipped;
use App\Models\CommentModel;
use App\Models\Likes;
use App\Models\NotificationModel;
use App\Models\PostModel;
use App\Models\ReelsModel;
use App\Models\ReplayModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class HomeController extends Controller
{
    public function addcomment(Request $request){
        $NotificationController = new NotificationController();
        $user = Auth::id();
        $type = $request->type;
        $comments = CommentModel::create([
        'iduser'=> $user,
        'comment' =>$request->comment,
        'link' => $request->idpost,
        'type' => $type,
        'like' => 0,
        'date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        if ($type === 'reel') {
            ReelsModel::where('id', $request->idpost)->increment('comment');
            $NotificationController->addnotifi([
                'fromuser' =>  $user,
                'touser'=>  ReelsModel::where('id', $request->idpost)->select('iduser')->first()['iduser'],
                'type'=>  'comment-reel',
                'link'=>  $request->idpost,
            ]);
        }else{
            $NotificationController->addnotifi([
                'fromuser' =>  $user,
                'touser'=>  PostModel::where('id', $request->idpost)->select('iduser')->first()['iduser'],
                'type'=>  'comment-post',
                'link'=>  $request->idpost,
            ]);
        }
        return response()->json([
            "message" => "Add Comment Success",
            'date' => $comments,
            "status" => "true"
        ]);
    }
    public function getcomment(Request $request){
        $user = Auth::id();
        $comments = CommentModel::where(
            "type" , $request->type,
        )->where(
            'link', $request->idpost,)->with('userinfo')->paginate(50);
        foreach($comments as $comment){
            $comment['liked'] = Likes::where('link',$comment->id)->where('type',"comment")->where('iduser',$user)->get()->isNotEmpty();
            $comment['replies'] = ReplayModel::where('idcomment',$comment->id)->count();
        };
        return response()->json([
            "data" => $comments,
            "status" => "true"
        ]);
    }
    public function likeComment(Request $request)
    {
        $NotificationController = new NotificationController();
        $user = Auth::id();
        $like = Likes::where('iduser', $user)
                     ->where('link', $request->idcomment)
                     ->where('type', "comment")
                     ->first();
        if ($like) {
            CommentModel::where('id', $request->idcomment)->decrement('like');
            $like->delete();
            $message = "unlike";
        } else {
            CommentModel::where('id', $request->idcomment)->increment('like');
            $touser = CommentModel::where('id', $request->idcomment)->select('iduser')->first()['iduser'];
            $checknotifiy=  NotificationModel::where('fromuser',$user)
                                                    ->where('touser',$touser)
                                                    ->where('type','like-coment',)
                                                    ->where( 'link',  $request->idcomment)
                                                    ->first();
            if(!$checknotifiy){
                $NotificationController->addnotifi([
                    'fromuser' =>  $user,
                    'touser'=>  $touser,
                    'type'=>  'like-coment',
                    'link'=>  $request->idcomment,
                ]);
            }
            Likes::create([
                'iduser' => $user,
                'link' => $request->idcomment,
                'type' => "comment"
            ]);
            $message = "like";
        }
        return response()->json([
            "message" => $message,
            "status" => "true"
        ]);
    }
    public function replay(Request $request){
        $NotificationController = new NotificationController();
        $user = Auth::id();
        $type = $request->type;
        $replay = ReplayModel::create([
            'iduser' => $user,
            'repaly' => $request->replay,
            'idcomment'=> $request->idcomment,
            'like' => 0,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        if ($type === 'reel') {
            ReelsModel::where('id', $request->idpost)->increment('comment');
        } 
        $NotificationController->addnotifi([
            'fromuser' =>  $user,
            'touser'=>  CommentModel::where('id', $request->idcomment)->select('iduser')->first()['iduser'],
            'type'=>  'replay',
            'link'=>  $request->idcomment,
        ]);
        return response()->json([
            "message" => "Add Replay Success",
            "status" => "true"
        ]);
    }
    public function getreplies (Request $request){
        $user = Auth::id();
        $replies = ReplayModel::where('idcomment',$request->idcomment)->with('userinfo')->get();
        foreach($replies as $replay){
            $replay['liked'] = Likes::where('link',$replay->id)->where('type',"replay")->where('iduser',$user)->get()->isNotEmpty();
        };
        return response()->json([
            "data" => $replies,
            "status" => "true"
        ]);
    }
    public function likeReplay(Request $request)
    {
        $NotificationController = new NotificationController();
        $user = Auth::id();
        $like = Likes::where('iduser', $user)
                     ->where('link', $request->idpost)
                     ->where('type', "replay")
                     ->first();
        if ($like) {
            ReplayModel::where('id', $request->idpost)->decrement('like');
            $like->delete();
            $message = "unlike";
        } else {
            $touser = CommentModel::where('id', $request->idpost)->select('iduser')->first()['iduser'];
            $checknotifiy=  NotificationModel::where('fromuser',$user)
                                                    ->where('touser',$touser)
                                                    ->where('type','like-replay',)
                                                    ->where( 'link',  $request->idpost)
                                                    ->first();
            if(!$checknotifiy){
                $NotificationController->addnotifi([
                    'fromuser' =>  $user,
                    'touser'=>  $touser,
                    'type'=>  'like-replay',
                    'link'=>  $request->idpost,
                ]);
            }
            ReplayModel::where('id', $request->idpost)->increment('like');
            Likes::create([
                'iduser' => $user,
                'link' => $request->idpost,
                'type' => "replay"
            ]);
            $message = "like";
        }
        return response()->json([
            "message" => $message,
            "status" => "true"
        ]);
    }
    
    public function deletecomment($id)
    {
        $resource = CommentModel::findOrFail($id);
        if ($resource['type'] === 'reel') {
            ReelsModel::where('id', $resource['link'])->decrement('comment');
        } 
        $resource->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }

    public function deletereplay($id)
    {
        $resource = ReplayModel::findOrFail($id); 
        $comment = CommentModel::findOrFail($resource->idcomment);
        ReelsModel::where('id', $comment->link)->decrement('comment');
        $resource->delete();
        return response()->json(['message' => 'Replay deleted successfully']);
    }

    public function addlike(Request $request)
    {
        $NotificationController = new NotificationController();
        $user = Auth::id();
        $type = $request->type;
        $like = Likes::where('iduser', $user)
                     ->where('link', $request->idpost)
                     ->where('type', $type)
                     ->first();
        if (empty($like)) {
            if ($type === 'reel') {
            $touser = ReelsModel::where('id', $request->idpost)->select('iduser')->first()['iduser'];
            $checknotifiy=  NotificationModel::where('fromuser',$user)
                                                ->where('touser',$touser)
                                                ->where('type','like-reel',)
                                                ->where( 'link',  $request->idpost)
                                                ->first();
            if(!$checknotifiy){
                $NotificationController->addnotifi([
                    'fromuser' =>  $user,
                    'touser'=>  $touser,
                    'type'=>  'like-reel',
                    'link'=>  $request->idpost,
                ]);
            }
            ReelsModel::where('id', $request->idpost)->increment('like');
            } elseif ($type === 'post') {
                $touser = PostModel::where('id', $request->idpost)->select('iduser')->first()['iduser'];
                $checknotifiy=  NotificationModel::where('fromuser',$user)
                                                    ->where('touser',$touser)
                                                    ->where('type','like-post',)
                                                    ->where( 'link',  $request->idpost)
                                                    ->first();
                if(!$checknotifiy){
                    $NotificationController->addnotifi([
                        'fromuser' =>  $user,
                        'touser'=>  $touser,
                        'type'=>  'like-post',
                        'link'=>  $request->idpost,
                    ]);
                }
                PostModel::where('id', $request->idpost)->increment('likes');
            }
            Likes::create([
                'iduser' => $user,
                'link' => $request->idpost,
                'type' => $type
            ]);
            return response()->json([
                "message" => "like",
                "status" => "true"
            ]);
        } else {
            if ($type === 'reel') {
                ReelsModel::where('id', $request->idpost)->decrement('like');
            } elseif ($type === 'post') {
                PostModel::where('id', $request->idpost)->decrement('likes');
            }
            $like->delete();
            return response()->json([
                "message" => "unlike",
                "status" => "true"
            ]);
        }
    }
    

    public function uploaditemchat(Request $request){
        $user = Auth::user();
        $file_name = time() . '.' . $request->file->getClientOriginalExtension();
        $filepath = $request->file('file')->storeAs("chat/".$user->email,$file_name,'public');
        return $user->email.'/'.$file_name;
    }


    public function searchuser($type){ 
        $user = Auth::id();
        $users = User::where("id",'!=',$user)->where("firstname" ,"LIKE" , $type."%")->orWhere("username" ,"LIKE" , $type."%")->take(10)->get();
        return $users;
    }
}
