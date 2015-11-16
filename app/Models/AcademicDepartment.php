<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

	public function person(){
		return $this->hasMany('App\Models\Person','parent_entities_id');
	}
	public function contacts(){
		return $this->hasMany('App\Models\Contact','department');
	}
}