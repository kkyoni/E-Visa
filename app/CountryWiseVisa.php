<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CountryWiseVisa extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "country_wise_visas";
    protected $fillable = [
        'country_id','visa_type_id','country_from_id','visa_type_entry_id','visa_validity','stay_validity','regular_service_cost','express_service_cost'
        ,'express_gov_fee','regular_gov_fee','regular_service_type','express_service_type','information','required_docs','status','favourite_status','processing_days'
    ];

    public function visatype()
    {
        return $this->hasOne('App\VisaType','id','visa_type_id');
    }

    public function visatypeentry()
    {
        return $this->hasOne('App\VisaTypeEntry','id','visa_type_entry_id');
    }

    public function country()
    {
        return $this->hasOne('App\Country','id','country_id');
    }
    public function country_from()
    {
        return $this->hasOne('App\Country','id','country_from_id');
    }


    public function CountryVisa()
    {
        return $this->hasMany(CountryVisaFee::class,'country_visa_id','country_visa_id')->with('visatypeentry');
    }

    public function from_country()
    {
        return $this->hasMany(FromCountry::class,'country_visa_id','id');
    }

    public function countryvisafee()
    {
        return $this->hasMany(CountryVisaFee::class,'country_visa_id','id');
    }

}
