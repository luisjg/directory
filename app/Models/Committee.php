<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model {

	/**
	 * The name of the table in the database
	 * @var string
	 */
	protected $table = 'faculty.connectable';
	/**
	 * The primary key in the table
	 * @var string
	 */
	protected $primaryKey = 'parent_entities_id';
	protected $fillable = [];

}
