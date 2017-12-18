<?php

class Router {
	
	const GET 		= 'GET';
	const POST 		= 'POST';
	const DELETE 	= 'DELETE';

	const GET_METHOD_NAME 			= 'get';
	const GET_DETAIL_METHOD_NAME 	= 'detail';
	const POST_METHOD_NAME 			= 'post';
	const DELETE_METHOD_NAME 		= 'delete';

	const VERSION_FOLDER 	= 'version_';
	const RESOURCES_FOLDER 	= 'resources';

	public function __construct($version, $resource, $id, $slug) {

		if(file_exists($filename = API . self::VERSION_FOLDER . $version . '/' . self::RESOURCES_FOLDER . '/' . $resource . '.php')) {

			require_once $filename;
			
			if(class_exists($resource)) {
				$resourceObject = new $resource(Http::$request, Http::$response);

				Http::$resource = $resourceObject;

				// Attach request and response object to the resource
				$resourceObject->request = Http::$request;
				$resourceObject->response = Http::$response;
				
				$method = $this->point($resourceObject);
				$resourceObject->$method();
			} else {
				Http::$response->status(404);
			}
		} else {
			Http::$response->status(404);
		}
	}

	/*
	 * Point to the correct method
	 */
	public function point($resource) {

		if($resource->request->method(self::GET)) {
			if($resource->request->url->id) {
				$method = self::GET_DETAIL_METHOD_NAME;
			} else {
				$method = self::GET_METHOD_NAME;
			}
		} else if($resource->request->method(self::POST)) {
			$method = self::POST_METHOD_NAME;
		} else if($resource->request->method(self::DELETE)) {
			$method = self::DELETE_METHOD_NAME;
		}

		return $method;
	}
}