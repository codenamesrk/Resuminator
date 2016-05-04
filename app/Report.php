<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
   protected $fillable = ['user_id','resume_id','score','gen_remark', 'file'];
   
   public function parameters()
   {
   		return $this->belongsToMany('App\Parameter')->withPivot('score','remark')->withTimestamps();
   }

   public function user(){
   		return $this->belongsTo('App\User');
   }

   public function resume()
   {
   		return $this->belongsTo('App\Resume');
   }
   
}
