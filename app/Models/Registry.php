<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registry extends Model {

	/**
	 * The name of the table in the database
	 * @var string
	 */
	protected $table = 'bedrock.registry';

    /**
     * Set the primary key
     * @var string
     */
	protected $primaryKey = 'registry_id';

    /**
     * Turn of the auto-incrementing feature
     * @var bool
     */
	public $incrementing = false;

}