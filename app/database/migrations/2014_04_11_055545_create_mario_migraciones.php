<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarioMigraciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		
		Schema::create('elaboracionHardware',function($table)
	{
		//Esta es la llave primaria que sera llave foranea que apunta a la super tabla
		//Esta instruccion no se modifica
		$table->integer('id')->unsigned()->primary();
		
		$table->string('titulo');
		$table->integer('noAutores');
		$table->date('fecha');
		$table->string('areaAplicacion');
		// Semestre se cambió por año y semestre
		$table->integer('año');
		$table->string('semestre');
		$table->string('utilidad');
		$table->string('calidad');

		
	}
);
		//Este es para revertir los cambios del Schema::create
		

		Schema::create('actividadSindical',function($table)
			{
				//Esta es la llave primaria que sera llave foranea que apunta a la super tabla
				//Esta instruccion no se modifica
				$table->integer('id')->unsigned()->primary();

				$table->date('fechaInicioPeriodoIngresado');
				$table->date('fechaTerminoPeriodoIngresado');
				$table->date('fechaInicioPeriodoValido');
				$table->date('fechaTerminoPeriodoValido');
				$table->string('tiempo');
				$table->string('actividad'); 

				
			}
		);
		
		Schema::create('direccionTesis',function($table)
			{
				//Esta es la llave primaria que sera llave foranea que apunta a la super tabla
				//Esta instruccion no se modifica
				$table->integer('id')->unsigned()->primary();

				$table->string('nombreTesis');
				$table->string('numero');
				$table->date('fecha');				
			}
		);
		
		Schema::create('sinodaliaExamenPro',function($table)
			{
				//Esta es la llave primaria que sera llave foranea que apunta a la super tabla
				//Esta instruccion no se modifica
				$table->integer('id')->unsigned()->primary();

				$table->string('nombreTesis');
				$table->string('numero');
				$table->date('fecha');
				$table->string('imgActaExamenPro');
				//numeroActa = noConstancia

				
			}
		);
		
		
		
		
		
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
