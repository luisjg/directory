<?php namespace App\Http\Controllers;

class WelcomeController extends Controller {

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		// TODO: Make a spiffy landing page and display it here instead of
		// returning a basic string
		return "Directory Web Service";
	}

}
