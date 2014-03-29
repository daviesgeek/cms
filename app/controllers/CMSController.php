<?php

class CMSController extends Controller {

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

    $this->edits = $CMS->getEdits($thisPage);

  }

}