<?php
namespace App\Models;
class Institute extends \Eloquent {
	protected $table = 'institute';
	protected $fillable = [
		'name',
		'alternate_name_en',
		'alternate_name_pt',
		'establish',
		'email',
		'web',
		'phoneNo',
		'address',
		'vision_en',
		'vision_pt',
		'mission_en',
		'mission_pt',
		'motto_en',
		'motto_pt',
		'nuit',
		'facebook',
		'logo'
	];
}
