<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CountryVisaFee extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "country_visa_fees";
    protected $fillable = [
        'country_visa_id','visa_type_entry_id','regular_gov_fee','express_gov_fee','vat_tax',
        'regular_service_type','visa_validity','stay_validity','service_fee','processing_day'
    ];

    public function country()
    {
        return $this->hasOne('App\Country','id','country_id');
    }

    public function visatypeentry()
    {
        return $this->hasOne('App\VisaTypeEntry','id','visa_type_entry_id');
    }
}
