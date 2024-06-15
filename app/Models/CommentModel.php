<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'comment';

    protected $fillable =[
        'id',
        'iduser',
        'comment',
        'link',
        'like',
        'type',
        'date',
    ];

    public  function userinfo(){
        return $this->hasOne(User::class,'id','iduser');
    }   
}