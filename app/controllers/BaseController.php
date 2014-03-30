<?php

class BaseController extends Controller {

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
	  $CMS = \Cms\Menu::getAll();
	  $menuList = $CMS::$menu;

	  foreach ($menuList as $menu) {
	    if($menu->url == $page){
	      $thisPage = $menu;
	      break;
	    }
	  }
	  if(empty($thisPage)){
	    App::abort(404);
	    return;
	  }
	  $this->edits = \Cms\Edit::get($thisPage);
	}

}