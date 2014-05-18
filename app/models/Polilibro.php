<?php
class Polilibro extends Eloquent
{
	protected $table = 'polilibro';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>