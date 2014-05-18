<?php

class Compulsa_CotejarController extends BaseController
{

	public function __construct()
	{
		
		$this->beforeFilter('auth',array('except' =>array('getLogin','postLogin')));
	}
	
	public function getCargaAcademica($id,$idProfesor)
	{
		$profesor=Profesor::find($idProfesor);
		$resultado=DocumentosBO::getDocumento($seccion=1,$id);
		return View::make('compulsa.docencia.cotejarCargaAcademica')->withResultado($resultado)->withProfesor($profesor);
	}
	
	
	
	public function postCotejar()
	{
		return DocumentosBO::cotejarDocumento(DocumentosBO::validarCotejamiento());
	}
	
	/**public function postCargaAcademica($id,$idProfesor)
	{
		return DocumentosBO::cotejarDocumento(DocumentosBO::validarCotejamiento());
	}*/
	
	
}

