<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function book(){
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }
}
