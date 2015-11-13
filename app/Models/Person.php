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

}