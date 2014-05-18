<?php
class Carteles extends Eloquent
{
	protected $table = 'carteles';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>