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
		1 Carga academica
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
	}
	
	
	
}
?>