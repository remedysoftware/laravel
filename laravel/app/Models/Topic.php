<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
        protected $table = 'topics';
    
        protected $fillable = ['topic_name', 'topic_body', 'topic_tags', 'topic_image', 'delete', 'categories', 'topic_full_body_text', 'admin_id'];


        // public function user(){
                
        //         return $this->belongsTo('App\Models\User');
        // }

        // public function comments(){
                
        //         return $this->hasMany('App\Models\Comment');
        // }
        
}
