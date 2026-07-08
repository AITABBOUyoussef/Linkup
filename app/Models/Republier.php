<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Republier extends Model
{
     protected $fillable = [
        'reposted_by',
        'post_id',
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
    public  function user(){
        return $this->belongsTo(user::class, 'reposted_by');
    }
}
