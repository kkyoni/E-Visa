<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class AdminSubQuestion extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "admin_sub_questions";
    protected $fillable = [
        'subque_id','sub_note','sub_tooltip','sub_proceed','sub_question','sub_answer_type','sub_add_droup','sub_add_drop','last_ans_type'
    ];
}
