<?php

class Profesor_RegistrarController extends BaseController
{

	public function __construct()
	{
		
		$this->beforeFilter('auth',array('except' =>array('getLogin','postLogin')));
	}



	public function getIndex()
	{
		return View::make('profesor.registrar');
	}

	/*
		Esta funcion atiende las peticiones get de diplomado.
		Es decir siempre atendera la peticion 
		localhost/public/login/profesor/registrar/diplomado
		
		Dependiendo la configuracion del servidor puede cambiar la URL, otra URL posible de acuerdo a la configuracion del
		servidor es
		localhost/login/profesor/registrar/diplomado
	*/
	
	public function getDiplomado()
	{
		//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrarDiplomado.blade.php
		//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
		return View::make('profesor.superacionAcademica.registrarDiplomado');
	}
	
	
	
	
	/*
	Plantilla para registrar un diplomado. La mayoria de secciones sigue el mismo patron.
	Esta sección tiene el caso de subir dos imagenes, una de diploma y otra de constancia.
	Si en la seccion que se desea registrar no hay diploma se elimina lo que tenga que ver con diploma, lo mismo
	pasa con la constancia.
	Esta funcion atiende las peticiones la peticion post de un diplomado
	*/	
	
	
	public function postDiplomado()
	{
		
		/*En este arreglo se ponen todas las reglas de validación para el formulario.
		De un lado va el "name" del campo que queremos aplicarle reglas de validacion y del otro lado separado por => van
		las reglas de validación que se aplicaran, cada regla va separada por el simbolo "|".
		
		Los nombres que van a la izquierda se obtienen de las vistas. Es decir el name de los campos
		que estan en los formularios de las vistas.
		*/
		
		
		$rules=array(
			'nombre' => 'required|min:5',
			'nombreInstitucion' => 'required|min:5',
			'noHoras' => 'required|integer',
			'fechaInicio' => 'required|date',			
			'fechaTermino' => 'required|date|after:'.Input::get('fechaInicio'),
			'nivel' => 'required|in:DES,DEMS,SIP',
			'noConstancia' => 'required|unique:imagenes,numero',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.Input::get('fechaTermino'),
			'constanciaFile'=> 'required|image|mimes:jpeg|max:',
			'diplomaFile'=> 'required|image|mimes:jpeg|max:716800',
		
		);
		
		/*Mensajes de error de acuerdo a las reglas de validación que contiene la variable $rules*/	
 
		/*
			En la parte de la izquierda, se pone el nombre del campo seguido de un punto y la regla de validación
			por la cual se incluira el mensaje.
			
			Ejemplo
				'nombre.min'=>MensajesSPD::getMSG19('nombre del diplomado',5),
				Este mensaje aparecera cuando el campo "nombre" falle al validar que el campo
				tenga cierto número de caracteres como minimo.
				'noHoras.integer'=>MensajesSPD::getMSG18('numero de horas'),
				En este ejemplo Mostrara el mensaje cuando el campo "noHoras" falle al validar que sea entero.
		*/
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
		
		//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		//Validamos que el formato de la imagen del diploma es el correcto
		if(!BRules::validarFormatoImagen(Input::file('diplomaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('diploma'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion='10-08-1980';//334713600->10-08-1980			
		}
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		
		
		
		
		
		
		
		/*VALIDACION DEPRECIADA
		$rules=array(
			'fechaConstancia' => 'after:'.date('d-m-Y',strtotime('-4 year'))
		);
		$messages = array(
			'after' => MensajesSPD::getMSG5_1(),
		);
		
		$validacion=Validator::make(Input::all(),$rules,$messages);
		Validamos que el documento no tenga antiguedad mayor a 4 años
		if($validacion->fails())
		{			
			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		*/
		








		
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Superación Académica')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//si las horas son mayores a 180 se asignan 40 puntos, de lo contrario de asigna la parte 
		//proporcional
		
		if(Input::get('noHoras')<180)
		{
			$documento->puntos=(40*Input::get('noHoras'))/180;
		}
		else
		{
			$documento->puntos=40;
		}
		
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();;
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		$imagenDiploma=new Imagen;
		$imagenDiploma->img=Str::random(20).Input::file('diplomaFile')->getClientOriginalName();;
		$imagenDiploma->descripcion='Diploma';
		
		
		
		$documento->observacion='';$documento->nombre='Diplomados';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16()/*,$e->getMessage()*/);
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			$imagenDiploma->documento()->associate($documento);
			$imagenConstancia->save();
			$imagenDiploma->save();
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/
		
		$diplomado=new Diplomado;
		/*Asociamos el diplomado al registri de la tabla padre al que corresponde*/
		$diplomado->documento()->associate($documento);
		
		
		$diplomado->nombreDiplomado=Input::get('nombre');
		$diplomado->nombreInstitucion=Input::get('nombreInstitucion');
		$diplomado->noHoras=Input::get('noHoras');
		$diplomado->nivel=Input::get('nivel');
		$diplomado->periodoInicio=Input::get('fechaInicio');
		$diplomado->periodoTermino=Input::get('fechaTermino');
		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
			Input::file('diplomaFile')->move('spdImg',$imagenDiploma->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$imagenDiploma->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),MensajesSPD::getMSG20('diploma'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		try
		{
		
			$diplomado->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$imagenDiploma->delete();
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
	}
	
	
	
	
	
	
	
	
	public function getLicenciatura()
	{
		return View::make('profesor.superacionAcademica.registrarLicenciatura');		
	}
	
	public function postLicenciatura()
	{
		
		
		$rules=array(
			'nombre' => 'required|min:5',						
			'fechaExamen' => 'required|date',						
			'noConstancia' => 'required|unique:imagenes,numero',
			'fechaConstancia' => 'required|date|after:'.Input::get('fechaExamen').'|before:'.date('d-m-Y'),
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800'
			
		);
		
		
		
		
		
		/*Mensajes de error*/		
		$messages=array(
		'nombre.min'=>MensajesSPD::getMSG19('nombre',5),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'fechaExamen.date'=>MensajesSPD::getMSG4('Fecha de exámen','(Dia-Mes-Año)'),		
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.after'=>MensajesSPD::getMSG15('Fecha de la constancia','Fecha de exámen'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		);
		
		
		
		
		
		
		
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Validacion del formulario.*/
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		
		
		/*Validacion de documentos posteriores a la ultima promocion*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}	
		
		
		
		
		
		
		$documento=new Documento;
		/*Ubicamos la solicitud activa(Solicitud que esta en periodo de registro y no ha sido enviada estatus=0)*/
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		
		$categoria=Categoria::where('nombre','=','Superación Académica')->first();
		$documento->idCategoria=$categoria->id;
		
		
		$documento->puntos=60;
		
		
		$imagenConstancia=new Imagen;		
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();;
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;
		
		$documento->observacion='';
		$documento->nombre='Otra Licenciatura';
		
		
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16()/*,$e->getMessage()*/);
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		$licenciatura=new Licenciatura;
		$licenciatura->documento()->associate($documento);
		$licenciatura->nombre=Input::get('nombre');
		$licenciatura->fechaExamen=Input::get('fechaExamen');
		
		
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);			
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),MensajesSPD::getMSG20('diploma'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		try
		{
		
			$licenciatura->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
				
	}
	
	
	
	
	
	
	public function postIdioma()
	{
		
		$rules=array(
			'nombre' => 'required|min:4',			
			'lee' => 'required',
			'escribe' => 'required',
			'habla' => 'required',			
			'noConstancia' => 'required|unique:imagenes,numero',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y'),
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800'
			
		);
		
		/*Mensajes de error*/		
		$messages=array(
		'nombre.min'=>MensajesSPD::getMSG19('Idioma',5),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),		
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		);
		
		
		
		
		
		
		
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Validacion del formulario.*/
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion='10-08-1980';//334713600->10-08-1980			
		}
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		
		
		
		
		$documento=new Documento;
		/*Ubicamos la solicitud activa(Solicitud que esta en periodo de registro y no ha sido enviada estatus=0)*/
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		
		$categoria=Categoria::where('nombre','=','Superación Académica')->first();
		$documento->idCategoria=$categoria->id;
		$puntos=0;
		$lee=false;
		$escribe=false;
		$habla=false;
		if(Input::get('lee')=='Si')
		{
			$puntos=$puntos+6;
			$lee=true;
		}
		if(Input::get('escribe')=='Si')
		{
			$puntos=$puntos+10;
			$escribe=true;
		}
		if(Input::get('habla')=='Si')
		{
			$puntos=$puntos+10;
			$habla=true;
		}
		$documento->puntos=$puntos;
		
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();;
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;
		
		$documento->observacion='';
		$documento->nombre='Idiomas';
		
		
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16()/*,$e->getMessage()*/);
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		$idioma=new Idioma;
		$idioma->documento()->associate($documento);
		$idioma->nombre=Input::get('nombre');
		$idioma->lee=$lee;
		$idioma->escribe=$escribe;
		$idioma->habla=$habla;
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);			
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),MensajesSPD::getMSG20('diploma'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
		
			$idioma->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
	}
	
	
	
	
	
	

	public function getIdioma()
	{
		return View::make('profesor.superacionAcademica.registrarIdioma');
	}
	
	
	
	public function getCursos_Actualizacion()
	{
		return View::make('profesor.superacionAcademica.registrarCursos');
	}
	
	public function postCursos_Actualizacion()
	{
		
		/*En este arreglo se ponen todas las reglas de validación para el formulario.
		De un lado va el "name" del campo que queremos aplicarle reglas de validacion y del otro lado separado por => van
		las reglas de validación que se aplicaran, cada regla va separada por el simbolo "|".
		
		Los nombres que van a la izquierda se obtienen de las vistas. Es decir el name de los campos
		que estan en los formularios de las vistas.
		*/
		
		
		$rules=array(
			'nombre' => 'required|min:5',			
			'noHoras' => 'required|integer',
			'fechaInicio' => 'required|date',			
			'fechaTermino' => 'required|date|after:'.Input::get('fechaInicio'),
			'tipoEvaluacion' => 'required|in:Con exámen,Sin exámen',
			'noConstancia' => 'required|unique:imagenes,numero',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.Input::get('fechaTermino'),			
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
		);
		
		
		
		
		
		
		/*Mensajes de error de acuerdo a las reglas de validación que contiene la variable $rules*/	

		/*
			En la parte de la izquierda, se pone el nombre del campo seguido de un punto y la regla de validación
			por la cual se incluira el mensaje.
			
			Ejemplo
				'nombre.min'=>MensajesSPD::getMSG19('nombre del diplomado',5),
				Este mensaje aparecera cuando el campo "nombre" falle al validar que el campo
				tenga cierto número de caracteres como minimo.
				'noHoras.integer'=>MensajesSPD::getMSG18('numero de horas'),
				En este ejemplo Mostrara el mensaje cuando el campo "noHoras" falle al validar que sea entero.
		*/
		$messages=array(
		'nombre.min'=>MensajesSPD::getMSG19('Nombre',5),

		'noHoras.integer'=>MensajesSPD::getMSG18('Horas de duración'),
		'fechaInicio.date'=>MensajesSPD::getMSG4('Fecha de inicio','(Dia-Mes-Año)'),	
		'fechaTermino.date'=>MensajesSPD::getMSG4('Fecha de termino','(Dia-Mes-Año)'),
		'fechaTermino.after'=>MensajesSPD::getMSG15_1('Fecha de termino','Fecha de inicio'),
		'tipoEvaluacion.in'=>MensajesSPD::getMSG21('Tipo de evaluación'),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.after'=>MensajesSPD::getMSG15_1('Fecha de la constancia','Fecha de termino'),		
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		);
		
		//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		$noCursos=0;
		$docs=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->get();
		//return $docs->toArray();
		foreach($docs as $doc)
		{
			$c=CursosActualizacion::find($doc->id);
			
			if(!empty($c))
			{				
				$noCursos=$noCursos+1;
			}
		}
		
		/*Validamos que los cursos que ha registrado sea menor que 7, si son 7 los que ha registrado, ha llegado al limite*/
		if($noCursos == 7)
		{
			$errores=array(MensajesSPD::getMSG24('Cursos de actualización, seminarios y talleres ',7));
			return Redirect::to('profesor/registrar')->withInput()->with('errores',$errores);
		}
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Superación Académica')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//si las horas son mayores a 180 se asignan 40 puntos, de lo contrario de asigna la parte 
		//proporcional
		
		if(Input::get('tipoEvaluacion')=='Con exámen')
		{
			$documento->puntos=3*(Input::get('noHoras')/15);
		}
		else if(Input::get('tipoEvaluacion')=='Sin exámen')
		{
			$documento->puntos=1*(Input::get('noHoras')/15);
		}
		
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		
		
		
		
		
		$documento->observacion='';
		$documento->nombre='Cursos de actualización, seminarios y talleres';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/
		
		$cursosA=new CursosActualizacion;
		/*Asociamos el diplomado al registro de la tabla padre al que corresponde*/
		$cursosA->documento()->associate($documento);
		
		
		$cursosA->nombre=Input::get('nombre');
		$cursosA->horasDuracion=Input::get('noHoras');
		$cursosA->evaluacion=Input::get('tipoEvaluacion');
		$cursosA->periodoInicio=Input::get('fechaInicio');
		$cursosA->periodoTermino=Input::get('fechaTermino');
		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		try
		{
		
			$cursosA->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}

		
	}
	

	
	
	public function getProgramayAreasCentrales()
	{
		return View::make('profesor.superacionAcademica.registrarPrograma');
	}
	
	
	public function postProgramayAreasCentrales()
	{
		/*En este arreglo se ponen todas las reglas de validación para el formulario.
		De un lado va el "name" del campo que queremos aplicarle reglas de validacion y del otro lado separado por => van
		las reglas de validación que se aplicaran, cada regla va separada por el simbolo "|".
		
		Los nombres que van a la izquierda se obtienen de las vistas. Es decir el name de los campos
		que estan en los formularios de las vistas.
		*/
		
		
		$rules=array(
			'dependenciaCoordinadora' => 'required|min:5',
			'nivel' => 'required|in:Nivel Superior,Nivel Medio Superior',
			'fechaInicio' => 'required|date',			
			'fechaTermino' => 'required|date|after:'.Input::get('fechaInicio').'|before:'.date('d-m-Y'),			
			'noConstancia' => 'required|unique:imagenes,numero',			
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
			'nivelParticipacion' => 'required|in:Analista,Coordinador',
			'tipoPrograma' => 'required|in:Programa Institucional,Proyecto Institucional,Proyecto de Dependencia',
		
		);
		
		
		
		
		/*Mensajes de error de acuerdo a las reglas de validación que contiene la variable $rules*/	

		/*
			En la parte de la izquierda, se pone el nombre del campo seguido de un punto y la regla de validación
			por la cual se incluira el mensaje.
			
			Ejemplo
				'nombre.min'=>MensajesSPD::getMSG19('nombre del diplomado',5),
				Este mensaje aparecera cuando el campo "nombre" falle al validar que el campo
				tenga cierto número de caracteres como minimo.
				'noHoras.integer'=>MensajesSPD::getMSG18('numero de horas'),
				En este ejemplo Mostrara el mensaje cuando el campo "noHoras" falle al validar que sea entero.
		*/
		$messages=array(
		'dependenciaCoordinadora.min'=>MensajesSPD::getMSG19('Dependencia Coordinadora',5),		
		'fechaInicio.date'=>MensajesSPD::getMSG4('Fecha de inicio','(Dia-Mes-Año)'),	
		'fechaTermino.date'=>MensajesSPD::getMSG4('Fecha de termino','(Dia-Mes-Año)'),
		'fechaTermino.after'=>MensajesSPD::getMSG15_1('Fecha de termino','Fecha de inicio'),
		'fechaTermino.before'=>MensajesSPD::getMSG15('Fecha de termino','fecha actual'),
		'nivel.in'=>MensajesSPD::getMSG21('Nivel'),
		'tipoPrograma.in'=>MensajesSPD::getMSG21('Tipo de Programa o proyecto'),
		'nivel.in'=>MensajesSPD::getMSG21('Nivel de participación'),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),		
		);
		
		
		
		
		
		
		//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
			
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaTermino' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('termino',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaTermino')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		
		
		
		
		
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Superación Académica')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//
		//
		$puntos=0;
		$tipoPrograma=Input::get('tipoPrograma');
		$nivelParticipacion=Input::get('nivelParticipacion');
		if($tipoPrograma=='Programa Institucional' && $nivelParticipacion=='Coordinador')
		{
			$puntos=9;
		}
		else if($tipoPrograma=='Proyecto Institucional' && $nivelParticipacion=='Coordinador')
		{
			$puntos=7;
		}
		else if($tipoPrograma=='Proyecto de Dependencia' && $nivelParticipacion=='Coordinador')
		{
			$puntos=5;
		}
		else if($tipoPrograma=='Programa Institucional' && $nivelParticipacion=='Analista')
		{
			$puntos=7;
		}
		else if($tipoPrograma=='Proyecto Institucional' && $nivelParticipacion=='Analista')
		{
			$puntos=5;
		}
		else if($tipoPrograma=='Proyecto de Dependencia' && $nivelParticipacion=='Analista')
		{
			$puntos=3;
		}
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();;
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		
		$documento->observacion='';
		$documento->nombre='Programas y proyectos institucionales en áreas centrales';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16()/*,$e->getMessage()*/);
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/
		$programasA=new ProgramaAreasCentrales;
		$programasA->dependenciaCoordinadora=Input::get('dependenciaCoordinadora');
		$programasA->nivel=Input::get('nivel');
		$programasA->inicio=Input::get('fechaInicio');
		$programasA->termino=Input::get('fechaTermino');
		$programasA->nivelParticipacion=Input::get('nivelParticipacion');
		$programasA->tipo=Input::get('tipoPrograma');
		
		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);			
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		try
		{
		
			$programasA->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
	}
	
	
	
	public function getInstructorProgramas()
	{
		return View::make('profesor.docencia.RegInstructorProgramas');
	}
	public function postInstructorProgramas()
	{
		$rules=array(
			'noHoras' => 'required|integer',
			'fechaInicio' => 'required|date',			
			'fechaTermino' => 'required|date|after:'.Input::get('fechaInicio'),
			'evaluacion' => 'required|in:Sin exámen,Con exámen',
			'noConstancia' => 'required|unique:imagenes,numero',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.Input::get('fechaTermino'),
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
		
		);
		
		
		$messages=array(
		'noHoras.integer'=>MensajesSPD::getMSG18('Horas de duración'),
		'fechaInicio.date'=>MensajesSPD::getMSG4('Fecha de inicio','(Dia-Mes-Año)'),	
		'fechaTermino.date'=>MensajesSPD::getMSG4('Fecha de termino','(Dia-Mes-Año)'),
		'fechaTermino.after'=>MensajesSPD::getMSG15_1('Fecha de termino','Fecha de inicio'),

		//'fechaTermino.before'=>MensajesSPD::getMSG15('Fecha de termino','Fecha de la constancia'),
		'evaluacion.in'=>MensajesSPD::getMSG21('Evaluación'),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.after'=>MensajesSPD::getMSG15_1('Fecha de la constancia','Fecha de termino'),
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		);
		
		//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion='10-08-1980';//334713600->10-08-1980			
		}
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		//Se procede a contar el numero de instructorProgramas tiene registrados en el proceso de promocion MAXIMO 7
		$noCursos=0;
		$docs=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->get();
		//return $docs->toArray();
		foreach($docs as $doc)
		{
			$c=InstructorProgramas::find($doc->id);
			
			if(!empty($c))
			{				
				$noCursos=$noCursos+1;
			}
		}
		
		/*Validamos que los cursos que ha registrado sea menor que 7, si son 7 los que ha registrado, ha llegado al limite*/
		if($noCursos == 7)
		{
			$errores=array(MensajesSPD::getMSG24('Instructor de programas de formación docente y actualización profesional',7));
			return Redirect::to('profesor/registrar')->withInput()->with('errores',$errores);
		}
		
		
		
		
		
		
		
		
		
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Superación Académica')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//si las horas son mayores a 180 se asignan 40 puntos, de lo contrario de asigna la parte 
		//proporcional
		
		if(Input::get('evaluacion')=='Con exámen')
		{
			$documento->puntos=(Input::get('noHoras')/15)*4.5;
		}
		else
		{
			$documento->puntos=(Input::get('noHoras')/15)*2;
		}
		
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();;
		$imagenConstancia->descripcion='Constancia de validación';
		
		$documento->observacion='';$documento->nombre='Instructor de programas de formación docente y actualización profesional';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16()/*,$e->getMessage()*/);
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/
		$instructorP=new InstructorProgramas;
		$instructorP->documento()->associate($documento);
		$instructorP->fechaTermino=Input::get('fechaTermino');
		$instructorP->fechaInicio=Input::get('fechaInicio');
		$instructorP->evaluacion=Input::get('evaluacion');
		$instructorP->horasDuracion=Input::get('noHoras');
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);			
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		try
		{
		
			$instructorP->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
	}
	
	
	
	
	
	public function getCargaAcademica()
	{
		return View::make('profesor.docencia.RegistrarCargaAcademica');
	}
	
	public function postCargaAcademica()
	{
		$rules=array(
			'modoCalificar' => 'required|in:Semestre',			
			'nivel' => 'required|in:Nivel Superior o Medio Superior',			
			'noHoras' => 'required|integer|min:0',
			'año' => 'required|integer|min:2000',
			'semestre' => 'required|in:1er Semestre,2do Semestre',	
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',			
		);
		
		
		$messages=array(
		
		'modoCalificar.in'		=>	MensajesSPD::getMSG21('Modo de calificar'),
		'nivel.in'		=>	MensajesSPD::getMSG21('Nivel'),
		'semestre.in'		=>	MensajesSPD::getMSG21('Semestre'),
		'noHoras.integer'	=>	MensajesSPD::getMSG18('Horas de duración'),
		'noHoras.min'	=>	MensajesSPD::getMSG25('Horas de duración'),
		'año.integer'=>MensajesSPD::getMSG18('Año'),
		'año.min'=>MensajesSPD::getMSG25('Año'),
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Horario o Constancia'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Horario o Constancia'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Horario o Constancia'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Horario o Constancia'),
		);
		
		
		//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		$var2=null;
		if(Input::get('semestre')=='1er Semestre')
		{
			$var2='21-01-';
		}
		else
		{
			$var2='5-08-';
		}
		
		$var=array('fechaConstancia'	=>	$var2.Input::get('año'));
		
		
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG26($ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,$var['fechaConstancia']))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Docencia')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		
		
		$documento->puntos=Input::get('noHoras')*1;
		
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');		
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
		$imagenConstancia->descripcion='Horario o Constancia';
		
		
		
		
		
		
		
		$documento->observacion='';$documento->nombre='Carga académica';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		$cargaA=new CargaAcademica;
		
		$cargaA->documento()->associate($documento);
		$cargaA->modoCalificar=Input::get('modoCalificar');
		$cargaA->semestre=Input::get('semestre');
		$cargaA->nivel=Input::get('nivel');
		$cargaA->totalHoras=Input::get('noHoras');
		$cargaA->año=Input::get('año');
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG20('Horario o constancia'),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
		
			$cargaA->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
	}
	
	
	
	
	public function getCursosProgramaRecuperacionAcademica()
	{
		return View::make('profesor.docencia.registrarCursosProgramaRecuperacion');
	}
	
	public function postCursosProgramaRecuperacionAcademica()
	{
		$f=(Input::get('semestre')=='1er Semestre')?date('21-01-'.Input::get('año')):date('5-08-'.Input::get('año'));
		$rules=array(
			'nivel' => 'required|in:Nivel Superior,Nivel Medio Superior',			
			'grupo'=>'required|min:4',
			'noHoras' => 'required|integer',
			'semestre' => 'required|in:1er Semestre,2do Semestre',
			'año' => 'required|integer',
			'noConstancia' => 'required|unique:imagenes,numero',
			'registro' => 'required',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.$f,			
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
		);
		
		
		$messages=array(	
		'grupo.min'	=>	MensajesSPD::getMSG19('Grupo',4),
		'noHoras.integer'=>MensajesSPD::getMSG18('Horas de duración'),
		'noHoras.min'=>MensajesSPD::getMSG25('Numero de horas semana-semestre'),
		'año.integer'=>MensajesSPD::getMSG18('Año'),
		'nivel.in'=>MensajesSPD::getMSG21('Nivel'),
		'semestre.in'=>MensajesSPD::getMSG21('Semestre'),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),		
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.after'=>MensajesSPD::getMSG28('Fecha de la constancia'),		
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		);
		
		
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('el oficio de autorización',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Docencia')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//si las horas son mayores a 180 se asignan 40 puntos, de lo contrario de asigna la parte 
		//proporcional
		
		$documento->puntos=Input::get('noHoras');
		
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->registro=Input::get('registro');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
		$imagenConstancia->descripcion='Oficio de autorización';
		
		
		
		
		
		
		
		$documento->observacion='';$documento->nombre='Cursos del programa de recuperacion académica estudiantil';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/
		$cursosProgramaRecuperacion=new CursosProgramaRecuperacionAcademica;
		$cursosProgramaRecuperacion->documento()->associate($documento);
		$cursosProgramaRecuperacion->año=Input::get('año');
		$cursosProgramaRecuperacion->semestre=Input::get('semestre');
		$cursosProgramaRecuperacion->grupo=strtoUpper(Input::get('grupo'));
		$cursosProgramaRecuperacion->nivel=Input::get('nivel');
		$cursosProgramaRecuperacion->noHoras=Input::get('noHoras');
		
		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG20('oficio de autorización'),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		try
		{
		
			$cursosProgramaRecuperacion->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}

		
		
		
	}
	
	public function getProgramaInduccionPropedeutico()
	{
		return View::make('profesor.docencia.registrarProgramaInduccionPropedeutico');
	}
	
	public function postProgramaInduccionPropedeutico()
	{
	
		$f=(Input::get('semestre')=='1er Semestre')?date('21-01-'.Input::get('año')):date('5-08-'.Input::get('año'));
		$rules=array(
			'nivel' => 'required|in:Nivel Superior,Nivel Medio Superior,Posgrado',			
			'grupo'=>'required|min:4',
			'noHoras' => 'required|integer',
			'semestre' => 'required|in:1er Semestre,2do Semestre',
			'año' => 'required|integer',
			'noConstancia' => 'required|unique:imagenes,numero',
			'registro' => 'required',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.$f,			
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
		);
		
		
		$messages=array(	
		'grupo.min'	=>	MensajesSPD::getMSG19('Grupo',4),
		'noHoras.integer'=>MensajesSPD::getMSG18('Horas de duración'),
		'noHoras.min'=>MensajesSPD::getMSG25('Numero de horas semana-semestre'),
		'año.integer'=>MensajesSPD::getMSG18('Año'),
		'nivel.in'=>MensajesSPD::getMSG21('Nivel'),
		'semestre.in'=>MensajesSPD::getMSG21('Semestre'),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.after'=>MensajesSPD::getMSG28('Fecha de la constancia'),		
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		);
		
		
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia de validacion',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Docencia')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//si las horas son mayores a 180 se asignan 40 puntos, de lo contrario de asigna la parte 
		//proporcional
		if(Input::get('nivel')=='Posgrado')
		{
			$documento->puntos=Input::get('noHoras')*1.250;
		}
		else if(Input::get('nivel')=='Nivel Superior')
		{
			$documento->puntos=Input::get('noHoras');
		}
		else
		{
			$documento->puntos=5;
		}
		
		
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->registro=Input::get('registro');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		
		
		
		
		
		$documento->observacion='';$documento->nombre='Programa de inducción, propedéutico o atencion a pasantes';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/
		$programaInduccion=new ProgramaInduccionPropedeutico;
		$programaInduccion->documento()->associate($documento);
		$programaInduccion->año=Input::get('año');
		$programaInduccion->semestre=Input::get('semestre');
		$programaInduccion->grupo=strtoUpper(Input::get('grupo'));
		$programaInduccion->nivel=Input::get('nivel');
		$programaInduccion->noHoras=Input::get('noHoras');
		
		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		try
		{
		
			$programaInduccion->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}

		
		
	
	}
	
	public function getProgramaInstitucionalOrientacionJuvenil()
	{
		return View::make('profesor.docencia.registrarProgramaInstitucionalOrientacionJuvenil');
	}
	
	public function postProgramaInstitucionalOrientacionJuvenil()
	{
		$f=(Input::get('semestre')=='1er Semestre')?date('21-01-'.Input::get('año')):date('5-08-'.Input::get('año'));
		$rules=array(
			'nombre'=>'required|in:Maestro tutor,Atención Especializada,Instructor del diplomado y/o seminario de desarrollo humano',
			'nivel' => 'required|in:Nivel Superior,Nivel Medio Superior,Posgrado',			
			'grupo'=>'required|min:4',
			'noHoras' => 'required|integer',
			'semestre' => 'required|in:1er Semestre,2do Semestre',
			'año' => 'required|integer',
			'noConstancia' => 'required|unique:imagenes,numero',
			'registro' => 'required',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.$f,			
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
		);
		
		
		$messages=array(	
		'nombre.in'=>MensajesSPD::getMSG21('Nombre de la actividad'),
		'grupo.min'	=>	MensajesSPD::getMSG19('Grupo',4),
		'noHoras.integer'=>MensajesSPD::getMSG18('Horas de duración'),
		'noHoras.min'=>MensajesSPD::getMSG25('Numero de horas semana-semestre'),
		'año.integer'=>MensajesSPD::getMSG18('Año'),
		'nivel.in'=>MensajesSPD::getMSG21('Nivel'),
		'semestre.in'=>MensajesSPD::getMSG21('Semestre'),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.after'=>MensajesSPD::getMSG28('Fecha de la constancia'),		
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		);
		
		
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('constancia de validación',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Docencia')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//si las horas son mayores a 180 se asignan 40 puntos, de lo contrario de asigna la parte 
		//proporcional
		
		$documento->puntos=Input::get('noHoras');
		
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->registro=Input::get('registro');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		
		
		
		
		
		$documento->observacion='';
		$documento->nombre='Programa Institucional de Orientación Juvenil';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/
		$orientacion=new ProgramaInstitucionalOrientacionJuvenil;		
		$orientacion->documento()->associate($documento);
		$orientacion->año=Input::get('año');
		$orientacion->nombre=Input::get('nombre');
		$orientacion->semestre=Input::get('semestre');
		$orientacion->grupo=strtoUpper(Input::get('grupo'));
		$orientacion->nivel=Input::get('nivel');
		$orientacion->noHoras=Input::get('noHoras');
		
		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		try
		{
		
			$orientacion->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
	}
	
	
	
	public function getProgramaInstitucionalTutorias()
	{
		return View::make('profesor.docencia.registrarProgramaInstitucionalTutorias');
	}
	
	
	public function postProgramaInstitucionalTutorias()
	{
		$f=(Input::get('semestre')=='1er Semestre')?date('21-01-'.Input::get('año')):date('5-08-'.Input::get('año'));
		$rules=array(
			'nombre'=>'required|in:Tutor,Coordinador',
			'nivel' => 'required|in:Nivel Superior,Nivel Medio Superior,Posgrado',			
			'calidad' => 'required|in:Ninguna,Excelente,Regular,Buena',
			'noHoras' => 'required|integer',
			'alumnos' => 'required|integer',
			'semestre' => 'required|in:1er Semestre,2do Semestre',
			'año' => 'required|integer',
			'noConstancia' => 'required|unique:imagenes,numero',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.$f,			
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
		);
		
		
		$messages=array(	
		'nombre.in'=>MensajesSPD::getMSG21('Nombre de la actividad'),
		'grupo.min'	=>	MensajesSPD::getMSG19('Grupo',4),
		'noHoras.integer'=>MensajesSPD::getMSG18('Horas de duración'),
		'noHoras.min'=>MensajesSPD::getMSG25('Numero de horas semana-semestre'),
		'año.integer'=>MensajesSPD::getMSG18('Año'),
		'nivel.in'=>MensajesSPD::getMSG21('Nivel'),
		'semestre.in'=>MensajesSPD::getMSG21('Semestre'),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.after'=>MensajesSPD::getMSG28('Fecha de la constancia'),		
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		);
		
		if(Input::get('alumnos')<0)
		{
			$errores=array(MensajesSPD::getMSG25('Número de alumnos'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		if(Input::get('calidad')=='Ninguna' && Input::get('nombre')=='Coordinador')
		{
			$errores=array(MensajesSPD::getMSG32('Calidad','Ninguna','Nombre de la actividad','Coordinador'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		if(Input::get('calidad')!='Ninguna' && Input::get('nombre')=='Tutor')
		{
			$errores=array(MensajesSPD::getMSG32('Calidad','Excelente,Buena o Regular','Nombre de la actividad','Tutor'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('constancia de validación',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Docencia')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//si las horas son mayores a 180 se asignan 40 puntos, de lo contrario de asigna la parte 
		//proporcional
		
		if(Input::get('nombre')=='Coordinador')
		{
			if(Input::get('calidad')=='Excelente')
			{
				$documento->puntos=15;
			}
			else if(Input::get('calidad')=='Buena')
			{
				$documento->puntos=12.5;
			}
			else if(Input::get('calidad')=='Regular')
			{
				$documento->puntos=10;
			}
		}
		else
		{
			$documento->puntos=Input::get('noHoras');
		}
		
		
		
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		
		
		
		
		
		$documento->observacion='';
		$documento->nombre='Programa Institucional de Tutorías';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/
		
		$tutorias=new ProgramaInstitucionalTutoria;
		
		
		
		$tutorias->documento()->associate($documento);
		$tutorias->año=Input::get('año');
		$tutorias->nombre=Input::get('nombre');
		$tutorias->semestre=Input::get('semestre');
		$tutorias->noAlumnos=Input::get('alumnos');
		$tutorias->nivel=Input::get('nivel');
		$tutorias->noHoras=Input::get('noHoras');
		$tutorias->calidad=Input::get('calidad');
		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		try
		{
		
			$tutorias->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
	}
	
	
	public function getImparticionEventosEducacionContinua()
	{
		
		$noCursos=0;
		$docs=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->get();
		//return $docs->toArray();
		foreach($docs as $doc)
		{
			$c=ImparticionEventoEducacionContinua::find($doc->id);
			
			if(!empty($c))
			{				
				$noCursos=$noCursos+1;
			}
		}
		
		/*Validamos que los cursos que ha registrado sea menor que 7, si son 7 los que ha registrado, ha llegado al limite*/
		if($noCursos == 7)
		{
			$errores=array(MensajesSPD::getMSG24('Imparticion de eventos de actualización en educación continua.',7));
			return Redirect::to('profesor/registrar')->withInput()->with('errores',$errores);
		}
		
		return View::make('profesor.docencia.registrarImparticionEventosEducacionContinua');
	}
	
	public function postImparticionEventosEducacionContinua()
	{
		$rules=array(
			'nombre' => 'required|in:Diplomado,Curso,Taller,Seminario',			
			'noHoras' => 'required|integer',
			'fechaInicio' => 'required|date',			
			'fechaTermino' => 'required|date|after:'.Input::get('fechaInicio'),
			'tipoEvaluacion' => 'required|in:Con exámen,Sin exámen',
			'noConstancia' => 'required|unique:imagenes,numero',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.Input::get('fechaTermino'),			
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
		);
		
		
		
		$messages=array(
		'nombre.in'=>MensajesSPD::getMSG21('Nombre del evento'),
		'noHoras.integer'=>MensajesSPD::getMSG18('Horas de duración'),
		'fechaInicio.date'=>MensajesSPD::getMSG4('Fecha de inicio','(Dia-Mes-Año)'),	
		'fechaTermino.date'=>MensajesSPD::getMSG4('Fecha de termino','(Dia-Mes-Año)'),
		'fechaTermino.after'=>MensajesSPD::getMSG15_1('Fecha de termino','Fecha de inicio'),
		'tipoEvaluacion.in'=>MensajesSPD::getMSG21('Tipo de evaluación'),
		'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
		'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
		'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
		'fechaConstancia.after'=>MensajesSPD::getMSG15_1('Fecha de la constancia','Fecha de termino'),		
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
		);
		
		
		//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		
		
		
		
		
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		
		
		
		
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Superación Académica')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//si las horas son mayores a 180 se asignan 40 puntos, de lo contrario de asigna la parte 
		//proporcional
		
		if(Input::get('tipoEvaluacion')=='Con exámen')
		{
			$documento->puntos=4.5*(Input::get('noHoras')/15);
		}
		else if(Input::get('tipoEvaluacion')=='Sin exámen')
		{
			$documento->puntos=2*(Input::get('noHoras')/15);
		}
		
		
		
		
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		
		
		
		
		
		$documento->observacion='';
		$documento->nombre='Impartición de eventos de actualización en educación continua';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/
		
		$imparticion=new ImparticionEventoEducacionContinua;
		/*Asociamos el diplomado al registro de la tabla padre al que corresponde*/
		$imparticion->documento()->associate($documento);
		
		
		$imparticion->nombre=Input::get('nombre');
		$imparticion->horasDuracion=Input::get('noHoras');
		$imparticion->evaluacion=Input::get('tipoEvaluacion');
		$imparticion->fechaInicio=Input::get('fechaInicio');
		$imparticion->fechaTermino=Input::get('fechaTermino');
		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		try
		{
		
			$imparticion->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();			
			$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
			return Redirect::back()->withInput()->with('errores',$errores);
		}

		
		
	}
	
	
	
	public function getAutoriaLibrosImpresosDigitales()
	{
		
	}
	public function postAutoriaLibrosImpresosDigitales()
	{
	
	}
	
	
	
	/****************************************Seccion de marco************************************************/
	/****************************************Seccion de marco************************************************/
	/****************************************Seccion de marco************************************************/
	/****************************************Seccion de marco************************************************/
	/****************************************Seccion de marco************************************************/
	/****************************************Seccion de marco************************************************/
	/****************************************Seccion de marco************************************************/
	/****************************************Seccion de marco************************************************/
	
	public function getPolilibro(){
	//la vista blade esta en la direccion que le pasamos al make
	return View::make('profesor.docencia.RegistropoliLibro');
	}
	
  
  	
	
	
	
	
	
	public function postPolilibro()
	{

				/*En este arreglo se ponen todas las reglas de validación para el formulario.
					De un lado va el "name" del campo que queremos aplicarle reglas de validacion y del otro lado separado por => van
					las reglas de validación que se aplicaran, cada regla va separada por el simbolo "|".
					
					Los nombres que van a la izquierda se obtienen de las vistas. Es decir el name de los campos
					que estan en los formularios de las vistas.
					*/
				

				$rules= array(
					'numeroAutores'=>'required|integer|min:1',
			 		'nivelaplicacion'=>'required|in:Medio Superior,Superior,Posgrado',
			  		'año'=>'required|integer',
			  		'pais'=>'required|min:4',
			  		'calidad'=>'required|integer|in:1,2,3',
					'noConstancia' => 'required|unique:imagenes,numero',
					'fechaConstancia' => 'required|date|before:'.date('d-m-Y'),
					'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
			          	
				);
				//Mensajes de error
				

				$messages=array(
				'numeroAutores.integer'=>MensajesSPD::getMSG18('número de Autores'),
				'numeroAutores.min'=>MensajesSPD::getMSG19('número de Autores',1),
				'nivelaplicacion.in'=>MensajesSPD::getMSG21('Nivel de Aplicación'),
				'año.integer'=>MensajesSPD::getMSG18('Año'),
				'pais.min'=>MensajesSPD::getMSG19('Pais',4),
				'calidad.in'=>MensajesSPD::getMSG21('Calidad'),
				'constanciaFile.image'=> MensajesSPD::getMSG7_1('Archivo Imagen'),
				'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
				'constanciaFile.max'=> MensajesSPD::getMSG6('Archivo Imagen'),
				'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
				'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
				'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
				);
				//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
					//$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
					los datos que había llenado el usuario
					
					Para mandar los errores se logra con ->withErrors($validacion)
					Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
					*/
			          
			          	$validacion=Validator::make(Input::all(),$rules,$messages);
			          
					if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					
					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}
					

					/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}
					
					///////////////////////////////////////////////////////////////////////
					/*Validacion para que la seccion sea posterior a la ultima promocion*/
					
					$rules=array(
						'fechaConstancia' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);
					
					
					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}


						/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	
					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	

					$rules=array(
						'fechaConstancia' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}

					//guardar informacion, se crea objeto documento
					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Docencia')->first();
					$documento->idCategoria=$categoria->id;

					//asignamos los puntos conforme la calidad que se obtuvo

					if(Input::get('calidad')==1)
						$documento->puntos=80;

					else if(Input::get('calidad')==2)
						$documento->puntos=50;

					else if(Input::get('calidad')==3)
						$documento->puntos=20;

					/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
					objetos con los datos que proporciono el usuario
					
					*/
					$documento->aprobado=false;
					$documento->cotejado=false;	
					//Se asignan las imagenes a los objetos que las guardaran

					$imagenConstancia=new Imagen;
					$imagenConstancia->numero=Input::get('noConstancia');
					$imagenConstancia->fecha=Input::get('fechaConstancia');
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';

					$documento->observacion='';$documento->nombre='Elaboracion de Polilibros';

					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					$polilibro= new Polilibro;
					$polilibro->documento()->associate($documento);

					$polilibro->numeroAutores=Input::get('numeroAutores');
					$polilibro->nivelaplicacion=Input::get('nivelaplicacion');
					$polilibro->año=Input::get('año');
					$polilibro->pais=Input::get('pais');
					$polilibro->calidad=Input::get('calidad');


					/*NAMES
					numeroAutores
			 		'nivelaplicacion
			  		'año'
			  		'pais'
			  		'calidad'
					
					*/



					try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						$polilibro->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16());
						return Redirect::back()->withInput()->with('errores',$errores);
					}			
	}
	
  
  				public function getDesarrolloIntegral(){
				//la vista blade esta en la direccion que le pasamos al make
				return View::make('profesor.docencia.RegistrarDesarrolloInt');
				}

			public function postDesarrolloIntegral()
			{


				/*
					NAMES
					semestre
					año
					grupo
					nivel
					NohorasSem
					registroconstancia
					-------------
					noConstancia
					fechaConstancia
					constanciaFile
					-----------------

					ATRIBUTOS SQL
					`noHorasSem` 
					  `año` 
					  `nivel` ,
					  `grupo` 
					  `semestreEsc` 
					  `registro` 

					*/

					  /*En este arreglo se ponen todas las reglas de validación para el formulario.
					De un lado va el "name" del campo que queremos aplicarle reglas de validacion y del otro lado separado por => van
					las reglas de validación que se aplicaran, cada regla va separada por el simbolo "|".
					
					Los nombres que van a la izquierda se obtienen de las vistas. Es decir el name de los campos
					que estan en los formularios de las vistas.
					*/

					//0.625 U.P  hora-semana-mes
				$rules= array(

						'semestre'=>'required|in:1,2',
						'grupo'=>'required|min:4',
						'año'=>'required|integer',
						'nivel'=>'required|in:Medio Superior,Superior,Posgrado',
						'NohorasSem'=>'required|integer',
						'registroconstancia'=>'required|min:1',
						'noConstancia' => 'required|unique:imagenes,numero',
						'fechaConstancia' => 'required|date|before:'.date('d-m-Y'),
						'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
					);

					
				$messages=array(

						'semestre.in'=>MensajesSPD::getMSG21('Semestre'),
						'grupo.min'=>MensajesSPD::getMSG19('Grupo',4),
						'año.integer'=>MensajesSPD::getMSG18('Año'),
						'nivel.in'=>MensajesSPD::getMSG21('Nivel'),
						'NohorasSem.integer'=>MensajesSPD::getMSG18('Número de horas de Semestre'),
						'registroconstancia.min'=>MensajesSPD::getMSG19('Número de caracteres',1),
						'constanciaFile.image'=> MensajesSPD::getMSG7_1('Archivo Imagen'),
						'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
						'constanciaFile.max'=> MensajesSPD::getMSG6('Archivo Imagen'),
						'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
						'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
						'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),

					);	

				//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
					//$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
					los datos que había llenado el usuario
					
					Para mandar los errores se logra con ->withErrors($validacion)
					Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
					*/

			        $validacion=Validator::make(Input::all(),$rules,$messages);


			        if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					
					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}
					/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}

					$rules=array(
						'fechaConstancia' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}

					/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	
					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	

					$rules=array(
						'fechaConstancia' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}
                          
                          	//vamos a validar que la fecha de la constancia sea posterior a la del año
                          	//del merito
                          ///////////////////////
                          
                          		
                          		 //si es e lsemestre 1                          
                        if(Input::get('semestre')==1) {
                                $fecha1=strtotime('21-01-'.Input::get('año'));	//fecha del semestre 1
                                $fecha3=strtotime(Input::get('fechaConstancia'));//fecha constancia
                        
                                if($fecha1>$fecha3){
                                  
                                  	$errores=array(MensajesSPD::getMSG15_1(Input::get('fechaConstancia'),'21-01-'.Input::get('año')));
					  return Redirect::back()->withInput()->with('errores',$errores);
                               		 }
                        
				}     					  

//si es el semestre 2
                                  if (Input::get('semestre')==2){
                                          $fecha2=strtotime('11-08'.Input::get('año'));		//fecha del semstres 2
                                          $fecha3=strtotime(Input::get('fechaConstancia')); 	//fecha de la constancia
                                  
                                          if($fecha2>$fecha3){
                                                  $errores=array(MensajesSPD::getMSG15_1(Input::get('fechaConstancia'),'11-08'.Input::get('año')));
						 return Redirect::back()->withInput()->with('errores',$errores);
                                          }
                                  
                                         
                                  }   
                          
                          
                          
                          
                          
                          
                          
                          
                          ////////////////////////////////
					//guardar informacion, se crea objeto documento
					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Docencia')->first();
					$documento->idCategoria=$categoria->id;

					//asignamos los puntos conforme la calidad que se obtuvo

					//0.625 U.P.
					$documento->puntos=Input::get('NohorasSem')*.625;
					/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
					objetos con los datos que proporciono el usuario
					
					*/
					$documento->aprobado=false;
					$documento->cotejado=false;	

					$imagenConstancia=new Imagen;
					$imagenConstancia->numero=Input::get('noConstancia');
					$imagenConstancia->fecha=Input::get('fechaConstancia');
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';

					$documento->observacion='';$documento->nombre='Programa institucional para el desarrollo integral';

					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					$desarrollointegral=new DesarrolloIntegral;
					$desarrollointegral->documento()->associate($documento);
					//$nombreVariable->atributoDeLaTablaDiplomado=valor
					$desarrollointegral->semestreESC=Input::get('semestre');
					$desarrollointegral->noHorasSem=Input::get('NohorasSem');
					$desarrollointegral->año=Input::get('año');
					$desarrollointegral->nivel=Input::get('nivel');
					$desarrollointegral->grupo=strtoupper(Input::get('grupo'));
					$desarrollointegral->registro=Input::get('registroconstancia');

					/*
					semestre
					año
					grupo
					nivel
					NohorasSem
					registroconstancia
					*/

					/*
					  `semestreEsc` 
					  `noHorasSem`
					  `año` 
					  `nivel` 
					  `grupo` 
					  `registro` */
					
					try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						$desarrollointegral->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16());
						return Redirect::back()->withInput()->with('errores',$errores);
					}


			}	//fin de class
  
		
  
  	
  
  
  
  
  		public function getEvalProgramas()
			{
				//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrarDiplomado.blade.php
				//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
				return View::make('profesor.ActComplementarias.RegEvaluacionProgramas');
			}

		public function postEvalProgramas(){

			$rules=array(
				'numeroRegistro'=>'required|min:1',
				'nombrePrograma'=> 'required|min:5',
				'fechaInicio' => 'required|date',			
				'fechaTermino' => 'required|date|after:'.Input::get('fechaInicio'),
				'noConstancia' => 'required|unique:imagenes,numero',
				'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.Input::get('fechaTermino'),
				'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
				'constancia2'=> 'required|image|mimes:jpeg|max:716800',
			);
			
			$messages=array(
				'numeroRegistro.min'=>MensajesSPD::getMSG19('Nombre',1),
				'nombrePrograma.min'=>MensajesSPD::getMSG19('Nombre',5),
				'fechaInicio.date'=>MensajesSPD::getMSG4('Fecha de inicio','(Dia-Mes-Año)'),	
				'fechaTermino.date'=>MensajesSPD::getMSG4('Fecha de termino','(Dia-Mes-Año)'),
				'fechaTermino.after'=>MensajesSPD::getMSG15_1('Fecha de termino','Fecha de inicio'),
				'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
				'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
				'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
				'fechaConstancia.after'=>MensajesSPD::getMSG15_1('Fecha de la constancia','Fecha de termino'),
				'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
				'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
				'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
				'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
				'constancia2.required'=> MensajesSPD::getMSG3('Calificacion'),
				'constancia2.image'=> MensajesSPD::getMSG7_1('Calificacion'),
				'constancia2.mimes'=> MensajesSPD::getMSG7('Calificacion'),
				'constancia2.max'=> MensajesSPD::getMSG6('Calificacion'),
				);

		//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/

			

		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		//Validamos que el formato de la imagen del diploma es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constancia2')))
		{
			$errores=array(MensajesSPD::getMSG7('Calificaciones'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		

		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	


		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		
		


		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
                  
                  
                
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Actividades Complementarias')->first();
		$documento->idCategoria=$categoria->id;
                  /////////////////////////////////////////////////////////////////
                        $noCursos=0;
                        $docs=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->get();
                        //return $docs->toArray();
                        foreach($docs as $doc)
                        {
                                $c=EvaluacionDeProgramas::find($doc->id);
                                
                                if(!empty($c))
                                {				
                                        $noCursos=$noCursos+1;
                                }
                        }
                        
                        /*Validamos que los cursos que ha registrado sea menor que 7, si son 7 los que ha registrado, ha llegado al limite*/
                        if($noCursos == 2)
                        {
                                $errores=array(MensajesSPD::getMSG24('Programas de Servicio Social',2));
			return Redirect::to('profesor/registrar')->withInput()->with('errores',$errores);
		}
                  
                  /////////////////////////////////////////////////////////////////////
		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();;
		$imagenConstancia->descripcion='Constancia de validación';
		
		
		$constancia2=new Imagen;
		$constancia2->img=Str::random(20).Input::file('constancia2')->getClientOriginalName();;
		$constancia2->descripcion='Calificaciones';

		$documento->observacion='';$documento->nombre='Evaluación de informes de programas de servicio social';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16()/*,$e->getMessage()*/);
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			$constancia2->documento()->associate($documento);
			$imagenConstancia->save();
			$constancia2->save();
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}

		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/



		$RegEvaluacionProgramas=new  EvaluacionDeProgramas;
		$RegEvaluacionProgramas->documento()->associate($documento);

		$RegEvaluacionProgramas->nombrePrograma=Input::get('nombrePrograma');
		$RegEvaluacionProgramas->numeroRegistro=Input::get('numeroRegistro');
		$RegEvaluacionProgramas->periodoInicio=Input::get('fechaInicio');
		$RegEvaluacionProgramas->periodoFin=Input::get('fechaTermino');



		/*
		'numeroRegistro'=>'required|min:1',
		'nombrePrograma'=> 'required|min:5',
		'fechaInicio' => 'required|date',			
		'fechaTermino' => 'required|date|after:'.Input::get('fechaInicio'),



		`nombrePrograma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  		`numeroRegistro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  		`periodoInicio` date NOT NULL,
  		`periodoFin` date NOT NULL,
		*/
  		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
			Input::file('constancia2')->move('spdImg',$constancia2->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$constancia2->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),MensajesSPD::getMSG20('Calificaciones'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}


		try
		{
		
			$RegEvaluacionProgramas->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$constancia2->delete();
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		






		}//fin
	
  
  
  			public function getInstructoresEnOlimpiadas()
	{
		//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrarDiplomado.blade.php
		//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
		return View::make('profesor.ActComplementarias.RegInstruOlimp');


	}

	public function postInstructoresEnOlimpiadas(){


		$rules= array(
			'nombreEvento'=>'required|min:5',
			'fecha'=>'required|date|before:'.date('d-m-Y'),
			'lugar'=>'required|min:5',
			'evento'=>'required|in:1,2',
			'constanciaFile'=>'required|image|mimes:jpeg|max:716800',
			);

		$messages=array(
                  	
			'evento.in'=>MensajesSPD::getMSG21('Evento'),
			'nombreEvento.min'=>MensajesSPD::getMSG19('Nombre del evento',5),
			'lugar.min'=>MensajesSPD::getMSG19('Lugar del evento',5),
                  	'fecha.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
			'fecha.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
			'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
			'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
			'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
			'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),	
			);
		  $validacion=Validator::make(Input::all(),$rules,$messages);
		  if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					
					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}
					/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}

					$rules=array(
						'fecha' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}


					/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	

					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fecha')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	

					$rules=array(
						'fecha' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}

					/*Asignacion de puntos */
					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Actividades Complementarias')->first();
					$documento->idCategoria=$categoria->id;
		/////////////////////////////////////////////////////////////////
                        $noCursos=0;
                        $docs=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->get();
                        //return $docs->toArray();
                        foreach($docs as $doc)
                        {
                                $c=InstructoresEnOlimpiadas::find($doc->id);
                                
                                if(!empty($c))
                                {				
                                        $noCursos=$noCursos+1;
                                }
                        }
                        
                        /*Validamos que los cursos que ha registrado sea menor que 2, si son 2 los que ha registrado, ha llegado al limite*/
                        if($noCursos == 2)
                        {
                                $errores=array(MensajesSPD::getMSG24('Programas de Olimpiadas',2));
			return Redirect::to('profesor/registrar')->withInput()->with('errores',$errores);
		}
         
                  
                  /////////////////////////////////////////////////////////////////////	
          			
          				//Asignacion de puntos 
          
          				if(Input::get('evento')==1){
						$documento->puntos=5;
                                          //$InstructoresEnOlimpiadas->evento="Nacional";
                                        }

          				if(Input::get('evento')==2){
                                          //$InstructoresEnOlimpiadas->evento="Internacional";
                                         	 $documento->puntos=7;}
          
          
					$documento->aprobado=false;
					$documento->cotejado=false;	

					$imagenConstancia=new Imagen;
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';


					$documento->observacion='';$documento->nombre='Instructores en olimpiadas nacionales e internacionales';

					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}


          				$InstructoresEnOlimpiadas= new InstructoresEnOlimpiadas;

					$InstructoresEnOlimpiadas->documento()->associate($documento);
					$InstructoresEnOlimpiadas->nombreEvento=Input::get('nombreEvento');
					$InstructoresEnOlimpiadas->fechaEvento=Input::get('fecha');
					$InstructoresEnOlimpiadas->lugar=Input::get('lugar');
          				$InstructoresEnOlimpiadas->evento=Input::get('evento');



					/*`nombreEvento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					  `fechaEvento` date NOT NULL,
					  `lugar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					  `evento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,


						'nombreEvento'=>'required|min:5',
						'fecha'=>'required|date',
						'lugar'=>'required|min:5',
						'evento'=>'required|min:5',
						'constanciaFile'=>'required|image|mimes:


					  */


						try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						$InstructoresEnOlimpiadas->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16());
						return Redirect::back()->withInput()->with('errores',$errores);
					}





					}//fin
  
  
  
  			public function getPracticasEscolares()
			{
				//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrarDiplomado.blade.php
				//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
				return View::make('profesor.ActComplementarias.RegEvalPractEsco');
			}


		public function postPracticasEscolares(){

			/*En este arreglo se ponen todas las reglas de validación para el formulario.
			De un lado va el "name" del campo que queremos aplicarle reglas de validacion y del otro lado separado por => van
			las reglas de validación que se aplicaran, cada regla va separada por el simbolo "|".
			
			Los nombres que van a la izquierda se obtienen de las vistas. Es decir el name de los campos
			que estan en los formularios de las vistas.
			*/
		
			$rules= array(
				'nivel'=>'required|in:Medio Superior,Superior,Posgrado',
				'fechaInicio'=>'required|date',
				'fechaTermino'=>'required|date|after:'.Input::get('fechaInicio'),
				'noConstancia' => 'required|unique:imagenes,numero',
				'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.Input::get('fechaTermino'),
				'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
				'califFile'=> 'required|image|mimes:jpeg|max:716800',
				);

			/*Mensajes de error de acuerdo a las reglas de validación que contiene la variable $rules*/	

			/*
				En la parte de la izquierda, se pone el nombre del campo seguido de un punto y la regla de validación
				por la cual se incluira el mensaje.
				
				Ejemplo
					'nombre.min'=>MensajesSPD::getMSG19('nombre del diplomado',5),
					Este mensaje aparecera cuando el campo "nombre" falle al validar que el campo
					tenga cierto número de caracteres como minimo.
					'noHoras.integer'=>MensajesSPD::getMSG18('numero de horas'),
					En este ejemplo Mostrara el mensaje cuando el campo "noHoras" falle al validar que sea entero.
			*/

			$messages=array(
				
				'fechaInicio.date'=>MensajesSPD::getMSG4('Fecha de inicio','(Dia-Mes-Año)'),	
				'fechaTermino.date'=>MensajesSPD::getMSG4('Fecha de termino','(Dia-Mes-Año)'),
				'fechaTermino.after'=>MensajesSPD::getMSG15_1('Fecha de termino','Fecha de inicio'),

				//'fechaTermino.before'=>MensajesSPD::getMSG15('Fecha de termino','Fecha de la constancia'),
				'nivel.in'=>MensajesSPD::getMSG21('Nivel'),
				'noConstancia.unique'=>MensajesSPD::getMSG23('El número de Oficio'),
				'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de Oficio','(Dia-Mes-Año)'),
				'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la Oficio','fecha actual'),
				'fechaConstancia.after'=>MensajesSPD::getMSG15_1('Fecha de la Oficio','Fecha de termino'),
				'constanciaFile.image'=> MensajesSPD::getMSG7_1('Oficio de validación'),
				'constanciaFile.mimes'=> MensajesSPD::getMSG7('Oficio de validación'),
				'constanciaFile.max'=> MensajesSPD::getMSG6('Oficio de validación'),
				'constanciaFile.required'=> MensajesSPD::getMSG3('Oficio de validación'),
				'califFile.required'=> MensajesSPD::getMSG3('Calificaciones'),
				'califFile.image'=> MensajesSPD::getMSG7_1('Calificaciones'),
				'califFile.mimes'=> MensajesSPD::getMSG7('Calificaciones'),
				'califFile.max'=> MensajesSPD::getMSG6('Calificaciones'),
				
			);	
			//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)

			$validacion=Validator::make(Input::all(),$rules,$messages);

			/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('Oficio de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		//Validamos que el formato de la imagen del diploma es el correcto
		if(!BRules::validarFormatoImagen(Input::file('califFile')))
		{
			$errores=array(MensajesSPD::getMSG7('Calificaciones'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}

		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}
		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}


		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}	
		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Actividades Complementarias')->first();
		$documento->idCategoria=$categoria->id;
		
		//Asignamos los puntos correpondientes al documento
		//Estos puntos pueden variar dependiendo el documento, en este casos
		//si las horas son mayores a 180 se asignan 40 puntos, de lo contrario de asigna la parte 
		//proporcional

                 
		/////////////////////////////////////////////////////////////////
                        $noCursos=0;
                        $docs=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->get();
                        //return $docs->toArray();
                        foreach($docs as $doc)
                        {
                                $c=PracticasEscolares::find($doc->id);
                                
                                if(!empty($c))
                                {				
                                        $noCursos=$noCursos+1;
                                }
                        }
                        
                        /*Validamos que los cursos que ha registrado sea menor que 7, si son 7 los que ha registrado, ha llegado al limite*/
                        if($noCursos == 2)
                        {
                                $errores=array(MensajesSPD::getMSG24('Prcaticas Escolares',2));
			return Redirect::to('profesor/registrar')->withInput()->with('errores',$errores);
		}
                  
                  /////////////////////////////////////////////////////////////////////
		 //Son 3UP por grupo atendido
                  $documento->puntos=3;
		
		





		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/

		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();;
		$imagenConstancia->descripcion='Oficio de validación';


		$imagenCalif=new Imagen;
		$imagenCalif->img=Str::random(20).Input::file('califFile')->getClientOriginalName();;
		$imagenCalif->descripcion='Calificaciones';

		$documento->observacion='';$documento->nombre='Evaluación de prácticas escolares';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16()/*,$e->getMessage()*/);
			return Redirect::back()->withInput()->with('errores',$errores);
		}


		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			$imagenCalif->documento()->associate($documento);
			$imagenConstancia->save();
			$imagenCalif->save();
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		/*Ahora llenamos el objeto que almacenara los datos precisos del documento en este caso diplomado*/
		/*La estructura es la siguiente
			$nombreVariable->atributoDeLaTablaDiplomado=valor
		*/

		$PracticasEscolares =new PracticasEscolares;

		/*Asociamos el diplomado al registri de la tabla padre al que corresponde*/
		$PracticasEscolares->documento()->associate($documento);

		$PracticasEscolares->tiponivel=Input::get('nivel');
		$PracticasEscolares->periodoInicio=Input::get('fechaInicio');
		$PracticasEscolares->periodoFin=Input::get('fechaTermino');
		

		/*	`TaBla SQL
  			`tiponivel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  			`periodoInicio` date NOT NULL,
  			`periodoFin,
			NAMES
			nivel'=>'required|in:Medio Superior,Superior,Posgrado',
				'fechaInicio'=>'required|date',
				'fechaTermino'=>'required|date|after:'.Inp


  			*/

		/*Movemos el archivo que mando el usuario a la carpeta que contiene todas las imagenes*/
		
		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
			Input::file('califFile')->move('spdImg',$imagenCalif->img);
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$imagenCalif->delete();
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),MensajesSPD::getMSG20('Oficio Practicas Escolares'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}

		try
		{
		
			$PracticasEscolares->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			$imagenCalif->delete();
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}




		}//fin 
  
  
  		public function getSoftware(){
			//la vista blade esta en la direccion que le pasamos al make
			return View::make('profesor.docencia.RegSoftware');
			}


		public function postSoftware(){

			$rules= array(

			'categoria'=>'required|min:2',
			'fecha'=>'required|date|before:'.date('d-m-Y'),
			'complejo'=>'required|min:4',
			'semestre'=>'required|in:1,2',
                         //'año'=>'required|integer',
			'utilidad'=>'required|in:Alumnos,Profesores',
                        'calidad'=>'required|in:1,2,3',
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',


			);

		$messages=array(
			'fecha.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
			'categoria.min'=>MensajesSPD::getMSG19('Categoria',2),
			'complejo.min'=>MensajesSPD::getMSG19('Complejo',4),
                  //'año.integer'=>MensajesSPD::getMSG18('Año'),
			'semestre.in'=>MensajesSPD::getMSG21('Semestre'),
			'calidad.in'=>MensajesSPD::getMSG21('Calidad'),
			'utilidad.in'=>MensajesSPD::getMSG21('Utilidad'),
			'constanciaFile.image'=> MensajesSPD::getMSG7_1('Archivo Imagen'),
			'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
			'constanciaFile.max'=> MensajesSPD::getMSG6('Archivo Imagen'),
			);


		//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
					//$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
					los datos que había llenado el usuario
					
					Para mandar los errores se logra con ->withErrors($validacion)
					Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
					*/
			          
		$validacion=Validator::make(Input::all(),$rules,$messages);



		if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					
					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}


				/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}

		///////////////////////////////////////////////////////////////////////
					/*Validacion para que la seccion sea posterior a la ultima promocion*/
					
					$rules=array(
						'fecha' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);
					
					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}



					/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	
					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fecha')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	

					$rules=array(
						'fecha' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}


					//guardar informacion, se crea objeto documento
					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Docencia')->first();
					$documento->idCategoria=$categoria->id;


					//asignamos los puntos conforme la calidad que se obtuvo


					if(Input::get('calidad')==1)
						$documento->puntos=15;

					if(Input::get('calidad')==2)
						$documento->puntos=30;

					if(Input::get('calidad')==3)
						$documento->puntos=55;


					/////////Terminan los puntos de calidad

					/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
					objetos con los datos que proporciono el usuario
					
					*/
					$documento->aprobado=false;
					$documento->cotejado=false;	
					//Se asignan las imagenes a los objetos que las guardaran

					$imagenConstancia=new Imagen;
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';

					$documento->observacion='';$documento->nombre='Elaboración de Software';

					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}
					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}


					$software= new Software;
					$software->documento()->associate($documento);
					$software->categoria=Input::get('categoria');
					$software->fechaElaboracion=Input::get('fecha');
					$software->semestre=Input::get('semestre');
                  //$software->año=Input::get('año'); se quito el año por que ya tiene fecha de elaboración
					$software->complejo=Input::get('complejo');
					$software->utilidad=Input::get('utilidad');
					$software->calidad=Input::get('calidad');



					/*
					Names:
			'categoria'
			'fecha'=>'
			'complejo'
			'semestre'
			
			'utilidad
			'calidad'
			'constanciaFile'

			atributos de BD
			categoria
			fechaElaboracion
			complejo
			semestre
			
			utilidad
			calidad


					*/

			try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}


					try
					{
						$software->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}		


	}	//Fin de la clase 
  
  			public function getHardware(){
				//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrarDiplomado.blade.php
				//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
				return View::make('profesor.docencia.RegHardware');
			}



			public function postHardware(){



				$rules= array(
					
					'titulo'=>'required|min:4',
					'noAutores'=>'required|integer',
					'fecha'=>'required|date|before:'.date('d-m-Y'),
					'areaAplicacion'=>'required|min:4',
					'semestre'=>'required|integer|in:1,2',
                                  	//'año'=>'required|integer',
					'utilidad'=>'required|in:Alumnos,Profesores',
					'calidad'=>'required|in:1,2,3',
					'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',

						);

				$messages=array(
					'titulo.min'=>MensajesSPD::getMSG19('titulo',4),
					'areaAplicacion.min'=>MensajesSPD::getMSG19('Area de Aplicación',4),
					'fecha.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
                                  //'año.integer'=>MensajesSPD::getMSG18('Año'),
                  			'noAutores.integer'=>MensajesSPD::getMSG18('Número de Autores'),
					'semestre.in'=>MensajesSPD::getMSG21('Semestre'),
					'calidad.in'=>MensajesSPD::getMSG21('Calidad'),
					'utilidad.in'=>MensajesSPD::getMSG21('Utilidad'),
                                  //'noAutores.integer'=>MensajesSPD::getMSG18('Número de Autores'),
					'constanciaFile.image'=> MensajesSPD::getMSG7_1('Archivo Imagen'),
					'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
					'constanciaFile.max'=> MensajesSPD::getMSG6('Archivo Imagen'),
					);


					$validacion=Validator::make(Input::all(),$rules,$messages);



					if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					
					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}


				/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}


					///////////////////////////////////////////////////////////////////////
					/*Validacion para que la seccion sea posterior a la ultima promocion*/
					
					$rules=array(
						'fecha' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);
					
					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}

					/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	
					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fecha')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	

					$rules=array(
						'fecha' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					//guardar informacion, se crea objeto documento
					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Docencia')->first();
					$documento->idCategoria=$categoria->id;

                          		
                          
                          
					//asignamos los puntos conforme la calidad que se obtuvo


					if(Input::get('calidad')==1)
						$documento->puntos=35;

					if(Input::get('calidad')==2)
						$documento->puntos=55;

					if(Input::get('calidad')==3)
						$documento->puntos=75;


					/////////Terminan los puntos de calidad


					/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
					objetos con los datos que proporciono el usuario
					
					*/
					$documento->aprobado=false;
					$documento->cotejado=false;	
					//Se asignan las imagenes a los objetos que las guardaran

					$imagenConstancia=new Imagen;
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';

					$documento->observacion='';$documento->nombre='Elaboración de Hardware';

					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/		
                                          	
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}
					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}


					$hardware=new Hardware;

					$hardware->titulo=Input::get('titulo');
					$hardware->noAutores=Input::get('noAutores');
					$hardware->fecha=Input::get('fecha');
					$hardware->areaAplicacion=Input::get('areaAplicacion');
					$hardware->semestre=Input::get('semestre');
                          		//$hardware->año=Input::get('año');  Se quito por que ya hay fecha de elaboracion
					$hardware->utilidad=Input::get('utilidad');
					$hardware->calidad=Input::get('calidad');

					/*
					NAMES:			ATRIBUTOS BD
					'titulo'		titulo
					'noAutores'		noAutores
					'fecha'			fecha
					'areaAplicacion'	areaAplicacion
					'semestre'		semestre
							
					'utilidad'		utilidad
					'calidad'		calidad
		
					
					*/

					try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}

				
					try
					{
						$hardware->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}		

			}//fin clase hardaware
  				

  
  			public function getMatAcademico(){
				//la vista blade esta en la direccion que le pasamos al make
				return View::make('profesor.docencia.RegMatDidactico');
				}


				public function postMatAcademico(){

					

					$rules=array(

						'nombre'=>'required|min:4',
						'noAutores'=>'required|integer',
						'semestre'=>'required|integer|in:1,2',
						'fecha'=>'required|date|before:'.date('d-m-Y'),
						'tipo'=>'required|in:1,2,3,4,5,6',
						'porcentaje'=>'required|integer',
						'noConstancia' => 'required|unique:imagenes,numero',
						'fechaConstancia' => 'required|date|before:'.date('d-m-Y'),
						'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',

						);

					$messages=array(
						'nombre.min'=>MensajesSPD::getMSG19('nombre',4),
						'semestre.in'=>MensajesSPD::getMSG21('Semestre'),
						'tipo.in'=>MensajesSPD::getMSG21('Tipología'),
						'fecha.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
						'noAutores.integer'=>MensajesSPD::getMSG18('Número de Autores'),
						'constanciaFile.image'=> MensajesSPD::getMSG7_1('Archivo Imagen'),
						'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
						'constanciaFile.max'=> MensajesSPD::getMSG6('Archivo Imagen'),
						'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
						'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
						'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
						);



					$validacion=Validator::make(Input::all(),$rules,$messages);


					if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					
					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}

					///////////////////////////////////////////////////////////////////////
					/*Validacion para que la seccion sea posterior a la ultima promocion*/
					
                                  
                                  
                                  
					$rules=array(
						'fechaConstancia' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);
					
					
					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}

					/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	
                                  /////positivos
                                  	if ((Input::get('porcentaje'))<0){
                                               	$errores=array(MensajesSPD::getMSG25('Porcentaje'));
						return Redirect::back()->withInput()->with('errores',$errores);
                                 	 }
                                            
                                            ////temrina valudacion de porcentaje positivo     
					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	

					$rules=array(
						'fechaConstancia' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}


					//guardar informacion, se crea objeto documento

					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Docencia')->first();
					$documento->idCategoria=$categoria->id;
						
                                  
                                  
                                  //validando los puntos
                                  	$fechaelaboracion=strtotime(Input::get('fecha'));
					$fechaConstancia=strtotime(Input::get('fechaConstancia'));

					if($fechaConstancia<$fechaelaboracion){
						$errores=array(MensajesSPD::getMSG15_1(Input::get('fechaConstancia'),Input::get('fecha')));
					  	return Redirect::back()->withInput()->with('errores',$errores);
					}
                                  
                                  //validando terminando
					//vamos ap oner los puntos conforme a la tipologia
					if(Input::get('tipo')==1)
						$documento->puntos=5;

					else if(Input::get('tipo')==2)
						$documento->puntos=8;

					else if(Input::get('tipo')==3)
						$documento->puntos=10;

					else if(Input::get('tipo')==4)
						$documento->puntos=15;

					else if(Input::get('tipo')==5)
						$documento->puntos=18;

					else if(Input::get('tipo')==6)
						$documento->puntos=20;



					//terminan los puntos


					/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
					objetos con los datos que proporciono el usuario
					
					*/
					$documento->aprobado=false;
					$documento->cotejado=false;

					$imagenConstancia=new Imagen;
					$imagenConstancia->numero=Input::get('noConstancia');
					$imagenConstancia->fecha=Input::get('fechaConstancia');
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';

					$documento->observacion='';$documento->nombre='Elaboración de Material Didactico';

					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					$matDidactico= new MatAcademico;
					$matDidactico->documento()->associate($documento);
					/*
					BD  			Names
					nombre 			nombre
					noAutores		noAutores
					semestre 		semestre
					fecha 			fecha
					tipo 			tipo
					porcentaje      porcentaje
					*/

					$matDidactico->nombre=Input::get('nombre');
					$matDidactico->noAutores=Input::get('noAutores');
					$matDidactico->semestre=Input::get('semestre');
					$matDidactico->fecha=Input::get('fecha');
					$matDidactico->tipo=Input::get('tipo');
					$matDidactico->porcentaje=Input::get('porcentaje');


					try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}



					try
					{
						$matDidactico->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16());
						return Redirect::back()->withInput()->with('errores',$errores);
					}





				}//fin de clase
  
  
  public function getCarteles(){
				//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrarDiplomado.blade.php
				//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
				return View::make('profesor.ActComplementarias.RegCarteles');
			}


