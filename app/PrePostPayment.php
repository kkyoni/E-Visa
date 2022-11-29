<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrePostPayment extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "pre_post_payment";
    protected $fillable = [
        'u_id','question','answer','add_droup','note','proceed','tooltip','payment_status','status','answer_type','last_question',
        'sub_question','sub_ans_type','sub_note','sub_tooltip','sub_proceed','sub_add_drop','last_ans_type'
    ];
     public function pre_country()
    {
        return $this->hasOne('App\PaymentCountry','id','u_id')->with(['country','pre_visa_list']);
    }


    public function sub_question()
    {
        return $this->belongsTo('App\AdminSubQuestion','id','subque_id');
    }
}
