<?php

class CompulsaController extends BaseController
{

	public function __construct()
	{
		
		$this->beforeFilter('auth',array('except' =>array('getLogin','postLogin')));
	}
	
	public function getIndex()
	{
		return View::make('compulsa.index');
	}
	
	public function getProfesores()
	{
		$idInstitucion=Auth::user()->idInstitucion;
		$institucion=Institucion::find($idInstitucion);
		//Obtenemos solicitudes ya terminadas que antes estaban activas
		$solicitudes=Solicitud::where('estatus','=','1')->get();
		$profesores=array();
		foreach($solicitudes as $solicitud)
		{
			$usuario=User::find($solicitud->idProfesor);
			$inst=Institucion::find($usuario->idInstitucion);
			if($inst->nombre==$institucion->nombre)
			{
				array_push($profesores,$usuario->toArray());
			}
		}
		return View::make('compulsa.verProfesores')->withInstitucion($institucion)->withProfesores($profesores);
	}
	
}

