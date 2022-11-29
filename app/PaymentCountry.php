<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentCountry extends Model
{
 	use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "payment_country";
    protected $fillable = [
    'country_id','visa'
    ];
    public function country()
    {
        return $this->hasOne('App\Country','id','country_id');
    }
    public function pre_list()
    {
        return $this->hasMany(\App\PrePostPayment::class,'u_id','id')->with(['sub_question']);
    }

    public function pre_visa_list()
    {
        return $this->hasOne('App\VisaType','id','visa');
    }
}
