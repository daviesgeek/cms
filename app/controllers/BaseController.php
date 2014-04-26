<?php

class BaseController extends Controller {

	protected $response = array(
		'data' => array(
		),
		'code' => '',
		'message' => ''
	);

	public $page;
	public $data = array();

	public function __construct() {

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
		if(!empty($this->response)) {

			$code = $this->response['code'] ? $this->response['code'] : 200;

			$wrapper = array(
				'status'    => array(
					'code'    => $code,
					'message' => $this->response['message']
				),
				'info'      => null,
				'data'      => $this->response['data'],
				'meta'      => null
			);


			global $startTime;
			if(isset($startTime) && $startTime) {
				$wrapper['info']['execTime'] = round((microtime(true) - $startTime)*1000, 2).'ms';
				$wrapper['info']['peakMemory'] = (memory_get_peak_usage(true)/1024).'KB';
			}

			return Response::json(
				$wrapper,
				$code,
				array(
					'Access-Control-Allow-Origin' => Config::get('app.Access-Control-Allow-Origin'),
					'Access-Control-Allow-Credentials' => 'true',
					'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
					'Access-Control-Allow-Headers' => 'Content-Type'
				)
			);

		}
	}

	public function missingMethod($parameters = array()) {
		var_dump($parameters);
	}

}