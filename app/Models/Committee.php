<?php namespace App\Models;

class Committee extends Model {

	protected $table = 'nemo.entities';			
	protected $primaryKey = 'entities_id';
	protected $fillable = [];

	/**
	 * Returns the Person records associated with this Committee.
	 *
	 * @return Builder|Model
	 */
	public function people() {
		return $this->belongsToMany('App\Models\Person', 'nemo.memberships', 'parent_entities_id', 'individuals_id')
			->withPivot('role_position', 'description', 'member_status')
			->where('nemo.memberships.confidential', 0); // make sure "confidential" records are not included
	}
}