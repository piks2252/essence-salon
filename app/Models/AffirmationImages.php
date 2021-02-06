<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AffirmationImages extends Model {

	use SoftDeletes;
	protected $table = "affirmation_images";
	protected $fillable = [
		'image_path'
	];

	protected $hidden = [
	];
}
