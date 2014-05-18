<?php
class Software extends Eloquent
{
	protected $table = 'software';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>