<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','verification_code','ip',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'last_login', 'ip'
    ];

    /**
     * User has one Profile
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
    
    /**
     * User has many resumes
     * @return [type] [description]
     */
    public function resumes()
    {
        return $this->hasMany('App\Resume')->orderBy('review_id');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
