<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $fillable = ['name'];
    
    public function reports()
    {
    	return $this->belongsToMany('App\Report')->withPivot('score','remark')->withTimestamps();
    }
}
