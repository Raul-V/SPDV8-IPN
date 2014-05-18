<?php

class Profesor_EliminarController extends BaseController
{

	public function __construct()
	{
		
		$this->beforeFilter('auth',array('except' =>array('getLogin','postLogin')));
	}
	public function getEliminar($id)
	{
		$doc=Documento::find($id);
		$nombre=$doc->nombre;
		if($doc->nombre=='Diplomados')
			Diplomado::destroy($id);
		else if($doc->nombre=='Idiomas')
			Idioma::destroy($id);
		else if($doc->nombre=='Otra Licenciatura')
			Licenciatura::destroy($id);
		else if($doc->nombre=='Carga académica')
			CargaAcademica::destroy($id);
		else if($doc->nombre=='Programa institucional para el desarrollo integral')
			DesarrolloIntegral::destroy($id);
		else if($doc->nombre=='Evaluación de informes de programas de servicio social')
			EvaluacionDeProgramas::destroy($id);
		else if($doc->nombre=='Instructores en olimpiadas nacionales e internacionales')
			InstructoresEnOlimpiadas::destroy($id);
		else if($doc->nombre=='Evaluación de prácticas escolares')
			PracticasEscolares::destroy($id);
		else if($doc->nombre=='Elaboración de software educativo')
			Software::destroy($id);
		else if($doc->nombre=='Elaboración de Hardware')
			Hardware::destroy($id);
		else if($doc->nombre=='Elaboración de Material Didactico')
			MatAcademico::destroy($id);
		else if($doc->nombre=='Conferencias, Videoconferencias y carteles')
			Carteles::destroy($id);
		else if($doc->nombre=='Evaluación de certámenes académicos')
			Certamenes::destroy($id);
		else if($doc->nombre=='Cursos de actualización, seminarios y talleres')
			CursosActualizacion::destroy($id);
		else if($doc->nombre=='Programas y proyectos institucionales en áreas centrales')
			ProgramaAreasCentrales::destroy($id);
		else if($doc->nombre=='Instructor de programas de formación docente y actualización profesional')
			InstructorProgramas::destroy($id);
		else if($doc->nombre=='Cursos del programa de recuperacion académica estudiantil')
			CursosProgramaRecuperacionAcademica::destroy($id);
		else if($doc->nombre=='Programa de inducción, propedéutico o atencion a pasantes')
			ProgramaInduccionPropedeutico::destroy($id);
		


		else if($doc->nombre=='Programa Institucional de Orientación Juvenil')
			ProgramaInstitucionalOrientacionJuvenil::destroy($id);
		else if($doc->nombre=='Programa Institucional de Tutorías')
			ProgramaInstitucionalTutoria::destroy($id);
		else if($doc->nombre=='Impartición de eventos de actualización en educación continua')
			ImparticionEventoEducacionContinua::destroy($id);
		else if($doc->nombre=='Autoria de libros impresos y/o digitales')
			Polilibro::destroy($id);
		
		
		
		
		else if($doc->nombre=='Expo-Profesiografica')
			ProgramaInstitucionalOrientacionJuvenil::destroy($id);
		else if($doc->nombre=='Encuentros Academicos Interpolitecnicos')
			ProgramaInstitucionalTutoria::destroy($id);
		else if($doc->nombre=='Brigadas multidiciplinarias del servicio social')
			ImparticionEventoEducacionContinua::destroy($id);
		else if($doc->nombre=='Impartición de actividades deportivas y/o talleres culturales')
			Polilibro::destroy($id);




		
		Imagen::destroy($id);
		Documento::destroy($id);
		$mensajes=array(MensajesSPD::getMSG33($nombre));
		return Redirect::to('profesor/documentos')->with('messages',$mensajes);
	}
}

