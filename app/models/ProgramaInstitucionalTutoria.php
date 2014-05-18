<?php

class ProgramaInstitucionalTutoria extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'programa_institucional_tutorias';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>