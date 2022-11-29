<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Price extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "prices";
    protected $fillable = [    'country_id','status','visa_type_id','amount'   ];

    public function country_list()
    {
        return $this->hasOne('App\Country','id','country_id');
    }

    public function visatype()
    {
        return $this->hasOne('App\VisaType','id','visa_type_id');
    }
}
