<?php namespace Cms;

use Eloquent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Cartalyst\Sentry\Users\Eloquent\User implements UserInterface, RemindableInterface {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'user';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('password');

  /**
   * Gets all the users
   * @param  array $columns an array of columns to return
   * @return object of users
   */
  public function getAllUsers($columns=array('*')) {
    $users = \DB::table($this->table)->get() ;
    return $users;
  }

  public function findUserByEmail($email){

    if ( ! $user = $this->newQuery()->where('email', $email)->get()->first()->toArray())
    {
      throw new \Cartalyst\Sentry\Users\UserNotFoundException("A user could not be found with ID [$email].");
    }

    return $user;
  }

  /**
   * Get the unique identifier for the user.
   *
   * @return mixed
   */
  public function getAuthIdentifier()
  {
    return $this->getKey();
  }

  /**
   * Get the password for the user.
   *
   * @return string
   */
  public function getAuthPassword()
  {
    return $this->password;
  }

  /**
   * Get the e-mail address where password reminders are sent.
   *
   * @return string
   */
  public function getReminderEmail()
  {
    return $this->email;
  }

}

