<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

	/**
	 * The name of the table in the database
	 * @var string
	 */
	protected $table = 'fresco.people';
	
	/**
	 * The primary key in the table
	 * @var string
	 */
	protected $primaryKey = 'individuals_id';
	protected $fillable = [];

	public $incrementing = false;

	protected $appends = [
	    'profile_image'
    ];

	/**
	 * Returns the departments this user belongs to along with the
	 * confidential flag
	 * @return Builder|Query
	 */
	public function departmentUser()
	{
		return $this->hasMany('App\Models\DepartmentUser', 'user_id')->where('confidential', 0);
	}

	/**
	 * Returns the entity this person belongs to
	 * @return Builder|model
	 */
	public function entityUser()
	{
		return $this->hasMany('App\Models\EntityUser', 'user_id')->where('confidential', 0);
	}


	/**
	 * Returns the contact information this person has
	 * @return Builder|Model
	 */
	public function contacts()
	{
		return $this->hasMany('App\Models\Contact', 'entities_id')->where('is_displayed', 1);
	}

	/**
	 * Returns the image this person has
	 * @return Builder|Model
	 */
	public function image()
	{
		return $this->hasOne('App\Models\Image', 'imageable_id');
	}

	/**
	 *Returns the degrees this person has
	 *@return Builder/Model
	 */

	public function degrees()
	{
		return $this->hasMany('App\Models\Degree', 'individuals_id')->orderBy('year', 'asc');
	}

	/**
	 * Returns the email address up until the 2 symbol of this person
	 * @return Builder|Model
	 */
	public function getEmailURIAttribute()
	{
	    return strtok($this->email, '@');
	}

	/**
	 * Builds the query of finding a member by department id
	 * @param  Builder $query   the query we want to build
	 * @param  String $dept_id the department short string
	 * @return Query the built query we want
	 */
	public function scopeFindMembersByDepartment($query, $dept_id)
	{
		return $query->whereHas('departmentUser', function($q) use ($dept_id) {
			$q->where('department_id', 'academic_departments:'.$dept_id);
		});
	}
	
	/**
	 * Retrieves the departments this person is associated with
	 * @return Builder|Model
	 */
	public function departments()
	{
		return $this->belongsToMany('App\Models\AcademicDepartment', 'department_user', 'user_id', 'department_id');
	}

    /**
     * Retrieve the image url for the given person
     *
     * @return string
     */
	public function getProfileImageAttribute()
    {
        // we'll just use media now
        //$image = Image::where('imageable_id', $this->individuals_id)->first();
        if($this->affiliation !== 'student' || $this->affiliation !== 'staff')
        {
            return env('IMAGE_VIEW_LOCATION').$this->getEmailURIAttribute().'/avatar';
        }
    }
}