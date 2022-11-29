<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "transactions";
    protected $fillable = [ 'order_id','user_id','transaction_id','payment_status','payment_type'  ];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function visa_application()
    {
        return $this->hasOne('App\VisaApplication','id','order_id')->with('visa_applicants');
    }
}
