<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
   protected $table = 'course';

   protected $fillable = [
   		'course_name', 
   		'begin', 
   		'end'
   ];

   public $timestamps = false;

   public function array_classes()
   {
   		return $this->hasMany('App\Models\Classes', 'course_id', 'id');
   }
}
