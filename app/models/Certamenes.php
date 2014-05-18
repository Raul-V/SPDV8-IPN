<?php
class Certamenes extends Eloquent
{
	protected $table = 'certamenes';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>