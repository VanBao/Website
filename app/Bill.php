<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
	protected $table = "bill";
	public function Customer()
	{
		return $this->belongsTo("App\Customer", "customer_id", "id");
	}
	public function BillDetail()
	{
		return $this->hasMany("App\BillDetail", "bill_id", "id");
	}
}
