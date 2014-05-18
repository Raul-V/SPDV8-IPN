<?php

class Profesor_VisualizarController extends BaseController
{

	public function __construct()
	{
		
		$this->beforeFilter('auth',array('except' =>array('getLogin','postLogin')));
	}
	
	public function getDiplomado($id)
	{
		$imagenConstancia=Imagen::where('idDocumento','=',$id)->where('descripcion','=','Constancia de validación')->get()->first();
		$imagenDiploma=Imagen::where('idDocumento','=',$id)->where('descripcion','=','Diploma')->get()->first();
		$diplomado=Diplomado::find($id);
		if($diplomado==null)
		{
			$errores=array(MensajesSPD::getMSG34('Diplomado'));
			return Redirect::to('profesor/documentos')->with('errores',$errores); 
		}
		$resultado=$diplomado->toArray();
		$resultado['noConstancia']=$imagenConstancia->numero;
		$resultado['imgConstancia']=$imagenConstancia->img;
		$resultado['fechaConstancia']=$imagenConstancia->fecha;
		$resultado['imgDiploma']=$imagenDiploma->img;
		//return var_dump($resultado);
		return View::make('profesor.superacionAcademica.verDiplomado')->withResultado($resultado);
	}
	public function getCargaAcademica($id)
	{		
		$resultado=DocumentosBO::getDocumento($seccion=1,$id);
		return View::make('profesor.docencia.verCargaAcademica')->withResultado($resultado);
	}
	
	public function getInstructorProgramas($id)
	{
		
		$resultado=DocumentosBO::getDocumento($seccion=2,$id);
		return View::make('profesor.docencia.verInstructorProgramas')->withResultado($resultado);
	}
	
	public function getCursosProgramaRecuperacionAcademica($id)
	{
		
		$resultado=DocumentosBO::getDocumento($seccion=3,$id);
		return View::make('profesor.docencia.verCursosProgramaRecuperacion')->withResultado($resultado);
	}
	
	
}

