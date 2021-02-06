<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Models\AffirmationQuotes;

class User extends Authenticatable implements JWTSubject
{
    // use SoftDeletes;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'gender', 'date_of_birth', 'profile_img', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function setDateOfBirthAttribute($value) {
		if($value != '' && $value != null){
            // $date = date_create($value);
            $format_date=explode('/', $value);
            $new_date_arr=array($format_date[2],$format_date[1],$format_date[0]);
            $new_date= implode("-",$new_date_arr);
            $this->attributes['date_of_birth'] = $new_date;
        } else{
            $this->attributes['date_of_birth'] = $value;
        }
	}

	public function getDateOfBirthAttribute($value) {
        if($value != '' && $value != null){
            $date = date_create($value);
            return date_format($date, "d/m/Y");
        }
        return $value;
    }
    public function deviceToken()
    {
        return $this->hasMany('App\Models\DeviceToken');
    }
}
