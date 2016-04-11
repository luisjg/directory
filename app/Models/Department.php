<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Person;

class Department extends Model {
	/**
	 * The name of the table in the database
	 * @var string
	 */
	protected $table = 'nemo.departments';

	/**
	 * The name of the primary key in the table
	 * @var string
	 */
	protected $primaryKey = 'department_id';
}