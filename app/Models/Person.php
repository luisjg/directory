<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

	protected $table = 'fresco.people';			
	protected $primaryKey = 'individuals_id';
	protected $fillable = [];

	public function departmentUser() {
		return $this->hasMany('App\Models\DepartmentUser', 'user_id');
	}

	public function contacts(){
		return $this->hasMany('App\Models\Contact', 'entities_id');
	}

	public function image() {
		return $this->hasOne('App\Models\Image', 'imageable_id');
	}

	public function getEmailURIAttribute() {
	    return strtok($this->email, '@');
	}

	public function scopeFindMembersByDepartment($query, $dept_id) {
		return $query->whereHas('departmentUser', function($q) use ($dept_id) {
			$q->where('department_id', 'academic_departments:'.$dept_id);
		});
	}
		public function departments() {
			return $this->belongsToMany('App\Models\AcademicDepartment', 'department_user', 'user_id','department_id');
	}

	// public function getRankAttribute($value) {
	// 	if ($value == null) {
	// 		return $value = 'Staff';
	// 	}
	// 	else {
	// 		return $value;
	// 	}
	// }
}