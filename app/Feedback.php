<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'feedback';
    protected $fillable = [
        'user_id','rating','review'
    ];

    public function user_detail()
    {
        return $this->hasOne('App\User','id','user_id');
    }

}
