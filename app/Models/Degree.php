<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model {

    /**
     * The name of the table in the database
     * @var string
     */
	protected $table='nemo.degrees';
    /**
     * The name of the primary key in the table
     * @var string
     */
    protected $primaryKey = 'degrees_id';
	protected $fillable = [];
    /**
     * The hidden attributes we do not want to see
     * @var array
     */
    protected $hidden = array('degrees_id', 'individuals_id', 'created_at', 'updated_at');

    /**
     * Relates this Degree to its associated Person model.
     *
     * @return Builder
     */
	public function person()
    {
        return $this->belongsTo('App\Models\Person', 'entities_id', 'individuals_id')->where('confidential', 0);
    }

}