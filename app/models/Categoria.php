<?php

class Categoria extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categoria';
	
	public function documentos()
	{
		return $this->hasMany('Documento','idCategoria');
	}
	public function categorias()
	{
		return $this.belongsTo('Categoria','categoriaFK');
	}
	
}

?>