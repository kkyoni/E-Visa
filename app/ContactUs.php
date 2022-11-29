<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ContactUs extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "contact_us";
    protected $fillable = [
        'name','email','contact_no','country','message','admin_read'
    ];

    public function country_list()
    {
        return $this->hasOne('App\Country','id','country');
    }
}
