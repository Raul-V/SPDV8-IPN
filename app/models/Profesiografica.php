<?php
class Profesiografica extends Eloquent
{
	protected $table = 'profesiografica';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>