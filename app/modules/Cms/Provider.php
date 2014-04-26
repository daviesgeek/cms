<?php namespace Cms;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
      $this->app->bind('CMS', function() {
         return new \Cms\CMS;
       });
      $this->registerPage();
    }

    public function registerPage() {
      $this->app->bind('CMS.Menu', function() {
        return new \Cms\Menu;
      });
    }

}