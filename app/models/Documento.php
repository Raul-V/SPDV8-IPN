<?php

class Documento extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'documento';
	
	public function diplomados()
	{
		return $this->hasMany('Diplomado');
	}
	
	public function solicitud()
	{
		return $this->belongsTo('Solicitud','idSolicitud');
	}
	
	
	public function categoria()
	{
		return $this->belongsTo('Categoria','idCategoria');
	}
	
	
	public function licenciaturas()
	{
		return $this->hasMany('Licenciatura');
	}
	
	public function idiomas()
	{
		return $this->hasMany('Idioma');
	}
	
	
	
	public function cursosActualizacion()
	{
		return $this->hasMany('CursosActualizacion');
	}
	
	
	public function instructorProgramas()
	{
		return $this->hasMany('InstructorProgramas');
	}
	
	
	public function cargaAcademicas()
	{
		return $this->hasMany('CargaAcademica');
	}
	
	public function imagenes()
	{
		return $this->hasMany('Imagen');
	}
	
	
	public function cursosProgramasRecuperacionAcademicas()
	{
		return $this->hasMany('CursosProgramaRecuperacionAcademica');
	}
	
	
	public function programasInduccionPropedeuticos()
	{
		return $this->hasMany('ProgramaInduccionPropedeutico');
	}
	
	
	
	public function programasInstitucionalTutorias()
	{
		return $this->hasMany('ProgramaInstitucionalTutoria');
	}
	
	
	public function imparticionEventosEducacionContinua()
	{
		return $this->hasMany('ImparticionEventoEducacionContinua');
	}
	
	
	
	
	public function polilibro()
	{
		return $this->hasMany('Polilibro');
	}
	
	public function desarrollointegral()
    {
		return $this->hasMany('DesarrolloIntegral');
	}

	public function practicasescolares()
	{
		return $this->hasMany('PracticasEscolares');
	}
 

	public function instructoresenolimpiadas()
	{
		return $this->hasMany('InstructoresEnOlimpiadas');
	}



	public function evaluaciondeprogramas()
	{
		return $this->hasMany('EvaluacionDeProgramas');
	}
	public function software()
    {
        return $this->hasMany('Software');
    }
	public function hardware()
    {
        return $this->hasMany('Hardware');
    }


    public function certamenes()
    {
        return $this->hasMany('Certamenes');
    }

    public function matacademico()
	{
		return $this->hasMany('MatAcademico');
	}


	public function carteles()
    {
        return $this->hasMany('Carteles');
    }
	
	
	
}

?>
