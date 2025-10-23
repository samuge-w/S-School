<?php
namespace App\Models;
class Subject extends \Eloquent {
	protected $table = 'Subject';
protected $fillable = ['name','description','class','gradeSystem','curriculum_id'];
	
	/**
	 * Get the curriculum this subject belongs to
	 */
	public function curriculum()
	{
		return $this->belongsTo(Curriculum::class);
	}
}
