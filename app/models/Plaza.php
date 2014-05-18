<?php

class Plaza extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'plaza';
	public function profesor()
	{
		$this->belongsTo('Profesor','idProfesor');
	}
	
}

?>