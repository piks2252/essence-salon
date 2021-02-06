<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreTableDetail extends Model {

	protected $table = "store_table_details";
	protected $fillable = [
		'user_id','message','category_id'
	];

	protected $hidden = [
	];
}
