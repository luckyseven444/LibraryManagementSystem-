<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    public function author(){
        return $this->belongsTo('App\Author','author_id', 'id');
    }

    public function genre(){
        return $this->belongsTo('App\Genre','genre_id', 'id');
    }
}
