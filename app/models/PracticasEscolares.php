<?php
class PracticasEscolares extends Eloquent
{
	protected $table = 'practicasescolares';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>