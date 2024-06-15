<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    use HasFactory;
    protected $table = 'notification';

    public $timestamps = false;
    protected $fillable =[
        'id',
        'fromuser',
        'touser',
        'type',
        'link',
        'seen',
        'date',
        'type'
    ]; 

    public  function user(){
        return $this->hasOne(User::class,'id','fromuser');
    } 

    public  function post(){
        return $this->hasOne(PostModel::class,'id','link');
    } 
}