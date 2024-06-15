<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\NotificationModel;
use App\Models\PostModel;
use App\Models\StoriesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function addnotifi(array $data){
        if($data['fromuser'] != $data['touser']){
            NotificationModel::create([
                'fromuser' =>  $data['fromuser'],
                'touser'=>  $data['touser'],
                'type'=>  $data['type'],
                'link'=>  $data['link'],
                'seen'=>  false,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }

    public function getnotifiy(){
        $user = Auth::id();
        $notification = NotificationModel::where('touser',$user)->with(['user'])->orderBy('date',"DESC")->paginate(50);
        return  response()->json([
            "message" => "Get Notification success",
            "data" => $notification
        ]);; 
    }

    public function seennotify($id)
    {
        $notification = NotificationModel::findOrFail($id);
        $notification->update(['seen' => true]);
        return response()->json(['message' => 'Resource updated successfully'], 200);
    }
    
}
