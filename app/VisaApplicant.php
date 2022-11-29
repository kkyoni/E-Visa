<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class VisaApplicant extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "visa_applicants";
    protected $fillable = [    'application_id','first_name','last_name','gender' ,
            'nationality', 'birthdate','birth_country','resident_country','visa_entry_id',
            'passport_number','passport_issue_date','passport_expiry_date','applicant_image',
            'passport_image','status','reason'
        ];

    public function visa_application()
    {
        return $this->hasOne('App\VisaApplication','id','application_id');
    }

    public function visaentry()
    {
        return $this->hasOne('App\VisaTypeEntry','id','visa_entry_id');
    }

    public function applicant_nationality()
    {
        return $this->hasOne('App\Country','id','nationality');
    }

    public function birthcountry()
    {
        return $this->hasOne('App\Country','id','birth_country');
    }

    public function residentcountry()
    {
        return $this->hasOne('App\Country','id','resident_country');
    }
}
