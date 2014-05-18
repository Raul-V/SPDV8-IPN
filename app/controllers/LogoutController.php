<?php

class LogoutController extends BaseController 
{

	public function __construct()
	{		
		$this->beforeFilter('auth',array('except' =>array('getLogin','postLogin')));
	}

	public function getLogout()
	{
		//return View::make('hello');
		Auth::logout();
		return Redirect::to('login');
	}

}