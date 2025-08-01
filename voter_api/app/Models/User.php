<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private $id;
    private $user_name;
    private $user_id;
    private $password;

    protected $guarded = ['id'];
    protected $hidden = [
        "inforce","created_at","updated_at",'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
    public function user_category(){
        return $this->belongsTo(userCategory::class,'user_cat_id');
    }
    public function user_type(){
        return $this->belongsTo('App\Models\UserType','user_type_id');
    }
    public function employee(){
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
    public function organisation(){
        return $this->belongsTo(Organisation::class,'organisation_id');
    }
}
