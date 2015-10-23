<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;

use App\Models\AdministrativeDepartment;
use App\Models\Contact;
use App\Models\Person;

class AdministrativeDepartmentController extends Controller {

	/**
	 * Returns a listing of all people in the specified committee.
	 *
	 * @param string $committee_id The short ID of the committee
	 * @return Response
	 */
	public function showPeople($dept_id) {
		$persons = Contact::whereHas('departmentUser', function($q) use ($dept_id) {
			$q->where('entities_id', 'departments:'.$dept_id);
		})
		// GRAB THE IMAGE
		->with('image')
		// ONLY LOAD THE DEPARTMENT REQUESTED (makes using first() ok below)
		->with(['departmentUser' => function($q) use ($dept_id) {
			$q->where('entities_id', 'academic_departments:'.$dept_id);
		}])
		->orderBy('last_name')->orderBy('first_name')
		->get();

		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $persons->toArray();

		// send the response
		return $this->sendResponse($data);
	}

}