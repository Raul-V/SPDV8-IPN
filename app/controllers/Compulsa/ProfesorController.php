<?php

class Compulsa_ProfesorController extends BaseController
{

	public function __construct()
	{
		
		$this->beforeFilter('auth',array('except' =>array('getLogin','postLogin')));
	}
	
	public function getProfesor($id)
	{
		$profesor=Profesor::find($id);
		$docs=Profesor::find($id)->solicitudes()->where('estatus','=','1')->first()->documentos()->get();
		/*foreach($docs as $doc)
		{
			echo 'Id-'.$doc->id.', Puntos-'.$doc->puntos;
		}*/
		$info=Profesor::find($id)->solicitudes()->where('estatus','=','1')->first()->documentos();
		$docencia=Profesor::find($id)->solicitudes()->where('estatus','=','1')->first()->documentos()->where('idCategoria','=',4)->where('cotejado','=','0')->get();
		$investigacion=Profesor::find($id)->solicitudes()->where('estatus','=','1')->first()->documentos()->where('idCategoria','=',7)->where('cotejado','=','0')->get();
		$superacion=Profesor::find($id)->solicitudes()->where('estatus','=','1')->first()->documentos()->where('idCategoria','=',3)->where('cotejado','=','0')->get();
		$actividadesC=Profesor::find($id)->solicitudes()->where('estatus','=','1')->first()->documentos()->where('idCategoria','=',5)->where('cotejado','=','0')->get();
		$actividadesE=Profesor::find($id)->solicitudes()->where('estatus','=','1')->first()->documentos()->where('idCategoria','=',6)->where('cotejado','=','0')->get();
		$noDocencia=$docencia->count();
		$puntosDocencia=0;
		$puntosInvestigacion=0;
		$puntosSuperacion=0;
		$puntosActividadesC=0;
		$puntosActividadesE=0;
		foreach($docencia as $d)
		{
			$puntosDocencia=$puntosDocencia+$d->puntos;
		}
		foreach($investigacion as $d)
		{
			$puntosInvestigacion=$puntosInvestigacion+$d->puntos;
		}
		foreach($superacion as $d)
		{
			$puntosSuperacion=$puntosSuperacion+$d->puntos;
		}
		foreach($actividadesC as $d)
		{
			$puntosActividadesC=$puntosActividadesC+$d->puntos;
		}
		
		
		foreach($actividadesE as $d)
		{
			$puntosActividadesE=$puntosActividadesE+$d->puntos;
		}
		$total=0;
		foreach($docs as $inf)
		{
			$total=$total+$inf->puntos;
		}
		$carga=DocumentosBO::getCargaAcademica(1);
		$instructorProgramas=DocumentosBO::getInstructorProgramasFormacionDocente(1);
		//return var_dump($carga);
		return View::make('compulsa.verProfesor')->withProfesor($profesor)->withDocs($docs)->withCargas($carga)->
		withInstructorProgramas($instructorProgramas)->withNoDocencia($noDocencia)->withPuntosDocencia($puntosDocencia)->
		withPuntosInvestigacion($puntosInvestigacion)->withPuntosSuperacion($puntosSuperacion)->
		withPuntosActividadesC($actividadesC)->withPuntosActividadesE($puntosActividadesE)->withTotal($total);
	}
	
}

