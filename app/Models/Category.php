<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Category extends Model {

	use SoftDeletes;
	protected $table = "category";
	protected $fillable = [
		'name'
	];

	protected $hidden = [
	];
}
