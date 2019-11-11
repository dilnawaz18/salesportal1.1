<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'img_url',
        'web_url',
        'location_id',
        'industry_id'
    ];
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
