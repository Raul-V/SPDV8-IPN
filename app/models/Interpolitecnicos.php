<?php
class Interpolitecnicos extends Eloquent
{
	protected $table = 'interpolitecnicos';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>