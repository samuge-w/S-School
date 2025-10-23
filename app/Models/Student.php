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

protected $primaryKey = 'id';
public function attendance(){
	$this->primaryKey = "regiNo";
	return $this->hasMany('App\Attendance','regiNo');
}

}
