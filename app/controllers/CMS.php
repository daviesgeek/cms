<?php

class CMS extends BaseController {

  public function index($page) {
    $this->getPage($page);
    $this->data->title = $this->data->page->name;
    return View::make('templates/'.$this->data->page->template, $this->data);
  }

}