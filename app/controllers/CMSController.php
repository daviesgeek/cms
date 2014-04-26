<?php

class CMSController extends \BaseController {

  public function index($page) {
    $this->page = $this->getPage($page);
    $this->data['edits'] = $this->page['edits'];
    $this->data['title'] = $this->page['title'];
    return View::make('templates/'.$this->page['template'], $this->data);
  }

}