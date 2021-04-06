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

	protected $hidden = [
	    'entities_id',
        'posix_uid'
    ];

}
