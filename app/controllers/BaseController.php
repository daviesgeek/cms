<?php

use Illuminate\Support\MessageBag;

class BaseController extends Controller {

	protected $response = array(
		'data' => array(),
		'meta' => array(),
		'code' => 200,
		'message' => ''
	);

	public $page;
	public $viewData = array();

	public function __construct() {
		$this->user = Sentry::getUser();
		if($this->user){
			$this->addViewData(array('editAccess' => $this->user->hasAccess('edit')));
		}else{
			$this->addViewData(array('editAccess' => false));
		}
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		if ( ! is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Adds data to the array of view data
	 * @param array $array
	 */
	public function addViewData($array) {
		foreach($array as $key => $val){
			$this->data[$key] = $val;		
		}
	}

	/**
	 * Returns the view data
	 * @return array
	 */
	public function getViewData() {
		return $this->data;
	}

	/**
	 * Gets the edits for the page
	 * @param  string $page url passed in from the routing
	 * @return object
	 */
	public function getPage($page) {
		$thisPage = \CMS::findPageByUrl($page);
		if(empty($thisPage)){
			App::abort(404);
			return false;
		}
		return $thisPage;
	}

	/**
	 * Returns the response for the page
	 * @return view|response
	 */
	public function getResponse() {

		// Get the current route name (corresponds with the Sentry permission name)
		$route = Route::currentRouteName();

		$meta = isset($this->response['meta']) ? $this->response['meta'] : null;

		$wrapper = array(
			'status'    => array(
				'code'    => $this->response['code'],
				'message' => $this->response['message']
			),
			'info'      => null,
			'data'      => $this->response['data'],
			'meta'      => $meta
		);

		global $startTime;
		if(isset($startTime) && $startTime) {
			$wrapper['info']['execTime'] = round((microtime(true) - $startTime)*1000, 2).'ms';
			$wrapper['info']['peakMemory'] = (memory_get_peak_usage(true)/1024).'KB';
		}

		$accessAllow = array(
			'Access-Control-Allow-Origin' => Config::get('app.Access-Control-Allow-Origin'),
			'Access-Control-Allow-Credentials' => 'true',
			'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
			'Access-Control-Allow-Headers' => 'Content-Type'
		);


		// If the current user does not have access to this route (or isn't logged in, throw a 403
		if(!Sentry::getUser()->hasAccess($route)){

			$wrapper = array(
				'status'    => array(
					'code'    => '403',
					'message' => Lang::get('errors.403json')
				),
				'info'      => null,
				'data'      => array(),
				'meta'      => array()
			);
		  $accessAllow = array();

		  // If the user isn't logged in, change the message
		  if(!Sentry::check()){
		    $this->response['message'] = \Lang::get('errors.403login');
		  }
		}

		return Response::json(
			$wrapper,
			$this->response['code'],
			$accessAllow
		);
	}

	public function missingMethod($parameters = array()) {
		var_dump($parameters);
	}

	public function validationError($message = '', $errors = array()) {
		$this->response['code'] = 422;
		$this->response['message'] = $message;
		if($errors instanceof MessageBag)
			$errors = $errors->toArray();

		$this->response['meta']['errors'] = $errors;
		return $this->getResponse();
	}

}