<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class VisaApplicantTemp extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "visa_applicant_temps";
    protected $fillable = [    'application_id','first_name','last_name','gender' ,
        'nationality', 'birthdate','birth_country','resident_country','visa_entry_id',
        'passport_number','passport_issue_date','passport_expiry_date','applicant_image',
        'passport_image','app_status','reason'
    ];
}
