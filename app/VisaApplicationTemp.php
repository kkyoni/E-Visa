<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class VisaApplicationTemp extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "visa_application_temps";
    protected $fillable = ['email','whatapp_number','arrival_date','departure_date' ,
        'service_type', 'total_price','gov_fee','tax','app_status','destination_country_id','from_country_id','application_no',
        'visa_type_id','visa_entry_id'
    ];

    public function visa_applicant_temp()
    {
        return $this->hasMany(\App\VisaApplicantTemp::class,'application_id','id');
    }
}
