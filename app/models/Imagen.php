<?php
class Imagen extends Eloquent
{
	public $timestamps=false;
	protected $table = 'imagenes';
	
	public function documento()
	{
		return $this->belongsTo('Documento','idDocumento');
	}
	public function archivos()
	{
		return $this->hasMany('Archivo');
	}
	
	
}
	
?>