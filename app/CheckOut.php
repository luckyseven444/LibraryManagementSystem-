<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
  protected $table = 'checkouts';
  protected $guarded = [];

  public function stocks(){
      return $this->belongsTo('App\Stock', 'stock_id', 'id');
  }
}
