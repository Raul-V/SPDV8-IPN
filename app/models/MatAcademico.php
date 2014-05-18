
<?php
class MatAcademico extends Eloquent
{
	protected $table = 'matacademico';
	public $timestamps=false;
	public function documento()
	{
		return $this->belongsTo('Documento','id');
	}
}

?>