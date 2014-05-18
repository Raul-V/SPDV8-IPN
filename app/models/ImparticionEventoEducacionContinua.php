<?php

class ImparticionEventoEducacionContinua extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'imparticion_evento_educacion_continua';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>