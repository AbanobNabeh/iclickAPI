<?php

use App\Events\ChatListEvent;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewPostsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReelsController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/verifyotp',[UserController::class,"verifyotp"]);
Route::post('/signup',[UserController::class,"signup"]);
Route::post('/checkmail',[UserController::class,"checkmail"]);
Route::post('/forgotpassword',[UserController::class,"forgotpassword"]);
Route::post('/signin',[UserController::class,"signin"]);
Route::middleware('auth:sanctum')->group(function () {
    //StroyTime
    Route::post('/uploadstory',[StoryController::class,"uploadstory"]);
    Route::get('/getstories',[StoryController::class,"getstories"]);
    Route::post('/storyseen',[StoryController::class,"storyseen"]);
    Route::post('/likestory',[StoryController::class,"likestory"]);
    Route::post('/getviewers',[StoryController::class,"getviewers"]);
    Route::get('/getmyprofile',[UserController::class,"getmyprofile"]);
    //

    //Reels
    Route::post('/uploadreel',[ReelsController::class,"uploadreel"]);
    Route::get('/getreels',[ReelsController::class,"getreels"]);
    Route::post('/getreelbyid',[ReelsController::class,"getreelbyid"]);
    //

    //Relation
    Route::post('/follow',[FollowController::class,"follow"]);
    Route::post('/unfollow',[FollowController::class,"unfollow"]);
    //

    //Posts    
    Route::post('/uploadpost',[PostsController::class,"uploadpost"]);
    Route::get('/getposts',[PostsController::class,"getposts"]);
    Route::get('/notifiunseen',[PostsController::class,"notifiunseen"]);
    Route::post('/getpostbyid',[PostsController::class,"getpostbyid"]);
    //END

    //Home
    Route::post('/addlike',[HomeController::class,"addlike"]);
    Route::post('/addcomment',[HomeController::class,"addcomment"]);
    Route::post('/getcomment',[HomeController::class,"getcomment"]);
    Route::post('/replay',[HomeController::class,"replay"]);
    Route::post('/getreplies',[HomeController::class,"getreplies"]);
    Route::post('/likecomment',[HomeController::class,"likecomment"]);
    Route::post('/likereplay',[HomeController::class,"likereplay"]);
    Route::delete('/deletecomment/{id}',[HomeController::class,"deletecomment"]);
    Route::delete('/deletereplay/{id}',[HomeController::class,"deletereplay"]);
    Route::post('/uploaditemchat',[HomeController::class,"uploaditemchat"]);    
    Route::get('/searchuser/{id}',[HomeController::class,"searchuser"]);
    //END
    
    //Notification
    Route::get('/getnotifiy',[NotificationController::class,"getnotifiy"]);
    Route::put('/seennotify/{id}',[NotificationController::class,"seennotify"]);
    //

    //Profile
    Route::get('/getUserinfo/{id}',[ProfileController::class,"getUserinfo"]);
    Route::get('/getPostsuser/{id}',[ProfileController::class,"getPostsuser"]);
    Route::get('/getReelsuser/{id}',[ProfileController::class,"getReelsuser"]);
    //
});
