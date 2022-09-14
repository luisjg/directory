<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Center extends Model {
	/**
	 * The name of the table on the database
	 * @var string
	 */
	protected $table = 'faculty.connectable';

    /**
     * Hidden attributes
     *
     * @var array
     */
	protected $hidden = [
	    'created_at',
        'updated_at'
    ];
}