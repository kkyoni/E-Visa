<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
class CountryEmbassy extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "country_embassy";
    protected $fillable = [
    'country_id'
    ];

    public function country()
    {
         return $this->hasOne('App\Country','id','country_id');
    }
}