<?php
class Deportivas extends Eloquent
{
	protected $table = 'deportivas';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>