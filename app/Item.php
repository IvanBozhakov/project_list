<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";
    public $timestamps = false;

    public function country_object()
    {
    	return $this->hasOne('App\Country', 'id', 'country');
    }
}
