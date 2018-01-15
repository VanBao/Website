<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// use Laravel\Scout\Searchable;

class Product extends Model
{
    protected $table = "product";
    public function Category()
    {
    	return $this->belongsTo("App\Category", "category_id", "id");
    }
    public function BillDetail(){
    	return $this->hasMany('App\BillDetail', 'product_id', 'id');
    }
}
