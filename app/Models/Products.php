<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Company;
use App\Models\Category;

class Products extends Model {

	use SoftDeletes;
	protected $table = "products";
	protected $fillable = [
		'name', 'category_id', 'company_id', 'color', 'watt', 'price', 'dimention', 'lumens_output', 'beam_angle', 'body_colour', 'quantity'];

	protected $hidden = [
	];

	public function categories()
	{
	    return $this->hasOne(Category::class, 'id', 'category_id');
	}
	

	public function companies()
	{
	    return $this->hasOne(Company::class, 'id', 'company_id');
	}

}
