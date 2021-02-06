<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AffirmationQuotes extends Model {

	use SoftDeletes;
	protected $table = "affirmation_quotes";
	protected $fillable = [
		'message'
	];

	protected $hidden = [
	];
}
