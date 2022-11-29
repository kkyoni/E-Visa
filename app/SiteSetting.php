<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_setting';
    protected $fillable = ['meta_key','meta_value'];
}
