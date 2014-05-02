<?php

class CMSController extends \BaseController {

  public function index($page) {
    $this->page = $this->getPage($page);
    $this->data['edits']      = $this->page['edits'];
    $this->data['title']      = $this->page['title'];
    $this->data['h1']         = $this->page['h1'];
    $this->data['pageID']     = $this->page['id'];
    return View::make('templates/'.$this->page['template'], $this->data);
  }

}