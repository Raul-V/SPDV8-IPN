<?php

class ProfesorController extends BaseController 
{

	public function __construct()
	{
		
		$this->beforeFilter('auth',array('except' =>array('getLogin','postLogin')));
		$this->beforeFilter('esProfesor');
	}

	public function getIndex()
	{
		
		/*Averiguar la etapa del proceso de promoción academica*/
		$proceso=InfoProceso::find('1');
		
		if($proceso->fechaInicioRegistro<=date('Y-m-d') && $proceso->fechaFinRegistro>date('Y-m-d'))
		{
			$solicitud=Solicitud::where('idProfesor','=',Auth::user()->id)->where('estatus','=',0)->get();
			if($solicitud->isEmpty())
			{
				//No ha creado solicitud para el proceso de promocion academica actual.
				return View::make('profesor.indexPreregistro');
			}
			else
			{
				//Ya tiene creada una solicitud para el proceso actual.
				return View::make('profesor.indexRegistro');
			}
		}
		else
		{
			return View::make('profesor.Timeout');
		}
		
		
		//return View::make('profesor.indexPreregistro');
	}

	
	public function getSolicitud()
	{
		//Obtenemos el ID del profesor que es el ID del usuario
		$profesor=Profesor::find(Auth::user()->id);
		//Se crea una nueva solicitud.
		$solicitud=new Solicitud;
		$solicitud->aprobado=false;
		//El estatus 0, representa una solicitud activa, es decir una que esta en periodo de registro y no ha sido finalizada.		
		$solicitud->estatus=0;
		$solicitud->fecha=date('Y-m-d H:i:s');
		//Se asocia la solicitud al profesor
		$solicitud->profesor()->associate($profesor);
		//Se guarda la solicitud en la BD
		$solicitud->save();
		
		return Redirect::to('profesor');
		
	}
	
	
	
	
	
	public function getDocumentos()
	{
		$docs=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->get();
		
		$info=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos();
		
		$docencia=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->where('idCategoria','=',4)->get();
		$investigacion=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->where('idCategoria','=',7)->get();
		$superacion=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->where('idCategoria','=',3)->get();
		$actividadesC=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->where('idCategoria','=',5)->get();
		$actividadesE=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->where('idCategoria','=',6)->get();
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
		//Obtenemos todas las secciones de Carga Academica
		$carga=DocumentosBO::getCargaAcademica();
		
		//Obtenemos todas las secciones de Instructor de programas
		$instructorProgramas=DocumentosBO::getInstructorProgramasFormacionDocente();
		
		$cursosRecuperacion=DocumentosBO::getCursosProgramaRecuperacionAcademica();
		
		
		//Cuando hacemos uso de la funcion with acompañada de algo mas por ejemplo
		// View::make('vista')->withHola($VariableHola);
		//Significa que en la vista que se va a construir se debe instanciar una copia de la variable
		//$VariableHola y se llamara en esa vista como $hola
		
		
		return View::make('profesor.Misolicitud')->withDocs($docs)->withCargas($carga)->
		withInstructorProgramas($instructorProgramas)->withCursosRecuperacion($cursosRecuperacion)->
		withNoDocencia($noDocencia)->withPuntosDocencia($puntosDocencia)->
		withPuntosInvestigacion($puntosInvestigacion)->withPuntosSuperacion($puntosSuperacion)->
		withPuntosActividadesC($actividadesC)->withPuntosActividadesE($puntosActividadesE)->withTotal($total);
		
		
	}
	
	public function getPerfil()
	{
		$user=Auth::user();
		return View::make('profesor.modificarPerfil')->with('user',$user);
	}
	
	public function getRegistrarDocumento()
	{
		return 'Vista registrar documento';
	}
	
	public function getRegistrarPlaza()
	{
		return View::make('profesor.registrarPlaza');
	}
	
	public function postRegistrarPlaza()
	{
		$rules=array(
		'clave'=>'required|regex:([0-9]{4}\.[a-z0-9A-Z]{2}[0-3][0-9]{3}-[0-9]{3}[0-9]*)|unique:plaza,clavePlaza',
		'tipo' => 'required',
		'noHoras' => 'required|integer'
		);
		$validacion=Validator::make(Input::all(),$rules);
		if($validacion->fails())
		{
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		$plaza= new Plaza;
		$plaza->clavePlaza=Input::get('clave');
		$plaza->tipo=Input::get('tipo');
		$plaza->noHoras=Input::get('noHoras');
		$plaza->idProfesor=Auth::user()->id;
		
		$plaza->save();
		
		return Redirect::to('profesor');
		
		
	}
	
	
	
	
	
	
}