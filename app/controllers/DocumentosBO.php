<?php
class DocumentosBO
{
	public static function getSize($arreglo)
	{
		$i=0;
		foreach($arreglo as $a)
		{
			$i++;
		}
		return $i;
	}
	
	public static function getDocumento($seccion,$id)
	{
		/*
		$seccion
			1 CargaAcademica
			2 InstructorProgramas
			3 CursosProgramaRecuperacionAcademica
		*/
		if($seccion==1)
		{
			$carga=CargaAcademica::find($id);
			$imagenConstancia=Imagen::where('idDocumento','=',$id)->where('descripcion','=','Horario o Constancia')->get()->first();
			if($carga==null)
			{
				$errores=array(MensajesSPD::getMSG34('Carga académica'));
				return Redirect::to('profesor/documentos')->with('errores',$errores); 
			}
			$resultado=$carga->toArray();
			$resultado['imgConstancia']=$imagenConstancia->img;
			return $resultado;
		}
		else if($seccion==2)
		{
			$instructor=InstructorProgramas::find($id);
			$imagenConstancia=Imagen::where('idDocumento','=',$id)->where('descripcion','=','Constancia de Validación')->get()->first();
			if($instructor==null)
			{
				$errores=array(MensajesSPD::getMSG34('Instructor de programas de formación docente'));
				return Redirect::to('profesor/documentos')->with('errores',$errores); 
			}
			$resultado=$instructor->toArray();
			$resultado['noConstancia']=$imagenConstancia->numero;
			$resultado['fechaConstancia']=$imagenConstancia->fecha;
			$resultado['imgConstancia']=$imagenConstancia->img;
			return $resultado;
		}
		else if($seccion==3)
		{
			$curso=CursosProgramaRecuperacionAcademica::find($id);
			$imagenOficio=Imagen::where('idDocumento','=',$id)->where('descripcion','=','Oficio de autorización')->get()->first();
			if($curso==null)
			{
				$errores=array(MensajesSPD::getMSG34('Cursos del programa de recuperación académica'));
				return Redirect::to('profesor/documentos')->with('errores',$errores); 
			}
			$resultado=$curso->toArray();
			$resultado['numeroOficio']=$imagenOficio->numero;
			$resultado['registroOficio']=$imagenOficio->registro;
			$resultado['fechaOficio']=$imagenOficio->fecha;
			$resultado['imgOficio']=$imagenOficio->img;
			return $resultado;
		}
		
	}
	
	public static function validarCotejamiento()
	{
		$condicion='';
		if(Input::get('aprobado')=='No')
		{
			$condicion='required|max:250';
		}
		
		$rules=array(
		'observacion'=>$condicion,
		'aprobado'=>'required|in:Si,No'
		);
		
		$mensajes=array(
			'observacion.required' => MensajesSPD::getMSG35(''),
			'observacion.max'=>MensajesSPD::getMSG36(''),
		);
		$validador=Validator::make(Input::all(),$rules,$mensajes);
		return $validador;
	}
	public static function cotejarDocumento($validador)
	{
		if($validador->fails())
		{					
			return Redirect::back()->withErrors($validador)->withInput();
		}
		
		//var_dump(Input::all());
		
		$documento=Documento::find(Input::get('idDocumento'));
		if(Input::has('observacion'))
		{		
			$documento->Observacion=Input::get('observacion');
		}
		if(Input::get('aprobado')=='No')
		{
			$documento->aprobado=0;
		}
		else
		{
			$documento->aprobado=1;
		}
		$documento->cotejado=1;
		$documento->save();
		$mensajes=array(MensajesSPD::getMSG1());	
		$idProfesor=Input::get('idProfesor');
		//Se envian los mensajes a la vista compulsa/ver/profesor
		return Redirect::to('compulsa/ver/profesor/'.$idProfesor)->with('messages',$mensajes);
	}
	
