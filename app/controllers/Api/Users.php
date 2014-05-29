<?php namespace Api;

class Users extends ApiBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = \Sentry::getAllUsers();
		$this->response['data'] = $users;
		$this->response['code'] = 200;
		$this->response['message'] = 'Users list';
		return $this->getResponse();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		// Create an array from the inputs so it can be validated
		$user = array(
      'email'           => \Input::get('email'),
      'username'        => \Input::get('username'),
      'password'        => \Input::get('password'),
      'passwordrepeat'  => \Input::get('passwordrepeat'),
      'activated'       => true // change later
		 );

		// Create the validation rules
		$validator = \Validator::make(
			$user,
			array(
				'email'          => 'required|email|unique:user,email',
				'username'       => 'required|unique:user,username',
				'password'       => 'required|min:5',
				'passwordrepeat' => 'required|same:password'
			)
		);

		// If the validation passes
		if($validator->passes()) {

			try{ // Attemp to create the user

				// First unset the passwordrepeat key, otherwise it will try to insert it into the database
				unset($user['passwordrepeat']);

				// Then create the user
				$user = \Sentry::createUser($user);

				// Set the response data
				$this->response['data'] = $user->attributes->id;
				$this->response['code'] = 200;
				$this->response['message'] = 'User successfully created';
				
			}catch(Exception $e){

				// If there's a problem, set the response data
				$this->response['exception'] = $e;
				$this->response['code'] = 422;
				$this->response['data'] = array();

				try{ throw $e; }
				catch (Cartalyst\Sentry\Users\LoginRequiredException $e){
			    $this->response['message'] = 'Login field is required.';
				}
				catch (Cartalyst\Sentry\Users\PasswordRequiredException $e){
			    $this->response['message'] = 'Password field is required.';
				}
				catch (Cartalyst\Sentry\Users\UserExistsException $e){
			    $this->response['message'] = 'User with this login already exists.';
				}
				catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e){
			    $this->response['message'] = 'Group was not found.';
				}				
			}

			// And return the JSON encoded response
			return $this->getResponse();
		}else{


			$this->response['data']['errors'] = $validator->errors()->toArray();
			$this->response['code'] = 422;
			$this->response['message'] = 'The user could not be created';
			return $this->getResponse();
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}