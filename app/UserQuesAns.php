<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserQuesAns extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "user_ques_ans";
    protected $fillable = [ 'application_id','user_id','question_id','answer','status',
        'sub_que','sub_ans','last_que','last_ans'
        ];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
