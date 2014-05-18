<?php

class Direccion extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'direccion';
	
	public function usuario()
	{
		return $this->hasMany('Usuario');
	}
}

?>