<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function location(){
        return $this->belongsTo('App\Location');
    }
    public function industry(){
        return $this->belongsTo('App\Industry');
    }
}
