<?php namespace Cms;

use Cartalyst\Sentry\Groups\NameRequiredException;
use Cartalyst\Sentry\Groups\GroupExistsException;
use Cartalyst\Sentry\Groups\GroupInterface;
use Illuminate\Database\Eloquent\Model;

class Group extends \Cartalyst\Sentry\Groups\Eloquent\Group {

  protected $table = 'group';
  protected static $userGroupsPivot = 'user_group';

}