public function postCarteles(){



				$rules=array(
					'fecha'=>'required|date|before:'.date('d-m-Y'),
					'nombre'=>'required|min:4',
					'tipo'=>'required|in:1,2,3,4,5,6,7,8',
					'constanciaFile'=>'required|image|mimes:jpeg|max:716800',
					);

				$messages=array(
					'nombre.min'=>MensajesSPD::getMSG19('Nombre del evento',4),
					'fecha.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
					'fecha.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
					'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
					'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
					'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
					'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),	
					'tipo.in'=>MensajesSPD::getMSG21('Tipo de Evento'),
					);

					 $validacion=Validator::make(Input::all(),$rules,$messages);
		  			
		  			if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}


					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}
					/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}

					$rules=array(
						'fecha' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('La constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);

					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}

					/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	
					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fecha')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	

					$rules=array(
						'fecha' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);

					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}


					/*Asignacion de puntos */
					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Actividades Complementarias')->first();
					$documento->idCategoria=$categoria->id;

					/////FALTA UNA VALIDACION DE MAXIMO DE 24 PUNTOS POR UNIDAD 



					////////////////////////////////////////////////////////////////////



					//////////////ASIGNACION DE PUNTOS CONFORME AL TIPO

					if(Input::get('tipo')==1)
						$documento->puntos=3;

					if(Input::get('tipo')==2)
						$documento->puntos=6;

					if(Input::get('tipo')==3)
						$documento->puntos=6;

					if(Input::get('tipo')==4)
						$documento->puntos=8;

					if(Input::get('tipo')==5)
						$documento->puntos=4;

					if(Input::get('tipo')==6)
						$documento->puntos=7;

					if(Input::get('tipo')==7)
						$documento->puntos=3;

					if(Input::get('tipo')==8)
						$documento->puntos=6;



					////////////////////////////////////////////////////////////////////


					$documento->aprobado=false;
					$documento->cotejado=false;	

					$imagenConstancia=new Imagen;
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';



					$documento->observacion='';$documento->nombre='Conferencias, Videoconferencias y carteles';

					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					$carteles= new Carteles;

					$carteles->documento()->associate($documento);

					$carteles->fecha=Input::get('fecha');
					$carteles->nombre=Input::get('nombre');
					$carteles->tipo=Input::get('tipo');


					/*

					DB   	Names
					fecha fecha
					nombre  nombre
					tipo  	tipo

					*/


						try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}


					try
					{
						$carteles->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16());
						return Redirect::back()->withInput()->with('errores',$errores);
					}





}///fin RegCarteles

  
  
  	public function getCertamen()
	{
		//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrarDiplomado.blade.php
		//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
		return View::make('profesor.ActComplementarias.RegCertamenes');


	}





