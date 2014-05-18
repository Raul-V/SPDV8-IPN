<?php
class Diplomado extends Eloquent
{
	protected $table = 'diplomado';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>