<?php
class EvaluacionDeProgramas extends Eloquent
{
	protected $table = 'evaluaciondeprogramas';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>