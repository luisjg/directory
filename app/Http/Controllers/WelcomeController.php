<?php namespace App\Http\Controllers;

class WelcomeController extends Controller {

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $email = 'steven.fitzgerald@csun.edu';
	    if(env('APP_ENV') === 'local')
	        $email = 'nr_'.$email;
		return view("pages.landing", compact('email'));
	}

}
