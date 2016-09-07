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
	protected function sendResponse($data, $type="people", $status=200) {
		// create return array
		$arr = [
			'status' => "$status",
			'success' => ($status < 400) ? "true" : "false", // response codes < 400 are success
			'type' => $type,
			"$type" => $data, // change the name of the element based on type
		];
		if($data === 'error'){
			$arr = [
				'status' => 404,
				'success' => 'false',
				'error' => 'Invalid url.'
			];
		}

		// return the response as JSON
		return response()->json($arr);
	}}
