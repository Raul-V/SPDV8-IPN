<?php
	class MensajesSPD
	{
		public static function getMSG1()
		{
			return 'Operación Exitosa.';
		}
		public static function getMSG3($campo)
		{
			return 'No introdujo el campo requerido '.$campo.'.';
		}
		public static function getMSG4($campo,$formato)
		{
			return 'Formato invalido en el campo '.$campo.', el formato debe ser: '.$formato;
		}
		
		public static function getMSG5()
		{
				return 'La fecha del documento tiene mas de 2 años de antiguedad';
		}
		
		
		public static function getMSG5_1()
		{
				return 'La fecha del documento tiene 4 o mas años de antiguedad';
		}		
		
		
		
		
		
		
		public static function getMSG5_3()
		{
				return 'La fecha del documento tiene 3 o mas años de antiguedad';
		}
		public static function getMSG6($campo)
		{
			return 'La imagen que intenta subir en el campo '.$campo.' excede los 700Kb, intente con otra imagen.';
		}
		
		public static function getMSG7($campo)
		{
			return 'La imagen que intenta subir en el campo '.$campo.' no es formato jpg/jpeg.';
		}
		
		
		public static function getMSG7_1($campo)
		{
			return 'El archivo que intenta subir en el campo '.$campo.' no es una imagen.';
		}
		
		/*public static function getMSG15()
		{
			return 'La fecha de término debe ser posterior a la fecha de inicio.';
		}
		
		public static function getMSG15_1()
		{
			return 'La fecha de término debe ser anterior a la fecha de la constancia.';
		}*/
		
		public static function getMSG15($fecha1,$fecha2)
		{
			return 'La '.$fecha1.' debe ser anterior a la fecha '.$fecha2.'.';
		}
		
		public static function getMSG15_1($fecha1,$fecha2)
		{
			return 'La '.$fecha1.' debe ser posterior a la '.$fecha2.'.';
		}
		
		
		public static function getMSG16()
		{
			return 'Ocurrio un error de conexión, intentelo mas tarde.';
		}
		
		public static function getMSG17()
		{
			return '¿Seguro que deseas eliminar este documento?';
		}
		
		
		/**********************************************************************************************************/
		/**********************************************************************************************************/
		/***************************************NUEVOS MENSAJES!***************************************************/
		/**********************************************************************************************************/
		/**********************************************************************************************************/
		/**********************************************************************************************************/
		
		public static function getMSG18($campo)
		{
			return 'El campo '.$campo.' debe ser un número entero';
		}
		
		public static function getMSG19($campo,$min)		
		{
			return 'El campo '.$campo.' es muy corto. Minimo '.$min.' caracteres.';
		}
		
		
		public static function getMSG20($campo)		
		{
			return 'Ocurrio un error al guardar la imagen del campo '.$campo.'. Vuelva a intentarlo mas tarde.';
		}
		
		public static function getMSG21($campo)		
		{
			return 'Debes seleccionar un elemento valido del campo '.$campo.'.';
		}
		public static function getMSG22($campo,$fecha)
		{
			return 'La fecha de '.$campo.' debe ser posterior a la fecha de tu ultima promocion academica('.$fecha.')';
		}
		
		public static function getMSG23($campo)
		{
			return $campo.' que has ingresado ya esta registrado en el sistema.';
		}
		
		public static function getMSG24($seccion,$num)
		{
			return 'Has alcanzado el límite de '.$seccion.' que se pueden registrar en un proceso de promoción académica. Maximo '.$num.'.';
		}		
		public static function getMSG25($campo)
		{
			return 'El número del campo '.$campo.' debe ser positivo';
		}
		
		public static function getMSG26($fecha)
		{
			return 'El semestre y año deben ser posteriores a la últmia promoción académica ('.$fecha.')';
		}
		
		public static function getMSG27()
		{
			return 'Su usuario o contraseña es incorrecto, por favor intente de nuevo.';
		}
		
		public static function getMSG28($campo1)
		{
			return 'La fecha del campo '.$campo1.' debe ser posterior al semestre y año que se indica';
		}
		
		public static function getMSG29()
		{
			return 'El numero de empleado ya esta registrado';
		}
		
		public static function getMSG30()
		{
			return 'El email ya esta registrado';
		}
		
		public static function getMSG31()
		{
			return 'El número de empleado debe tener 6 digitos';			
		}
		
		public static function getMSG32($campo,$valor,$campo2,$valor2)
		{
			return 'El campo '.$campo.' debe ser diferente de '.$valor.' cuando se ha seleccionado en el campo '.$campo2.' el valor '.$valor2.'.';			
		}
		
		public static function getMSG33($seccion)
		{
			return 'Se ha eliminado correctamente la seccion '.$seccion.'.';			
		}
		
		public static function getMSG34($seccion)
		{
			return 'No se pudo encontrar la seccion que intentas visualizar.';
		}
		public static function getMSG35($campo)
		{
			return 'Si selecciona la opcion No en el campo Aprobado, debe especificar en el campo Observación la causa';
		}
		public static function getMSG36($campo)
		{
			return 'Solo se permite hasta 250 caracteres en el campo Observación';
		}
		
		
	}
	
?>