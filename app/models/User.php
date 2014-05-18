<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuario';
	
	public function direccion()
	{
		return $this->belongsTo('Direccion','idDireccion');
	}
	public function institucion()
	{
		return $this->belongsTo('Institucion','idInstitucion');
	}
	
	
	//public $timestamps=false;
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function profesor()
	{
		return $this->belongsTo('Profesor','id');
	}
	 
	 
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
		return $this->id;
	}
	
	public function setPasswordAttribute($string)
	{
		$this->attributes['password']=Hash::make($string);
	}
	
}