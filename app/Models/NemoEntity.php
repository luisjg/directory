<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NemoEntity extends Model {

	/**
	 * The name of the table in the database
	 * @var string
	 */
	protected $table = 'nemo.entities';


    /**
     * Set the primary key
     * @var string
     */
	protected $primaryKey = 'entities_id';

    /**
     * Turn the auto-incrementing
     * @var bool
     */
	public $incrementing = false;

}