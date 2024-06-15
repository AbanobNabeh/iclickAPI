<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatListModel extends Model
{
    use HasFactory;

    
    public $timestamps = false;
    protected $table = 'chatlist';

    protected $fillable =[
        'id',
       'fromuser',
       'touser',
       'lastmsg',
       'seen',
       'date',
    ];


}
