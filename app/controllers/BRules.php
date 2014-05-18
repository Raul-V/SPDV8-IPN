<?php
	class BRules
	{
		public static function validarFormatoImagen($imagen)
		{
			
			if(!($imagen->guessExtension()=='jpg'|| $imagen->guessExtension()=='jpeg'))
			{
				return false;
			}
			return true;
			
			
			
		}
		
		
		
		public static function BRAntiguedadDocumentos($ultimaPromocion,$fechaDoc)
		{
			
			$fechaDoc=strtotime($fechaDoc);
			if(((int)strtotime('+2 year',$ultimaPromocion))>=((int)strtotime('1-01-'.date('Y'))))
			{				
				if(((int)strtotime('+2 year',$fechaDoc)<=((int)strtotime('1-01-'.date('Y')))))
				{
					return 2;
				}
			}
			else if(((int)strtotime('+4 year',$fechaDoc)>=((int)strtotime('1-01-'.date('Y')))))
			{
				if(!$fechaDoc>$ultimaPromocion)
				{
					return 4;
				}
			}
			else if(((int)strtotime('+3 year',$fechaDoc)>=((int)strtotime('1-01-'.date('Y')))))
			{
				if(!$fechaDoc>$ultimaPromocion)
				{
					return 3;
				}
			}
			else
			{
				if(((int)strtotime('+2 year',$fechaDoc)<=((int)strtotime('1-01-'.date('Y')))))
				{
					return 5;
				}
			}
			return 0;
		}
		
	}
	
?>