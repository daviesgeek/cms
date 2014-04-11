<?php
/**
 * Login resource (handles all the authentication)
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 24th, 2014
 */

class LoginController extends \BaseController {


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
		$user = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		);
		$remember = Input::get('remember');
		try{
			Sentry::authenticate($user, $remember);
			$this->response['message'] = 'Login successful';
			$this->response['redirect'] = 'admin';
			$this->response['code'] = 200;
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

	public function createUser() {
		if(Input::get('password') == Input::get('passwordrepeat')) {
			$user = Sentry::createUser(array(
		      'email'     => Input::get('email'),
		      'password'  => Input::get('password'),
		      'activated' => true,
		  ));
		}else{
			echo 'Passwords do not match';
		}
	}

}