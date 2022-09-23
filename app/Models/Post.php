<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'content',
        'user_id',
        'classroom_id',
        'status'
    ];

    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id','id');
    }
    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
