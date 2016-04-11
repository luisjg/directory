<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;
use Request;
use App\Models\Department;
use App\Models\AcademicDepartment;
use App\Models\Contact;
use App\Models\Person;
use App\Models\Center;

class CenterController extends Controller {

	public function showAllCenters() {
		$centers = Center::where('connectable_id', 'LIKE', 'centers:%')->get();
		$data = $centers->toArray();
		return $this->sendResponse($data, "centers");
	}

	public function showSpecificCenter($center_id) {
		$centers = Center::where('connectable_id', 'LIKE', 'centers:'.$center_id)->first();
		$data = $centers->toArray();
		return $this->sendResponse($data);
	}

	public function showMembers($center_id) {
		$people = Person::whereHas('entityUser', function($q) use ($center_id) {
			$q->where('parent_entities_id', 'centers:'.$center_id);
		})->with('contacts')
		->get();

		$data = $people->toArray();
		return $this->sendResponse($data);
	}
}