<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReelsModel extends Model
{
    use HasFactory;
    protected $table = 'reels';
    protected $fillable =[
        'id',
        'iduser',
        'video',
        'caption',
        'like',
        'comment',
        'share',
    ];   
    public  function user(){
        return $this->hasOne(User::class,'id','iduser');
    } 
}
