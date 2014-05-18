<?php
class Brigadas extends Eloquent
{
	protected $table = 'brigadas';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>