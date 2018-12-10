<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['topic_id', 'user_id', 'body'];

    public function topic() {
        return $this->belongsTo('\App\Topic');
    }

    public function owner() {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }

}
