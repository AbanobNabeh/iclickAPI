<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'verifyotp';
    protected $fillable =[
     
        'email',
        'otp'
    ];
}
