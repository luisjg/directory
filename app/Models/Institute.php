<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model {
	/**
	 * The name of the table in the database
	 * @var string
	 */
	protected $table = 'faculty.connectable';

    /**
     * The hidden attributes on this model
     *
     * @var array
     */
	protected $hidden = [
	    'created_at',
        'updated_at'
    ];
}