<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowersModel extends Model
{
    use HasFactory;
    protected $table = 'followers';
    public $timestamps = false;
    protected $fillable =[
        'id',
        'fromuser',
        'touser',
    ];

    public  function userto(){
        return $this->belongsTo(User::class,'touser','id');
    }   
     public  function userfrom(){
        return $this->belongsTo(User::class,'fromuser','id');
    } 
  
}
