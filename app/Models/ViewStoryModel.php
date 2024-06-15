<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewStoryModel extends Model
{
    use HasFactory;    
    public $timestamps = false;

    protected $table = 'viewstory';
    protected $fillable =[
        'iduser',
        'idstory',
        'like'
    ];

    public  function getuser(){
        return $this->belongsTo(User::class,'iduser','id');
    }   
}
