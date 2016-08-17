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

	/**
	 * The hidden attributes we do not want to see
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	/**
	 * Returns the academic group associated with this department.
	 *
	 * @return Builder|Model
	 */
	public function academicGroup()
	{
		return $this->belongsTo('App\Models\AcademicGroup', 'college_id', 'department_id');
	}

	/**
	 * Retrieves the contacts that this academic group has
	 * @return Builder|Model
	 */
	public function contacts()
	{
		return $this->hasMany('App\Models\Contact', 'entities_id')->where('is_displayed', 1);
	}

	/**
	 * Retrieves the chairs that the academic group has
	 * @return Builder|Model
	 */
	public function chairs()
	{
		return $this->belongsToMany('App\Models\Person', 'department_user', 'department_id', 'user_id')->withPivot('role_name')->wherePivot('role_name', 'chair');
	}

}