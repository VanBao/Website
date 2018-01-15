<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    public function Bill()
    {
    	return $this->hasMany("App\Bill", "customer_id","id");
    }
}
