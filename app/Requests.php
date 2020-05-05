<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class Requests extends Model
{
    protected $table = 'requests';
    public $primarykey = 'id';
    public $timestamps = true;

    public function users(){
        return $this->belongsTo('App\User', 'user');
    }

    public function posts(){
        return $this->belongsTo('App\Post', 'post');
    }
}
