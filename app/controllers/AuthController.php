<?php

	class AuthController extends BaseController
	{
		
		
		
		public function getIndex()
		{
			return View::make('login');
		}
		
		public function getRegistro()
		{
			$instituciones=Institucion::all();
			return View::make('registro')->with('instituciones',$instituciones);
		}
		
		public function postRegistro()
		{
			$rules=array(
			'noEmpleado'=> 'required|unique:usuario,id|regex:([0-9]{6})',
			'email'=>'required|unique:usuario|email',
			'password'=>'required|min:4',
			'nombre'=>'required|min:3',
			'apellidoP'=>'required|min:3',
			'apellidoM'=>'required|min:3',
			'calle'=>'required|min:3',
			'colonia'=>'required|min:3',
			'numero'=>'required|integer',
			'entidad'=>'required|min:3',
			'ciudad'=>'required|min:3',
			'codigoPostal'=>'required|regex:([0-9]{5})'
			);
			$mensajes=array(
			'noEmpleado.unique'=>MensajesSPD::getMSG29(),
			'noEmpleado.required'=>MensajesSPD::getMSG3('Número de empleado'),
			'email.unique'=>MensajesSPD::getMSG30(),
			'password.min'=>MensajesSPD::getMSG19('Password',4),
			'nombre.min'=>MensajesSPD::getMSG19('Nombre',3),
			'apellidoM.min'=>MensajesSPD::getMSG19('Apellido Materno',3),
			'apellidoP.min'=>MensajesSPD::getMSG19('Apellido Paterno',3),
			'calle.min'=>MensajesSPD::getMSG19('Calle',3),
			'colonia.min'=>MensajesSPD::getMSG19('Colonia',3),
			'ciudad.min'=>MensajesSPD::getMSG19('Ciudad',3),
			'entidad.min'=>MensajesSPD::getMSG19('Entidad Federativa',3),
			'numero.integer'=>MensajesSPD::getMSG18('Número'),
			
			
			);
			$validacion=Validator::make(Input::all(),$rules,$mensajes);			
			if($validacion->fails())
			{
				/*$errores=$validacion->messages();
				foreach($errores->all() as $error)
				{
					$cadena=$cadena.'El error: '.$error;
				}
				return $cadena.Input::get('nombre').Input::get('password');*/
				return Redirect::back()->withErrors($validacion)->withInput();
			}
			if(strlen(Input::get('noEmpleado'))!=6)
			{
				$errores=array(MensajesSPD::getMSG31());
				return Redirect::back()->withInput()->with('errores',$errores);
				
			}
			$user=new User;
			$direccion=new Direccion;
			$institucion=Institucion::where('nombre','=',Input::get('institucion'))->get();
			
			$direccion->calle=Input::get('calle');
			$direccion->colonia=Input::get('colonia');
			$direccion->numero=Input::get('numero');
			$direccion->entidadFederativa=Input::get('entidad');
			$direccion->ciudad=Input::get('ciudad');
			$direccion->codigoPostal=Input::get('codigoPostal');
			$direccion->save();
			
			
			$user->id=Input::get('noEmpleado');
			$user->nombre=Input::get('nombre');
			$user->apellidoP=Input::get('apellidoP');
			$user->apellidoM=Input::get('apellidoM');			
			$user->email=Input::get('email');
			$user->password=Input::get('password');
			$user->rol=0;//Rol para profesor
			
			$user->direccion()->associate($direccion);
			$user->idInstitucion=$institucion->first()->id;			
			
			$user->save();
			
			
			$profesor=new Profesor;
			
			$profesor->id=Input::get('noEmpleado');
			$profesor->categoria=1;
			
			$profesor->save();
			$usuario=array(
			'email'=>Input::get('email'),
			'password'=>Input::get('password'),
			'apellidoP'=>Input::get('apellidoP'),
			'apellidoM'=>Input::get('apellidoM'),
			'nombre'=>Input::get('nombre'),
			'id'=>Input::get('noEmpleado')
			);			
			Mail::queue('emailTemplate',Input::all(),function($message) use($user)
			{
				$message->to($user->email,$user->nombre.' '.$user->nombre.$user->apellidoP.' '.$user->apellidoM )->subject('Bienvenido al Sistema de Promocion Docente del IPN');
			}
			);
			return Redirect::to('login');
			
		}
		
		
		/*
		**	Se trata la peticion POST de /login
		*/
		public function postIndex()
		{
			 //Obtener los datos del formularo login
			$credentials= array(
			'id'=>Input::get('noEmpleado'),
			'password'=>Input::get('password'),
			);
			if(Auth::attempt($credentials))
			{
				//El usuario se ha identificado correctamente.
				
				//Redirigir a su pagina inicial cuando el rol es 0, es decir el usuario es un profesor
				if(Auth::user()->rol==0)
				{
					return Redirect::to('profesor');
				}
				//Redirigir a su pagina inicial cuando el rol es 0, es decir el usuario es un cotejador
				else if(Auth::user()->rol==1)
				{
					return Redirect::to('compulsa');
				}
				
			}
			
			
			else
			{
				//El usuario ha fallado la identifiación
				$errores=array(MensajesSPD::getMSG27());
				return Redirect::back()->withInput()->with('errores',$errores);
			}
			return View::make('login');
		}
		
		
		
	}

?>