	public static function getCargaAcademica($cotejador=0)
	{
		//Si el usuario esta logeado
		if(Auth::check())
		{
			$result=array();
			$docs=Documento::where('idSolicitud','=',(Solicitud::where('idProfesor','=',Auth::user()->id)
			->where('estatus','=',0)->first()->id))->where('nombre','=','Carga académica')->get();
			if($cotejador==0)
			{
				foreach($docs as $doc)
				{
					if($carga=CargaAcademica::find($doc->id))
					{
						$carga=$carga->toArray();
						$carga['puntos']=$doc->puntos;					
						array_push($result,$carga);
					}
				}
				return $result;
				//var_dump($result);
			}
			else //Si el cotejador esta solicitando los documentos, a el le interesan aquellos que
			//no han sido cotejados
			{
				foreach($docs as $doc)
				{
					if($carga=CargaAcademica::find($doc->id))
					{						
						if($doc->cotejado==0)
						{
							$carga=$carga->toArray();
							$carga['puntos']=$doc->puntos;					
							array_push($result,$carga);
						}
					}
				}
				return $result;
			}
			
		}
		
		
	}
	public static function getInstructorProgramasFormacionDocente($cotejador=0)
	{
		if(Auth::check())
		{
			$result=array();
			$docs=Documento::where('idSolicitud','=',(Solicitud::where('idProfesor','=',Auth::user()->id)			
			->where('estatus','=',0)->first()->id))->where('nombre','=','Instructor de programas de formación docente y actualización profesional')->get();
			if($cotejador==0)
			{
				foreach($docs as $doc)
				{
					if($instructor=InstructorProgramas::find($doc->id))
					{
						$instructor=$instructor->toArray();
						$instructor['puntos']=$doc->puntos;
						$imagen=Imagen::where('idDocumento','=',$doc->id)->first();
						$instructor['noConstancia']=$imagen->numero;
						array_push($result,$instructor);
					}
				}
				return $result;
				//var_dump($result);
			}
			else
			{
				foreach($docs as $doc)
				{
					if($instructor=InstructorProgramas::find($doc->id))
					{
						if($doc->cotejado==0)
						{
							$instructor=$instructor->toArray();
							$instructor['puntos']=$doc->puntos;
							$imagen=Imagen::where('idDocumento','=',$doc->id)->first();
							$instructor['noConstancia']=$imagen->numero;
							array_push($result,$instructor);
						}
					}
				}
				return $result;
				//var_dump($result);
			}
		}
	}
	
	public static function getCursosProgramaRecuperacionAcademica($cotejador=0)
	{
		if(Auth::check())
		{
			$result=array();
			$docs=Documento::where('idSolicitud','=',(Solicitud::where('idProfesor','=',Auth::user()->id)			
			->where('estatus','=',0)->first()->id))
			->where('nombre','=','Cursos del programa de recuperacion académica estudiantil')->get();
			if($cotejador==0)
			{
				foreach($docs as $doc)
				{
					if($cursos=CursosProgramaRecuperacionAcademica::find($doc->id))
					{
						$cursos=$cursos->toArray();
						$cursos['puntos']=$doc->puntos;
						$imagen=Imagen::where('idDocumento','=',$doc->id)->whereDescripcion('Oficio de autorización')->first();
						$cursos['numeroOficio']=$imagen->numero;
						array_push($result,$cursos);
					}
				}
				return $result;
				//var_dump($result);
			}
			else
			{
				foreach($docs as $doc)
				{
					if($instructor=CursosProgramaRecuperacionAcademica::find($doc->id))
					{
						if($doc->cotejado==0)
						{
							$cursos=$cursos->toArray();
							$cursos['puntos']=$doc->puntos;
							$imagen=Imagen::where('idDocumento','=',$doc->id)->whereDescripcion('Oficio de autorización')->first();
							$cursos['numeroOficio']=$imagen->numero;
							array_push($result,$cursos);
						}
					}
				}
				return $result;
				//var_dump($result);
			}
		}
	}
	
	
	
}
?>