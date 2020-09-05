<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Point extends Pivot
{
	protected $table = 'point';

	protected $fillable = [
		'student_id',
		'subject_id',
		'point',
		'type_exam'
	];

	public $timestamps = false;

	public function student()
	{
		return $this->belongsTo('App\Models\Student', 'student_id');
	}

	public function subject()
	{
		return $this->belongsTo('App\Models\Subject', 'subject_id');
	}
}
