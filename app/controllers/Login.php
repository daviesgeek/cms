<?php
/**
 * Login resource (handles all the authentication)
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 24th, 2014
 */

class Login extends \BaseController {


	public $title = 'Login';

	/**
	 * User facing login page
	 * @return Response
	 */
	public function index() {
		return View::make('login')->with('title', $this->title);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()	{

		// Make an array of the credentials
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		// Apply validation rules to the username field to see if the user inputted an email address
		$validator = Validator::make(
			array('username' => $credentials['username']),
			array('username' => 'email')
		);

		// If it passes, the user inputted an email address
		if($validator->passes()){

			// Instantiate the user model
			$user = new \User;

			// Find the user by the email address and assign the username to a new variable
			$username = $user->findUserByEmail($credentials['username'])['username'];

			// Set the username on the $credentials array (it's now an email address)
			$credentials['username'] = $username;
		}

		// To set whether the user should be remembered or not
		$remember = Input::get('remember');
		try{

			// Attempt to login
			Sentry::authenticate($credentials, $remember);

			// If login is successful, return a JSON array
			$this->response['message'] = 'Login successful';
			$this->response['redirect'] = 'admin';
			$this->response['code'] = 200;

			// And redirect to the admin page
			$this->response['data'] = array('redirect' => 'admin');
		}catch(Exception $e){

			$this->response['exception'] = $e;
			$this->response['code'] = 422;
			$this->response['data'] = array();

			try{ throw $e; }

			catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
				$this->response['message'] = 'Email or username is required';
			}
			catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
				$this->response['message'] = 'Password is required';
			}
			catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
				$this->response['message'] = 'Invalid email or password. Please try again.';
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
				$this->response['message'] = 'Invalid email or password. Please try again.';
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
				$this->response['code'] = 403;
				$this->response['message'] = 'Your account has not been activated yet.';
			}
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
				$this->response['code'] = 403;
				$this->response['message'] = 'Your account has been suspended for too many incorrect login attempts. Please try again later.';
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
				$this->response['code'] = 403;
				$this->response['message'] = 'Your account has been permanently suspended.';
			}
			catch(\Exception $e) {
			  $this->response['code'] = 500;
			  $this->response['message'] = 'An unexpected error ocurred.';
			}
		}

		return $this->getResponse();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}