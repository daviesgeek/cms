<?php

class BaseController extends Controller {

	public $response = array();

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
	 * @return void
	 */
	public function getPage($page) {
		$thisPage = $this->data = \Cms\Page::doesExist($page);

		if(!$thisPage){
			App::abort(404);
			return;
		}

		$this->data->edits = $thisPage::$edits;
		$this->data->page = $thisPage::$page;
	}

	/**
	 * Returns the response for the page
	 * @return view|response
	 */
	public function getResponse() {
		if(!empty($this->response)) {

			$wrapper = array(
				'status' => array(
					'code' => $this->response['code'],
					'message' => $this->response['message']
				),
				'info' => null,
				'data' => $this->response['data'],
				'meta' => null
			);


			global $startTime;
			if(isset($startTime) && $startTime) {
				$wrapper['info']['execTime'] = round((microtime(true) - $startTime)*1000, 2).'ms';
				$wrapper['info']['peakMemory'] = (memory_get_peak_usage(true)/1024).'KB';
			}

			return Response::json(
				$wrapper,
				$this->response['code'],
				array(
					'Access-Control-Allow-Origin' => Config::get('app.Access-Control-Allow-Origin'),
					'Access-Control-Allow-Credentials' => 'true',
					'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
					'Access-Control-Allow-Headers' => 'Content-Type'
				)
			);

		}
	}

}