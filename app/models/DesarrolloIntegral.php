<?php
class DesarrolloIntegral extends Eloquent
{
	protected $table = 'desarrollointegral';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>