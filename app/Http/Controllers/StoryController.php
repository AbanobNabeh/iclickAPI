<?php

namespace App\Http\Controllers;

use App\Models\FollowersModel;
use App\Models\NotificationModel;
use App\Models\StoriesModel;
use App\Models\User;
use App\Models\ViewStoryModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function uploadstory(Request $request){  
        $user = Auth::user();
        $file_name = time() . '.' . $request->file->getClientOriginalExtension();
        $filepath = $request->file('file')->storeAs("stories/".$user->email,$file_name,'public');
        $story = StoriesModel::create([
            'iduser' => $user->id,
            'image' => $request->image == 0 ?  $file_name : null,
            'video' => $request->image == 1 ?  $file_name : null,
            "date" =>Carbon::now()->format('Y-m-d H:i:s')
        ]);
        return response()->json([
            "message" => "Success",
            "status" => "true"
        ]);
    }
    public function getstories()
    { 
        $stories = [];
        $id = Auth::user()->id;
        $followers = FollowersModel::where('fromuser', $id)->get();
        foreach ($followers as $follow) {
            $users = User::where('id', $follow->touser) ->with(['stories' => function ($query) {
                $query->orderBy('date');
            }])
            ->get();
            foreach ($users as $user) {
                $user->watch = true;
                if ($user->stories->isNotEmpty()) {
                    foreach ($user->stories as $viewstory) {
                        $view = ViewStoryModel::where('idstory', $viewstory->id)->where('iduser', $id)->get();
                        
                        $viewstory->seen = $view->isNotEmpty();
                        if ($view->isEmpty()) {
                            $user->watch = false;
                            $viewstory->like = false;
                        }
                        foreach ($view as $watch){
                            $viewstory->like = $watch->like == 1 ? true : false;
                        }
                    }
                    $stories[] = $user;
                }
            }
        }
        usort($stories, function ($a, $b) {
            if ($a->watch && !$b->watch) {
                return 1; // $a->watch is true (move $a after $b)
            } elseif (!$a->watch && $b->watch) {
                return -1; // $a->watch is false (move $a before $b)
            } else {
                return 0; // No change in order if both have same 'watch' value
            }
        });    
        $mystory = StoriesModel::where('iduser',$id)->get();
        foreach ($mystory as $story){
            $story->view = ViewStoryModel::where("idstory",$story->id)->count();
        }
        return  response()->json([
            "mystories" => $mystory,
            "data" => $stories
        ]);;
    }
    public function storyseen(Request $request)
    {
        $user = Auth::id();
        $check = ViewStoryModel::where([
            'iduser' => $user,
            'idstory' => $request->storyid])->first();
            if($check){
                return  response()->json([
                    "message" => "Watch Success",
                    "status" => "false"
                ]);;
            }else{
                $view = ViewStoryModel::create([
                    'iduser' => $user,
                    'idstory' => $request->storyid,
                    "like" => false
                ]); 
                return  response()->json([
                    "message" => "Watch Success",
                    "status" => "true"
                ]);;
            }
    }
    public function likestory(Request $request)
    {
        $user = Auth::id();
        $NotificationController = new NotificationController();
        $check = ViewStoryModel::where([
            'iduser' => $user,
            'idstory' => $request->storyid])->first();
            $touser = StoriesModel::where('id', $request->storyid)->select('iduser')->first()['iduser'];
            $checknotifiy=  NotificationModel::where('fromuser',$user)
                                                    ->where('touser',$touser)
                                                    ->where('type','like-story',)
                                                    ->where( 'link',  $request->storyid)
                                                    ->first();
            if(!$checknotifiy){
                $NotificationController->addnotifi([
                    'fromuser' =>  $user,
                    'touser'=>  $touser,
                    'type'=>  'like-story',
                    'link'=>  $request->storyid,
                ]);
            }
            if($check){
                $view = ViewStoryModel::where("id",$check->id)->update([
                    "like" => true
                ]);
                return  response()->json([
                    "message" => "Like Success",
                    "status" => "false"
                ]);
            }else{
                $view = ViewStoryModel::create([
                    'iduser' => $user,
                    'idstory' => $request->storyid,
                    "like" => true
                ]);
                return  response()->json([
                    "message" => "Like Success",
                    "status" => "true"
                ]);
            }
            
    }
    public function getviewers(Request $request)
    {
        $viewrs = ViewStoryModel::where('idstory',$request->ispost)->with('getuser')->orderBy('like',"DESC")->get();
        return  response()->json([
            "message" => "Like Success",
            'data' => $viewrs,
            "status" => "true"
        ]);
    }


}
