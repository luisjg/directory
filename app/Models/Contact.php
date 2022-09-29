<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    /**
     * The name of the table in the database
     * @var string
     */
	protected $table='fresco.contacts';
    /**
     * The name of the primary key in the table
     * @var string
     */
    protected $primaryKey = 'contact_id';
	protected $fillable = [];
    /**
     * The hidden attributes we do not want to see
     * @var array
     */
    protected $hidden = array('contact_id', 'entities_id', 'parent_entities_id', 'created_at', 'updated_at');


    /**
     * Relates this Contact to its associated Person model.
     *
     * @return Builder
     */
	public function person()
    {
        return $this->belongsTo('App\Models\Person', 'entities_id', 'individuals_id')->where('confidential', 0);
    }

    /**
     * Relates this Contact to its associated ConnectableEntity model.
     *
     * @return Builder
     */
    public function contactDepartment()
    {
        return $this->belongsTo('App\Models\ConnectableEntity','parent_entities_id','connectable_id');
    }
}
