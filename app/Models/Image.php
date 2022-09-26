<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

	/**
	 * The name of the table in the database
	 * @var string
	 */
	protected $table = 'faculty.images';

	/**
	 * The fillable attributes we want to fill
	 * @var [type]
	 */
	protected $fillable = ['imageable_id', 'imageable_type', 'src'];

}
