<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function resume()
    {
    	return $this->hasOne('App\Resume');
    }
}
