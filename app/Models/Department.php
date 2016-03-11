<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Person;

class Department extends Model {
	protected $table = 'nemo.departments';
	protected $primaryKey = 'department_id';
}