<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Student extends Model {
	protected $table = 'Student';
	protected $fillable = ['regiNo',
	'family_id',
	'firstName',
	'lastName',
	'middleName',
	'gender',
	'religion',
	'bloodgroup',
	'nationality',
	'dob',
	'session',
	'class',
	'curriculum_id', // Beira Unida: Curriculum selection
	'photo',
	'fatherName',
	'fatherCellNo',
	'motherName',
	'motherCellNo',
	'presentAddress',
	'parmanentAddress',
	'guardian_name',
	'guardian_contact',
	'church_community'
];

/**
 * Get the curriculum this student follows
 */
public function curriculum()
{
	return $this->belongsTo(\App\Models\Curriculum::class, 'curriculum_id');
}

protected $primaryKey = 'id';
public function attendance(){
	$this->primaryKey = "regiNo";
	return $this->hasMany('App\Attendance','regiNo');
}

}
