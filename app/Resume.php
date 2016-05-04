<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
	protected $fillable = [ 'name', 'original_name', 'review_id', 'parent'];
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function review()
	{
		return $this->belongsTo('App\Review');
	}
	public function report()
	{
		return $this->hasOne('App\Report');
	}
	public function payment()
	{
		return $this->hasOne('App\Payment');
	}
}
