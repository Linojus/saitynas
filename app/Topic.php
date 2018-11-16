<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['user_id', 'title', 'body'];

    public function posts() {
        return $this->hasMany('\App\Post');
    }

    public function owner() {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }

}
