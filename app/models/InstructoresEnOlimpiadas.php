<?php
class InstructoresEnOlimpiadas extends Eloquent
{
	protected $table = 'instructoresenolimpiadas';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>