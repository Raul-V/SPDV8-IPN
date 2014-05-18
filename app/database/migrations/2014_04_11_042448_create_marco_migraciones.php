<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcoMigraciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('desarrolloIntegral',function($table)
		{
			//Esta es la llave primaria que sera llave foranea que apunta a la super tabla
			//Esta instruccion no se modifica

			$table->integer('id')->unsigned()->primary();   
			$table->integer('noHorasSem');
			$table->integer('año');
			$table->string('nivel');
			$table->string('grupo');
			$table->string('semestreEsc');
			$table->string('registro'); 
			/* este documento tiene número de contancia que no se incluyo por la clase padre y registro*/
			

			//Esta instruccion no se modifica.
			
		}

	);




	Schema::create('polilibro',function($table)
		{
			//Esta es la llave primaria que sera llave foranea que apunta a la super tabla
			//Esta instruccion no se modifica

			$table->integer('id')->unsigned()->primary();   
			$table->integer('numeroAutores');
			$table->string('nivelaplicacion');
			$table->integer('año');
			$table->string('pais');
			$table->integer('calidad');
			
	
		}

	);



	Schema::create('evaluacionDeProgramas',function($table)
		{
			//Esta es la llave primaria que sera llave foranea que apunta a la super tabla
			//Esta instruccion no se modifica

			$table->integer('id')->unsigned()->primary(); 			
			$table->string('nombrePrograma');
			$table->string('numeroRegistro'); //otro documento
			$table->date('periodoInicio');
			$table->date('periodoFin');
			$table->string('imgCalificacion');
			
		}

	);



	Schema::create('instructoresEnOlimpiadas',function($table)
		{
			//Esta es la llave primaria que sera llave foranea que apunta a la super tabla
			//Esta instruccion no se modifica

			$table->integer('id')->unsigned()->primary(); 			
			$table->string('nombreEvento');
			$table->date('fechaEvento');
			$table->string('lugar');
			$table->string('evento');
			
		}

	);



	Schema::create('practicasEscolares',function($table)
		{
			//Esta es la llave primaria que sera llave foranea que apunta a la super tabla
			//Esta instruccion no se modifica

			$table->integer('id')->unsigned()->primary(); 			
			$table->string('tiponivel');
			$table->date('periodoInicio');
			$table->date('periodoFin');
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
