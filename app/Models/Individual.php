<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Individual extends Model {

	/**
	 * The name of the table in the database
	 * @var string
	 */
	protected $table = 'nemo.individuals';

    /**
     * Change the primary key
     * @var string
     */
	protected $primaryKey = 'individuals_id';

    /**
     * Turn off the auto-incrementing feature
     * @var bool
     */
	public $incrementing = false;

}