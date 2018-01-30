<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
      protected $fillable = ['title','category', 'user_id', 'active'];
    //
    public function user(){
      return $this->belongsTo('App\User');
    }
}
