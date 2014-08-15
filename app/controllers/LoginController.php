<?php

class LoginController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		return View::make('login', Session::all());
	}

	public function postIndex()
	{
		//do login logic here
		if(Auth::attempt(array('email' => Input::get('username'), 'password' => Input::get('password')), true)) {
			if(Auth::user()->head) {
				return Redirect::to('/'.Auth::user()->head.'/dashboard')->with('user', Auth::user());
			}
			
			return Redirect::to('/user/dashboard')->with('user', Auth::user());
		}

		return Redirect::to('login')->with('message', 'Login Failed!');
	}

}
