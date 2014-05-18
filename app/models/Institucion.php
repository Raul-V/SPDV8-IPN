<?php

class Institucion extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'institucion';
	
	public function usuario()
	{
		return $this->hasMany('Usuario');
	}
}

?>