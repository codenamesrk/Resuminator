<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function resume()
    {
    	return $this->belongsTo('App\Resume');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
