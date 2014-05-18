<?php  

class Hardware extends Eloquent

{		protected $table = 'hardware';
		public $timestamps=false;
		public function documento()
	{
		return $this->belongsTo('Documento','id');
	}

}

?>