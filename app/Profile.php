<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * Profile belongs to User
     * @return mixed
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
