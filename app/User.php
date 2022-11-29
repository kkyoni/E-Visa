<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Uuid;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'users';
    protected $fillable = [
    'name', 'email', 'password','status','user_type','avatar','created_at','unique_id','ref_id','role_id',
        'mobile','passport','passport_issue_date','passport_expiry_date','wpmobile','encrypt_password','social_status'
        ,'passport_photo','user_photo','avatar_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    'email_verified_at' => 'datetime',
    'avatar_date' => 'datetime',
    ];
    protected function castAttribute($key, $value)
    {
        if (! is_null($value)) {
            return parent::castAttribute($key, $value);
        }
        switch ($this->getCastType($key)) {
            case 'int':
            case 'integer':
            return (int) 0;
            case 'real':
            case 'float':
            case 'double':
            return (float) 0;
            case 'enum':
            return '';
            case 'string':
            return '';
            case 'bool':
            case 'boolean':
            return false;
            case 'object':
            case 'array':
            case 'json':
            return [];
            case 'collection':
            return new BaseCollection();
            case 'date':
            return $this->asDate('0000-00-00');
            case 'datetime':
            return $this->asDateTime('0000-00-00');
            case 'timestamp':
            return '';
            default:
            return $value;
        }
    }
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->unique_id = strtoupper(uniqid());
        });
    }
    public function referralCount()
    {
        return $this->hasMany(\App\Models\User::class,'ref_id','unique_id');
    }
    public function role(){
        return $this->hasOne(Role::class,'id','role_id');
    }
}
