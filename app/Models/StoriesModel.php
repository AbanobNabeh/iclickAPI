<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoriesModel extends Model
{
    use HasFactory;
    protected $table = 'stories';
    public $timestamps = false;
    protected $fillable =[
        'id',
        'iduser',
        'image',
        'video',
        'date'
    ]; 
    public  function view(){
        return $this->hasMany(ViewStoryModel::class,'idstory','id');
    }
    
}