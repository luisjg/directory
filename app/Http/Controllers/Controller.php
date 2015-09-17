<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
	 * Sends the response back using the supplied data.
	 *
	 * @param string The data to send back
	 * @return Response
	 */
	protected function sendResponse($data) {
		// return the response as JSON
		return response()->json($data);
	}
}
