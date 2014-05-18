<?php
class Licenciatura extends Eloquent
{
	protected $table = 'licenciatura';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>