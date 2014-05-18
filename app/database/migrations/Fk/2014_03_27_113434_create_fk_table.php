<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('profesor', function($table)
		{
			$table->foreign('id')->references('id')->on('usuario');		
		}
		);
		
		
		Schema::table('plaza', function($table)
		{
			$table->foreign('idProfesor')->references('id')->on('profesor');		
		}
		);
		
		
		Schema::table('usuario', function($table)
		{
			$table->foreign('idDireccion')->references('id')->on('direccion');		
		}
		);
		
		
		
		Schema::table('usuario', function($table)
		{
			$table->foreign('idInstitucion')->references('id')->on('institucion');		
		}
		);
		
		
		
		
		
		
		Schema::table('solicitud', function($table)
		{
			$table->foreign('idProfesor')->references('id')->on('profesor');		
		}
		);
		
		
		
		
		Schema::table('documento', function($table)
		{
			$table->foreign('idSolicitud')->references('id')->on('solicitud');		
		}
		);
		
		
		
		
		Schema::table('documento', function($table)
		{
			$table->foreign('idCategoria')->references('id')->on('categoria');		
		}
		);
		
		
		
		
		
		
		Schema::table('categoria', function($table)
		{
			$table->foreign('categoriaFK')->references('id')->on('categoria');		
		}
		);
		
		
		
		
		
		
		
		Schema::table('historial_cotejador', function($table)
		{
			$table->foreign('idProfesor')->references('id')->on('profesor');
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
