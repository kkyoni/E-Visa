<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;

class Embassy extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "embassy";
    protected $fillable = [
        'country_id','embassy_id','address'
    ];
    public function embassy_country()
    {
        return $this->hasOne('App\Country','id','embassy_id');
    }

    public function country_list()
    {
        return $this->hasOne('App\Country','id','country_id');
    }
}
