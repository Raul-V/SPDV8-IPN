<?php

class CursosActualizacion extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cursos_seminarios_talleres';
	public $timestamps=false;
	
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
	
	
}

?>