public  function postCertamen(){
	$rules=array(
		'fechaevento'=> 'required|date|before:'.date('d-m-Y'),
		'fechaDes'=> 'required|date|before:'.date('d-m-Y'),
		'numeroDes'=> 'required|min:5',
		'fechaPar'=> 'required|date|before:'.date('d-m-Y'),
		'numeroPar'=> 'required|min:5',
		'area'=> 'required|min:4',
		'tipo'=> 'required|min:4',
		'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',
		);
		

	$messages=array(

		    'fechaevento.before'=>MensajesSPD::getMSG15('Fecha de Evento','fecha actual'),
		    'fechaDes.before'=>MensajesSPD::getMSG15('Fecha de designación','fecha actual'),
		    'fechaPar.before'=>MensajesSPD::getMSG15('Fecha de Participación','fecha actual'),
		    'numeroDes'=>MensajesSPD::getMSG19('Número designación',5),
		    'numeroPar'=>MensajesSPD::getMSG19('Número Participación',5),
		    'area'=>MensajesSPD::getMSG19('Área',4),
		    'tipo'=>MensajesSPD::getMSG19('Tipo',4),
		    'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
			'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
			'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
			'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),	
		);


		 $validacion=Validator::make(Input::all(),$rules,$messages);
		  if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					
					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}
					/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}

					$rules=array(
						'fechaPar' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}


					/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	

					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaPar')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	


					$rules=array(
						'fechaPar' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}


					/*Asignacion de puntos */
					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Actividades Complementarias')->first();
					$documento->idCategoria=$categoria->id;




					/////////////////////////////////////////////////////////////////
                        $noCursos=0;
                        $docs=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->get();
                        //return $docs->toArray();
                        foreach($docs as $doc)
                        {
                                $c=Certamenes::find($doc->id);
                                
                                if(!empty($c))
                                {				
                                        $noCursos=$noCursos+1;
                                }
                        }
                        
                        /*Validamos que los cursos que ha registrado sea menor que 2, si son 2 los que ha registrado, ha llegado al limite*/
                        if($noCursos == 3)
                        {
                                $errores=array(MensajesSPD::getMSG24('Certámenes',3));
								return Redirect::to('profesor/registrar')->withInput()->with('errores',$errores);
						}
         
                  
                  /////////////////////////////////////////////////////////////////////	


						//Asignacion de puntos 
						$documento->puntos=5;


						$documento->aprobado=false;
					$documento->cotejado=false;	

					$imagenConstancia=new Imagen;
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';


					$documento->observacion='';$documento->nombre='Evaluación de certámenes académicos';

					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}


					$certamenes= new Certamenes;

					$certamenes->documento()->associate($documento);
					$certamenes->fechaevento=Input::get('fechaevento');
					$certamenes->fechaDes=Input::get('fechaDes');
					$certamenes->numeroDes=Input::get('numeroDes');
					$certamenes->fechaPar=Input::get('fechaPar');
					$certamenes->numeroPar=Input::get('numeroPar');
					$certamenes->area=Input::get('area');
					$certamenes->tipo=Input::get('tipo');

