<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeDepartment extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'nemo.departments';

	/**
	 * Primary key in the table relationship.
	 *
	 * @var string
	 */
	protected $primaryKey = 'entities_id';

    /**
     * Turn off auto-incrementing feature
     *
     * @var bool
     */
	public $incrementing = false;
	
	/**
	 * The hidden attributes we do not want to see
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');
	
	/**
	 * Returns the persons related to this administrative deparment
	 * @return Builder|Model
	 */
	public function person()
	{
		return $this->hasMany('App\Models\Person', 'parent_entities_id');
	}

}