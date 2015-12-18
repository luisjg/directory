<?php namespace App\Http\Controllers;

use App\Handlers\HandlerUtilities;

use App\Http\Controllers\Controller;

use App\Models\AcademicGroup;
use App\Models\Contact;


class AcademicGroupController extends Controller {
	function showColleges (){
	//show all academic groups (predominantly colleges)
		$college = AcademicGroup::where('department_id','like','%academic_groups:%')
			->orderBy('name')
			->get();
		$data = $college->toArray();// convert the collection to an array for use in returning the
									// desired response as JSON
		
		return $this->sendResponse($data);

	}
	function showDepartments($college_id){
		$departments = AcademicGroup::where('college_id','academic_groups:'.$college_id)
			->orderBy('name')
			->get();
		$data = $departments->toArray();// convert the collection to an array for use in returning the
										// desired response as JSON
		
		return $this->sendResponse($data);
	}
	function showPersons($college_id){
		/*Post::with(array('user'=>function($query){
        $query->select('id','username');
    }))->get();*/

		$persons= AcademicGroup::with('departments.contacts')
			->where('college_id','academic_groups:'.$college_id)
			//->where('parent_entities_id','department_id')
			
			//->where('college_id', 'academic_groups:'.$college_id)
			//->where('parent_entities_id','entities_id')
			->get();
		//$persons = Contact::where('parent_entities_id','like',$depts)
		//	->get();
		// convert the collection to an array for use in returning the
		// desired response as JSON
		$data = $persons->toArray();	
		// send the response
		return $this->sendResponse($data);
	}

		
	


}