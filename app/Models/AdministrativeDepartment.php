<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeDepartment extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	//protected $table = \DB::table('departments')->where('')
	protected $table = \DB::table('administrativeDept')
		->join('nemo.departments', 'administrativeDept.departments_id', '=', 'departments.departments_id')
        ->join('nemo.academicDepartment_Department', 'administrativeDept.departments_id', '=', 'academicDepartment_Department.departments_id')
        ->select('administrativeDept.*')
            ->get();

	/**
	 * Primary key in the table relationship.
	 *
	 * @var string
	 */
	protected $primaryKey = 'department_id';
	protected $hidden = array('created_at', 'updated_at');


}