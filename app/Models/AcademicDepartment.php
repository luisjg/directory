<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Person;

class AcademicDepartment extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'faculty.departments';

	/**
	 * Primary key in the table relationship.
	 *
	 * @var string
	 */
	protected $primaryKey = 'department_id';
	protected $hidden = array('created_at', 'updated_at');

	/**
	 * Returns the academic group associated with this department.
	 *
	 * @return Builder|Model
	 */
	public function academicGroup() {
		return $this->belongsTo("App\Models\AcademicGroup", "college_id", "department_id");
	}

	public function contacts() {
		return $this->hasMany('App\Models\Contact', 'entities_id');
	}

	public function chairs() {
		// return $this->belongsToMany('App\Models\Person', 'department_user', 'department_id', 'user_id')->where('role_name', 'chair');
		return $this->belongsToMany('App\Models\Person', 'department_user', 'department_id', 'user_id')->withPivot('role_name')->wherePivot('role_name', 'chair');
	}

}