<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;
    protected $table = 'posts';

    public $timestamps = false;
    protected $fillable =[
        'id',
        'iduser',
        'image',
        'likes',
        'date'
    ]; 

    public  function user(){
        return $this->hasOne(User::class,'id','iduser');
    } 
}
