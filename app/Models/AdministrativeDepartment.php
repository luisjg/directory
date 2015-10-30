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
	protected $table = 'nemo.departments';

	/**
	 * Primary key in the table relationship.
	 *
	 * @var string
	 */
	protected $primaryKey = 'entities_id';
	protected $hidden = array('created_at', 'updated_at');
	public function person(){
		return $this->hasMany('App\Models\Person', 'parent_entities_id');
	}

}