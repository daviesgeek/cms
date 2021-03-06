@extends('layout')

@section('content')
  <h1>Login here!</h1>
  <div class="content col-md-7 col-md-offset-2">
    <div class="text-danger">
    </div>
    <form class="form-horizontal" role="form" action="/login" id="login">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email/Username:</label>
        <div class="col-sm-10">
          <input class="form-control" id="inputEmail3" name="username" placeholder="Email/Username">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="remember" checked="" /> Remember me
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Sign in</button>
        </div>
      </div>
    </form>    
  </div>
@stop