<?php

class Solicitud extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'solicitud';
	
	public function profesor()
	{
		return $this->belongsTo('Profesor','idProfesor');
	}
	public function documentos()
	{
		return $this->hasMany('Documento','idSolicitud');
	}
	
	
}

?>