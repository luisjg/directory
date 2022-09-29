<?php

namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;
use App\Http\Controllers\Controller;
use App\Models\AcademicDepartment;
use App\Models\AdministrativeDepartment;
use App\Models\Contact;
use App\Models\Department;
use App\Models\Person;
use Request;

class DepartmentController extends Controller {

	/**
	 * Display a listing of the people in the given department.
	 *
	 * @param integer $dept_id The ID of the academic department
	 * @return JSON Response
	 */
	public function showAllMembersInDepartment($dept_id) {

		$people = Person::with('contacts')->where('parent_entities_id', 'departments:'.$dept_id)
			->where('confidential', 0)
			->orderBy('last_name')->orderBy('first_name')
			->get();
		
		if ($people->isEmpty()) {
			$people = Person::where('confidential', 0)
					->with(['departmentUser' => function($q) use ($dept_id) {
						$q->where('department_id', 'academic_departments:'.$dept_id);
					}], 'image')
					->whereHas('departmentUser', function($q) use ($dept_id) {
						$q->where('department_id', 'academic_departments:'.$dept_id);
					})
					->orderBy('last_name')
					->orderBy('first_name')
					->get();
		}
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $people->toArray();
		// send the response
		return $this->sendResponse($data, "people");
	}

	/**
	 * Display a listing of the graduate coordinator in the given department.
	 *
	 * @param integer $dept_id The ID of the academic department
	 * @return JSON Response
	 */
	public function showGradCoordinatorInDepartment($dept_id) {

		$people = Person::where('confidential', 0)
					->whereHas('departmentUser', function($q) use ($dept_id) {
						$q->where('department_id', 'academic_departments:'.$dept_id)
							->where('role_name', 'grad_coordinator');
					})
					->firstOrFail();

		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $people->toArray();
		// send the response
		return $this->sendResponse($data, "person");
	}

	/**
	 * Display a full or partial listing of the faculty members in the given department.
	 *
	 * @param integer $dept_id The ID of the academic department, optional $type for type of faculty
	 * @return JSON Response
	 */
	public function showFacultyInDepartment($dept_id, $type=null) {

        if ($type == null || $type == 'all') {
            //All faculty or nothing specific requested
            $people = Person::where('confidential', 0)
                ->whereHas('departmentUser', function ($q) use ($dept_id) {
                    $q->where('department_id', 'academic_departments:' . $dept_id)
                        ->whereIn('role_name', ['faculty', 'librarian', 'counselor', 'coach']);
                })
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == 'tenure-track') {
            // Active tenured/tenure-track faculty requested
            $people = Person::where('confidential', 0)
                ->whereHas('departmentUser', function ($q) use ($dept_id) {
                    $q->where('department_id', 'academic_departments:' . $dept_id)
                        ->whereIn('role_name', ['faculty', 'librarian', 'counselor', 'coach'])
                        ->whereNotIn('rank', ['Lecturer']);
                })
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == 'emeriti') {
            // Emeriti requested
            $people = Person::where('confidential', 0)
                ->whereHas('departmentUser', function ($q) use ($dept_id) {
                    $q->where('department_id', 'academic_departments:' . $dept_id)
                        ->whereIn('role_name', ['emeritus']);
                })
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == 'lecturer') {
            // Lecturers requested
            $people = Person::where('confidential', 0)
                ->whereHas('departmentUser', function ($q) use ($dept_id) {
                    $q->where('department_id', 'academic_departments:' . $dept_id)
                        ->whereIn('role_name', ['faculty', 'librarian', 'counselor', 'coach'])
                        ->whereIn('rank', ['Lecturer']);
                })
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else {
            //Invalid subset requested
            $people = collect();
        }

		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $people->toArray();
		// send the response
		return $this->sendResponse($data, "people");
	}

    /**
     * Display a full or partial listing of the faculty members in the given department with degree information
     *
     * @param integer $dept_id The ID of the academic department, optional $type for type of faculty
     * @return JSON Response
     */
    public function showFacultyInDepartmentWithDegrees($dept_id, $type) {

        if ($type == 'all') {
	        // All faculty requested
            $people = Person::where('confidential', 0)
                ->whereHas('departmentUser', function($q) use ($dept_id) {
                    $q->where('department_id', 'academic_departments:'.$dept_id)
                        ->whereIn('role_name', ['faculty', 'librarian', 'counselor', 'coach']);
                })
                ->with('degrees')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == 'tenure-track') {
            // Active tenured/tenure-track faculty requested
            $people = Person::where('confidential', 0)
                ->whereHas('departmentUser', function ($q) use ($dept_id) {
                    $q->where('department_id', 'academic_departments:' . $dept_id)
                        ->whereIn('role_name', ['faculty', 'librarian', 'counselor', 'coach'])
                        ->whereNotIn('rank', ['Lecturer']);
                })
                ->with('degrees')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == 'emeriti') {
            // Emeriti requested
            $people = Person::where('confidential', 0)
                ->whereHas('departmentUser', function ($q) use ($dept_id) {
                    $q->where('department_id', 'academic_departments:' . $dept_id)
                        ->whereIn('role_name', ['emeritus']);
                })
                ->with('degrees')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else if ($type == 'lecturer') {
            // Lecturers requested
            $people = Person::where('confidential', 0)
                ->whereHas('departmentUser', function ($q) use ($dept_id) {
                    $q->where('department_id', 'academic_departments:' . $dept_id)
                        ->whereIn('role_name', ['faculty', 'librarian', 'counselor', 'coach'])
                        ->whereIn('rank', ['Lecturer']);
                })
                ->with('degrees')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get();
        } else {
            //Invalid subset requested
            $people = collect();
        }

        // convert the collection to an array for use in returning the
        // desired response as JSON
        $data = $people->toArray();
        // send the response
        return $this->sendResponse($data, "people");
    }

	/**
	 * Returns all academic departmentUser
	 * @return JSON Response
	 */
	public function showAllDepartments() {
		// return all the academic departments
		$academicDepts = AcademicDepartment::where('entity_type', 'Academic Department')	
			->get();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $academicDepts->toArray();

		// send the response
		return $this->sendResponse($data, "departments");
	}

	/**
	 * Shows all the administrative departmens
	 * @return JSON Response
	 */
	public function showAllAdministrativeDepartments() {
		$administrativeDept = AdministrativeDepartment::all();
		$data = $administrativeDept->toArray();
		return $this->sendResponse($data, "departments");
	}

	/**
	 * Returns a specific department by $dept_id
	 * @param  String $dept_id 
	 * @return JSON Response
	 */
	public function showSpecificDepartment($dept_id) {
		// we try to get academic department first
		// first() instead of firstOrFail() because if it doesn't find anything, then it will fail on AdministrativeDepartment
		$department = AcademicDepartment::with('contacts')
						->where('department_id', 'academic_departments:'.$dept_id)->first();
		if(empty($department)) {
			$department = AdministrativeDepartment::findOrFail('departments:'.$dept_id);
			$department = AdministrativeDepartment::where('entities_id', 'departments:'.$dept_id)
						->firstOrFail();
		}
		$data = $department->toArray();
		return $this->sendResponse($data, "department");
	}


}
