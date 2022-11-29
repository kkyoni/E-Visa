<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class VisaApplication extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "visa_applications";
    protected $fillable = ['user_id','email','whatapp_number','arrival_date','departure_date' ,
        'service_type', 'total_price','gov_fee','tax','status','destination_country_id','from_country_id','application_no',
        'visa_type_id','visa_entry_id'
    ];

    public function visa_applicants()
    {
        return $this->hasMany(\App\VisaApplicant::class,'application_id','id')->with(['applicant_nationality','birthcountry','residentcountry']);
    }

    public function UserDetail()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function arrival_country()
    {
        return $this->hasOne('App\Country','id','arrival_country_id');
    }

    public function destination_country()
    {
        return $this->hasOne('App\Country','id','destination_country_id');
    }

    public function visatype()
    {
        return $this->hasOne('App\VisaType','id','visa_type_id');
    }

    public function visatypeentry()
    {
        return $this->hasOne('App\VisaTypeEntry','id','visa_entry_id');
    }
}
