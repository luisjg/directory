<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model {

	/**
	 * The name of the table in the database
	 * @var string
	 */
	protected $table = 'faculty.department_user';

	/**
	 * the primary key in the table
	 * @var string
	 */
	protected $primaryKey = 'user_id';

	protected $hidden = [
	    'user_id'
    ];

	/**
	 * The person relationship that department user has
	 * .
	 * @return Builder|Model
	 */
	public function Person()
	{
		return $this->belongsTo('App\Models\Person', 'user_id');
	}

	/**
	 * Returns the academic department to which this user belongs.
	 *
	 * @return Builder|Model
	 */
	public function department()
	{
		return $this->belongsTo('App\Models\AcademicDepartment', 'department_id');
	}
}

