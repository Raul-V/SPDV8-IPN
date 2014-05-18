<?php

class Profesor_ModificarController extends BaseController
{

	public function __construct()
	{
		
		$this->beforeFilter('auth',array('except' =>array('getLogin','postLogin')));
	}
	
	public function getDiplomado()
	{
		return View::make('profesor.superacionAcademica.modificarDiplomado');
	}
	public function postDiplomado()
	{
		$rules=array(
		'nombre'				=>	'',
		'nombreInstitucion'		=>	'',
		'noHoras'				=>	'',
		'fechaInicio'			=>	'',
		'fechaTermino'			=>	'',
		'nivel'					=>	'in:DES,DEM,SIP',
		'fechaConstancia'		=>	'',
		'constanciaFile'		=>	'',		
		'diplomaFile'			=>	'',
		);
		
		$messages=array(
		'nombre.min'=>MensajesSPD::getMSG19('Nombre del diplomado',5),
		'nombreInstitucion.min'=>MensajesSPD::getMSG19('Nombre de la institución',5),
		'noHoras.integer'=>MensajesSPD::getMSG18('Número de horas'),
		'fechaInicio.date'=>MensajesSPD::getMSG4('Fecha de inicio','(Dia-Mes-Año)'),	
		'fechaTermino.date'=>MensajesSPD::getMSG4('Fecha de termino','(Dia-Mes-Año)'),
		'fechaTermino.after'=>MensajesSPD::getMSG15_1('Fecha de termino','Fecha de inicio'),
		'nivel.in'=>MensajesSPD::getMSG21('Nivel'),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.after'=>MensajesSPD::getMSG15_1('Fecha de la constancia','Fecha de termino'),
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		'diplomaFile.required'=> MensajesSPD::getMSG3('Diploma'),
		'diplomaFile.image'=> MensajesSPD::getMSG7_1('Diploma'),
		'diplomaFile.mimes'=> MensajesSPD::getMSG7('Diploma'),
		'diplomaFile.max'=> MensajesSPD::getMSG6('Diploma'),
		);
		  
		if(Input::has('nombre'))
		{
			$rules['nombre']='required|min:5';
		}
		if(Input::has('nombreInstitucion'))
		{
			$rules['nombreInstitucion']='required|min:5';
		}
		if(Input::has('noHoras'))
		{
			$rules['noHoras']='required|integer';
		}
		if(Input::has('nivel'))
		{		
		}
		if(Input::has('fechaInicio'))
		{
		}
		if(Input::has('fechaTermino'))
		{
		}
		if(Input::has('fechaConstancia'))
		{
		}
	}
	
	
	
}

