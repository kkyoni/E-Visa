<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class FromCountry extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'from_countries';
    protected $fillable = [
        'country_visa_id','from_country_id'
    ];


    public function countryfromcountrywise()
    {
        return $this->belongsTo('App\CountryWiseVisa');
    }

    public function country(){
        return $this->hasOne(Country::class,'id','from_country_id');
    }

    public function CountryWiseVisa(){
        return $this->hasOne(CountryWiseVisa::class,'id','country_visa_id')->with(['visatype']);
    }

    public function country_visa_fee(){
        return $this->hasOne(CountryVisaFee::class,'country_visa_id','country_visa_id')->with(['visatypeentry']);
    }
}