/*

		'fechaevento'
		'fechaDes'
		'numeroDes'
		'fechaPar'=> 
		'numeroPar'
		'area'
		'tipo'
	

*/



			try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}


					try
					{
						$certamenes->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16());
						return Redirect::back()->withInput()->with('errores',$errores);
					}




}//fin certamnes

	
  
  			
			public function getProfesiografica()
	{
		//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrarDiplomado.blade.php
		//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
		return View::make('profesor.ActExtension.RegProfesiografica');


	}


public function postProfesiografica(){

	$rules =array(


		'evento'=> 'required|min:5',
		'tipo'=>'required|in:1,2,3',
		'fecha'=>'required|date|before:'.date('d-m-Y'),
		'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',

		);


	$messages=array(
		'evento.min'=>MensajesSPD::getMSG19('Evento',4),
		'tipo.in'=>MensajesSPD::getMSG21('Tipo de Actividad'),
		'fecha.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
		'constanciaFile.image'=> MensajesSPD::getMSG7_1('Archivo Imagen'),
		'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de Participación'),
		'constanciaFile.max'=> MensajesSPD::getMSG6('Archivo Imagen'),
		'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de Participación'),
		);


		$validacion=Validator::make(Input::all(),$rules,$messages);


					if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					
					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}

					$rules=array(
						'fecha' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);
					
					
					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}

					/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	
                     
					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fecha')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	

					$rules=array(
						'fecha' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}


					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Actividades Extension')->first();
					$documento->idCategoria=$categoria->id;
						

					///////validacion de puntos

					if(Input::get('tipo')==1)
						$documento->puntos=2;

					else if(Input::get('tipo')==2)
						$documento->puntos=3;

					else if(Input::get('tipo')==3)
						$documento->puntos=3;




					///Termina validacion de puntos


					/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
					objetos con los datos que proporciono el usuario
					
					*/
					$documento->aprobado=false;
					$documento->cotejado=false;

					$imagenConstancia=new Imagen;
					
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';

					$documento->observacion='';$documento->nombre='Expo-Profesiografica';


					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					$profesiografica= new Profesiografica;


					$profesiografica->documento()->associate($documento);

					$profesiografica->evento=Input::get('evento');
					$profesiografica->tipo=Input::get('tipo');
					$profesiografica->fecha=Input::get('fecha');


					try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}


					try
					{
						$profesiografica->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16());
						return Redirect::back()->withInput()->with('errores',$errores);
					}






		}//Fin profesiografica
  
  		
	public function getInterpolitecnico()
	{
		//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrarDiplomado.blade.php
		//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
		return View::make('profesor.ActExtension.RegInterpolitecnicos');


	}




	public function postInterpolitecnico()
	{


			$rules =array(

				'nombre'=> 'required|min:5',
				'fecha'=>'required|date|before:'.date('d-m-Y'),
				'noConstancia' => 'required|unique:imagenes,numero',
				'fechaConstancia' => 'required|date|before:'.date('d-m-Y').'|after:'.Input::get('fecha'),
				'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',

				);

			$messages=array(
				'nombre.min'=>MensajesSPD::getMSG19('Nombre',5),
				'fecha.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
				'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
				'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
				'fechaConstancia.after'=>MensajesSPD::getMSG15_1('Fecha de la constancia','Fecha evento'),
				'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
				'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
				'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
				'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),

				);






		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Validacion del formulario.*/
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		
		
		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion='10-08-1980';//334713600->10-08-1980			
		}




		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaConstancia' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}

			/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		

		$rules=array(
						'fecha' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}


		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;

		$categoria=Categoria::where('nombre','=','Actividades Extension')->first();
		$documento->idCategoria=$categoria->id;




		 /////////////////////////////////////////////////////////////////
                        $noCursos=0;
                        $docs=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=','0')->first()->documentos()->get();
                        //return $docs->toArray();
                        foreach($docs as $doc)
                        {
                                $c=Interpolitecnicos::find($doc->id);
                                
                                if(!empty($c))
                                {				
                                        $noCursos=$noCursos+1;
                                }
                        }
                        
                        /*Validamos que los cursos que ha registrado sea menor que 3, si son 4 los que ha registrado, ha llegado al limite*/
                        if($noCursos == 4)
                        {
                                $errores=array(MensajesSPD::getMSG24('Programas de Servicio Social',4));
			return Redirect::to('profesor/registrar')->withInput()->with('errores',$errores);
		}

		$documento->puntos=2;



		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->numero=Input::get('noConstancia');
		$imagenConstancia->fecha=Input::get('fechaConstancia');
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();;
		$imagenConstancia->descripcion='Constancia de validación';



		$documento->observacion='';$documento->nombre='Encuentros Academicos Interpolitecnicos';


					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}
		try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}
				
		$interpolitecnico=new Interpolitecnicos;
		$interpolitecnico->documento()->associate($documento);
		
		$interpolitecnico->nombre=Input::get('nombre');
		$interpolitecnico->fechaEvento=Input::get('fecha');

		
		try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}


					try
					{
						$interpolitecnico->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16());
						return Redirect::back()->withInput()->with('errores',$errores);
					}




	}//fin interpolitecnico
  
  
  
  				public function getBrigadas()
			{
				//Mostrara la vista que se ubique en Views/profesor/superacionAcademic.blade.php
				//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
				return View::make('profesor.ActExtension.RegBrigadas');
			}


			public function postBrigadas()
			{


				$rules=array(

					'nombre'=> 'required|min:5',
					'noRegistro'=> 'required|min:5',
					'fechaInicio' => 'required|date',			
					'fechaTermino' => 'required|date|after:'.Input::get('fechaInicio'),
					'tipo'=>'required|in:1,2,3',
					'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',

					);


				$messages=array(


					'nombre.min'=>MensajesSPD::getMSG19('Nombre Brigada',5),
					'noRegistro.min'=>MensajesSPD::getMSG19('Número del Registro',5),
					'tipo.in'=>MensajesSPD::getMSG21('Tipo'),
					'fechaInicio.date'=>MensajesSPD::getMSG4('Fecha de inicio','(Dia-Mes-Año)'),	
					'fechaTermino.date'=>MensajesSPD::getMSG4('Fecha de termino','(Dia-Mes-Año)'),
					'fechaTermino.after'=>MensajesSPD::getMSG15_1('Fecha de termino','Fecha de inicio'),
					'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
					'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
					'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
					'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),
					);




				//Ejecutamos la validación de las entradas(Input::all()) con las reglas($rules) y tomando en cuenta los mensajes($messages)
		$validacion=Validator::make(Input::all(),$rules,$messages);
		/*Si la validacion tuvo algun error regresaremos a la vista y mandaremos los errores que se generaron y 
		los datos que había llenado el usuario
		
		Para mandar los errores se logra con ->withErrors($validacion)
		Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
		*/
		if($validacion->fails())
		{					
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		//Validamos que el formato de la imagen de la constancia es el correcto
		if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
		{
			$errores=array(MensajesSPD::getMSG7('constancia de validación'));
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		
		

		/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
		sea posterior a su ultima promoción*/
		$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
		if(empty($ultimaPromocion))
		{
			//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
			$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
		}


		///////////////////////////////////////////////////////////////////////
		/*Validacion para que la seccion sea posterior a la ultima promocion*/
		
		$rules=array(
			'fechaInicio' => 'after:'.$ultimaPromocion
		);
		$messages = array(
				'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
			);
		$validacion=Validator::make(Input::all(),$rules,$messages);
		
		
		/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
		if($validacion->fails())
		{			
			return Redirect::back()->withErrors($validacion)->withInput();
		}
		
		


		/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
		el documento y la fecha actual sea maxima de 4 años o 2 años.
		
		Para ello hay dos casos:
		Se permitira que la antiguedad del documento sea maxima de 4 años 
		si la ultima promocion del profesor fue hace 4 años.
		
		Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
		*/	
		$ultimaPromocion=strtotime((string)$ultimaPromocion);
		if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaInicio')))!=0)
		{
			if($antiguedad==2)
				$errores=array(MensajesSPD::getMSG5());
			else if($antiguedad==4)
				$errores=array(MensajesSPD::getMSG5_1());
			else if($antiguedad==3)
				$errores=array(MensajesSPD::getMSG5_3());
			else
				$errores=array(MensajesSPD::getMSG5());			
			return Redirect::back()->withInput()->with('errores',$errores);
		}		
		



		/*Se procede a guardar la información en la base de datos*/
		
		$documento=new Documento;
		
		//Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
		//La caracteristica de estas solicitudes es que su estatus es Cero.
		//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
		$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
		
		$solicitud=$solicitud->first();
		$documento->idSolicitud=$solicitud->id;
		//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
		//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
		$categoria=Categoria::where('nombre','=','Actividades Extension')->first();
		$documento->idCategoria=$categoria->id;
	

		if (Input::get('tipo')==1)
			$documento->puntos=8; //minimo 4 maximo 8
		if (Input::get('tipo')==2) {
			# code...
			$documento->puntos=4; //min 4 macx 4
		}

		if (Input::get('tipo')==3) {
			# code...
			$documento->puntos=6;   //min 3 max 6
		}



		/*Comenzamos a llenar el objeto documento que hace referencia a la tabla padre de todos los documentos
		objetos con los datos que proporciono el usuario
		
		*/
		
		
		$documento->aprobado=false;
		$documento->cotejado=false;			
		
		//Se asignan las imagenes a los objetos que las guardaran
		$imagenConstancia=new Imagen;
		$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();;
		$imagenConstancia->descripcion='Constancia de validación';
		$imagenConstancia->noRegistro=Input::get('noRegistro');


			$documento->observacion='';$documento->nombre='Brigadas multidiciplinarias del servicio social';
		try
		{
			$documento->save();
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			$errores=array(MensajesSPD::getMSG16()/*,$e->getMessage()*/);
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		try
		{
			//Se asocian las imagenes al documento.
			$imagenConstancia->documento()->associate($documento);
			
			$imagenConstancia->save();
			
		}catch(Exception $e)
		{
			$errores=array(MensajesSPD::getMSG16());
			$documento->delete();
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		$brigadas=new Brigadas;
		$brigadas->documento()->associate($documento);


		$brigadas->nombre=Input::get('nombre');
		$brigadas->fechaInicio=Input::get('fechaInicio');
		$brigadas->fechaTermino=Input::get('fechaTermino');
		$brigadas->tipo=Input::get('tipo');



		try
		{
			Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
			
		}
		catch(Exception $e)
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
			
			$errores=array(MensajesSPD::getMSG20('constancia de validación'),);
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		

			try
		{
		
			$brigadas->save();
			
			/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
			la vista los pueda mostrar
			Si no hay mensajes que mostrar el array se deja vacio
			$mensajes=array();
			*/
			
			//Mensaje MSG1: Operación Exitosa
			$mensajes=array(MensajesSPD::getMSG1());	
			//Se envian los mensajes a la vista profesor/registrar
			return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
		}
		catch(Exception $e)//Ocurrio un error
		{
			/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
			*/			
			//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
			//el usuario intente registrar el documento mas tarde.
			$documento->delete();
			$imagenConstancia->delete();
		
			$errores=array(MensajesSPD::getMSG16());
			return Redirect::back()->withInput()->with('errores',$errores);
		}
		
		

}//fin brigadas
  
  


				
public function getDeportivas()
	{
		//Mostrara la vista que se ubique en Views/profesor/superacionAcademica/registrablade.php
		//Como se muestra a continuacion las diagonales son reemplazadas por puntos, ademas no se incluye la extensión de la vista
		return View::make('profesor.ActExtension.RegDeportivas');


	}



	public function postDeportivas(){


		$rules=array(

			'evento'=> 'required|min:5',
			'tipo'=>'required|in:1,2,3',
			'fecha'=>'required|date|before:'.date('d-m-Y'),
			'noConstancia' => 'required|unique:imagenes,numero',
			'fechaConstancia' => 'required|date|before:'.date('d-m-Y'),
			'constanciaFile'=> 'required|image|mimes:jpeg|max:716800',


			);

		$messages=array(

			'fecha.date'=>MensajesSPD::getMSG4('Fecha','(Dia-Mes-Año)'),
			'evento.min'=>MensajesSPD::getMSG19('Nombre del Evento',5),
			'tipo.in'=>MensajesSPD::getMSG21('Tipo de Evento'),
			'noConstancia.unique'=>MensajesSPD::getMSG23('El número de constancia'),
			'fechaConstancia.date'=>MensajesSPD::getMSG4('Fecha de constancia','(Dia-Mes-Año)'),
			'fechaConstancia.before'=>MensajesSPD::getMSG15('Fecha de la constancia','fecha actual'),
			'fechaConstancia.after'=>MensajesSPD::getMSG15_1('Fecha de la constancia','Fecha de termino'),
			'constanciaFile.image'=> MensajesSPD::getMSG7_1('Constancia de validación'),
			'constanciaFile.mimes'=> MensajesSPD::getMSG7('Constancia de validación'),
			'constanciaFile.max'=> MensajesSPD::getMSG6('Constancia de validación'),
			'constanciaFile.required'=> MensajesSPD::getMSG3('Constancia de validación'),

			);

			
			/*Para mandar los errores se logra con ->withErrors($validacion)
					Para mandar los datos que lleno el usuario en el formulario se logra con ->withInput()
					*/

			        $validacion=Validator::make(Input::all(),$rules,$messages);


			        if($validacion->fails())
					{					
						return Redirect::back()->withErrors($validacion)->withInput();
					}
					
					//Validamos que el formato de la imagen de la constancia es el correcto
					if(!BRules::validarFormatoImagen(Input::file('constanciaFile')))
					{
						$errores=array(MensajesSPD::getMSG7('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}
					/*Obtenemos la fecha de la ultima promoción para validar que la seccion que se pretende registrar
					sea posterior a su ultima promoción*/
					$ultimaPromocion=Auth::user()->profesor()->get()->first()->fechaUltimaPromocion;		
					if(empty($ultimaPromocion))
					{
						//Si nunca se ha promocionado en el sistema. Para efectos de validación damos una fecha arbitraria antigua.
						$ultimaPromocion=date('10-08-1980');//334713600->10-08-1980			
					}

					$rules=array(
						'fechaConstancia' => 'after:'.$ultimaPromocion
					);
					$messages = array(
							'after' => MensajesSPD::getMSG22('la constancia',$ultimaPromocion),
						);
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento sea de una fecha posterior a su ultima promoción*/		
					if($validacion->fails())
					{			
						return Redirect::back()->withErrors($validacion)->withInput();
					}
			

			/*El documento es de una fecha posterior a la ultima promoción, ahora verificar que la diferencia entre la fecha de
					el documento y la fecha actual sea maxima de 4 años o 2 años.
					
					Para ello hay dos casos:
					Se permitira que la antiguedad del documento sea maxima de 4 años 
					si la ultima promocion del profesor fue hace 4 años.
					
					Se permitira que la antiguedad del documento sea maxima de 2 años si la ultima promoción del profesor fue hace 2 años.
					*/	
					$ultimaPromocion=strtotime((string)$ultimaPromocion);
					if(($antiguedad=BRules::BRAntiguedadDocumentos($ultimaPromocion,Input::get('fechaConstancia')))!=0)
					{
						if($antiguedad==2)
							$errores=array(MensajesSPD::getMSG5());
						else if($antiguedad==4)
							$errores=array(MensajesSPD::getMSG5_1());
						else if($antiguedad==3)
							$errores=array(MensajesSPD::getMSG5_3());
						else
							$errores=array(MensajesSPD::getMSG5());			
						return Redirect::back()->withInput()->with('errores',$errores);
					}	

					$rules=array(
						'fechaConstancia' => 'after:'.date('d-m-Y',strtotime('-4 year'))
					);
					$messages = array(
						'after' => MensajesSPD::getMSG5_1(),
					);
					
					$validacion=Validator::make(Input::all(),$rules,$messages);
					/*Validamos que el documento no tenga antiguedad mayor a 4 años*/
					if($validacion->fails())
					{			
						
						return Redirect::back()->withErrors($validacion)->withInput();
					}

					//guardar informacion, se crea objeto documento
					$documento= new Documento;
			          //Obtenemos las solicitudes activas en periodo de registro que no han sido enviadas (SOLO SE DEBE OBTENER UNA)
					//La caracteristica de estas solicitudes es que su estatus es Cero.
					//Se necesita obtener la solicitud activa para ligar el documento a esa solicitud
					$solicitud=Profesor::find(Auth::user()->id)->solicitudes()->where('estatus','=',0)->get();
					$solicitud=$solicitud->first();
					$documento->idSolicitud=$solicitud->id;
					//*Se obtiene la categoria del documento, por medio del nombre de la categoria. 
					//Se necesita obtener la categoria para ligar el documento a la categoria correspondiente
					$categoria=Categoria::where('nombre','=','Actividades Extension')->first();
					$documento->idCategoria=$categoria->id;


		///////VALIACION DE PUNTOS MAXIMOS 10 //////


		/////////////////////////////////////////////

					//Asignacion de puntos 

					if(Input::get('tipo')==1){
						$documento->puntos=3;

					}
					if(Input::get('tipo')==2){

						$documento->puntos=5;

					}
					if(Input::get('tipo')==3){
						$documento->puntos=7;

						
					}

					/*//terina asignacion dep untos
					*/
					$documento->aprobado=false;
					$documento->cotejado=false;	

					$imagenConstancia=new Imagen;
					$imagenConstancia->numero=Input::get('noConstancia');
					$imagenConstancia->fecha=Input::get('fechaConstancia');
					$imagenConstancia->img=Str::random(20).Input::file('constanciaFile')->getClientOriginalName();
					$imagenConstancia->descripcion='Constancia de Validación';

					$documento->observacion='';$documento->nombre='Impartición de actividades deportivas y/o talleres culturales';

		

					try
					{
						$documento->save();
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						$errores=array(MensajesSPD::getMSG16(),$e->getMessage());
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						//Se asocian las imagenes al documento.
						$imagenConstancia->documento()->associate($documento);
						$imagenConstancia->save();
						
					}catch(Exception $e)
					{
						$errores=array(MensajesSPD::getMSG16());
						$documento->delete();
						return Redirect::back()->withInput()->with('errores',$errores);
					}







		

		$deportivas=new Deportivas;
		$deportivas->documento()->associate($documento);


		$deportivas->evento=Input::get('evento');
		$deportivas->tipo=Input::get('tipo');
		$deportivas->fecha=Input::get('fecha');

		/*

		'evento'
			'tipo'
			'fecha'
			'noConstancia'
			'fechaConstancia'
			'constanciaFile'


		*/


			try
					{
						Input::file('constanciaFile')->move('spdImg',$imagenConstancia->img);
						
					}
					catch(Exception $e)
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG20('constancia de validación'));
						return Redirect::back()->withInput()->with('errores',$errores);
					}

					try
					{
						$deportivas->save();
						/*Si todo salio bien se crea el array $mensajes y ahi se ponen los mensajes de confirmación para que 
						la vista los pueda mostrar
						Si no hay mensajes que mostrar el array se deja vacio
						$mensajes=array();
						*/
						
						//Mensaje MSG1: Operación Exitosa
						$mensajes=array(MensajesSPD::getMSG1());	
						//Se envian los mensajes a la vista profesor/registrar
						return Redirect::to('profesor/registrar')->with('messages',$mensajes);		
					}
					catch(Exception $e)//Ocurrio un error
					{
						/*Si algo salio mal en el array $errores se ponen los mensajes de error que se van a mostrar			
						*/			
						//Se eliminan los registros que ya se habian registrado, para evitar errores cuando
						//el usuario intente registrar el documento mas tarde.
						$documento->delete();
						$imagenConstancia->delete();
						$errores=array(MensajesSPD::getMSG16());
						return Redirect::back()->withInput()->with('errores',$errores);
					}



	}//fin de portivas 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*********************************************************************************************************/
	/*********************************************************************************************************/
	/*********************************************************************************************************/
	/*********************************************************************************************************/
	/*********************************************************************************************************/
	/*********************************************************************************************************/
	/*********************************************************************************************************/
	
	
	
	
	
	
	
	
	
}

?>