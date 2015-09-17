<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model {

	protected $table = 'faculty.department_user';		
	protected $fillable = [];

	public function Person(){
		return $this->belongsTo('App\Models\Person', 'user_id');
	}

	/**
	 * Returns the academic department to which this user belongs.
	 *
	 * @return Builder|Model
	 */
	public function department() {
		return $this->belongsTo('App\Models\AcademicDepartment', 'department_id');
	}

}

