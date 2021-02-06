<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model {


	protected $table = "payment_transaction";
	protected $fillable = [
		'user_id','transaction_id','service_id','amount'
	];

	protected $hidden = [
	];

	public function getCreatedAtAttribute($value) {
        if($value != '' && $value != null){
            $date = date_create($value);
            return date_format($date, "d/m/Y");
        }
        return $value;
	}
	
	public function services()
    {
        return $this->belongsTo('App\Models\Service','service_id');
	}
	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
