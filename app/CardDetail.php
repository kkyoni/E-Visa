<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CardDetail extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "card_details";
    protected $fillable = [
        'user_id','card_type','card_number','card_holder_name','card_expiry_month','card_expiry_year','card_name','cvv'
    ];
}
