<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectableEntity extends Model {
	/**
	 * The name of the table in the database
	 * @var string
	 */
    protected $table='faculty.connectable';
    /**
     * The name of the primary key in the table
     * @var string
     */
    protected $primaryKey = 'connectable_id';
    protected $fillable = [];
}
