<?php


class Profesor extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profesor';
	
	
	
	
	public function plazas()
	{
		$this->hasMany('Plaza','idProfesor');
	}
	
	public function usuario()
	{
		return $this->belongsTo('User','id');
	}
	
	public function solicitudes()
	{
		return $this->hasMany('Solicitud','idProfesor');
	}
	
	
}

?>