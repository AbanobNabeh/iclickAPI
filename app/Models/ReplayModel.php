<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplayModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'replay';

    protected $fillable =[
        'id',
        'iduser',
        'repaly',
        'idcomment',
        'like',
        'date',
    ];

    public  function userinfo(){
        return $this->hasOne(User::class,'id','iduser');
    }   
}
