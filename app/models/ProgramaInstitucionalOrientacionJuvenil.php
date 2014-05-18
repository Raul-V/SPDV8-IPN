<?php

class ProgramaInstitucionalOrientacionJuvenil extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'programa_institucional_orientacion_juvenil';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>