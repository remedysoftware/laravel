<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['body'];

    public function topic(){

        return $this->belongsTo('App\Models\Topic');
    }

    
    public function user(){

        return $this->belongsTo('App\Models\User');
    }



    
}
