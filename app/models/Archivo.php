<?php
class Archivo extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'archivo';
	public $timestamps=false;
	public function imagen()
	{
		return $this->belongsTo('Imagen','idImagen');
	}
}
?>