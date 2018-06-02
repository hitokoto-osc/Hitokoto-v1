<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hitokoto extends Model
{
    protected $table = 'sentence';
    public $timestamps = false;
    public function like_number()
    {
        return $this->hasMany('App\Like', 'sentenceID');
    }
}


