<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
     use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'faqs';
    protected $fillable = [
        'question','answer','order_by','status', 'country_id', 'visa_type_id'
    ];

    public function country()
    {
        return $this->hasOne('App\Country','id','country_id');
    }

    public function visatype()
    {
        return $this->hasOne('App\VisaType','id','visa_type_id');
    }
}
