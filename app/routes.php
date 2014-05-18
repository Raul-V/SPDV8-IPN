<?php
/*
<VirtualHost *:80>
	ServerName spdlaravel.com.mx
	DocumentRoot c:/xampp/htdocs/spdV1/public
</VirtualHost>
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	//return View::make('profesor.docencia.Modificar_polilibro');
	//return View::make('Modificar_polilibro');
	/*return View::make('profesor.superacionAcademica.registrarComisiones');
	return View::make('profesor.superacionAcademica.registrarCursos');
	return View::make('profesor.superacionAcademica.registrarDiplomado');
	/*return View::make('profesor.superacionAcademica.registrarEstancias');
	return View::make('profesor.superacionAcademica.registrarIdioma');
	return View::make('profesor.superacionAcademica.registrarInvestigacion');
	return View::make('profesor.superacionAcademica.registrarLicenciatura');
	//return View::make('profesor.superacionAcademica.registrarPrograma');
	//return View::make('profesor.superacionAcademica.registrarEstudios');*/
	return Redirect::to('login');
});
//Primero subrutas y luego rutas
Route::controller('login','AuthController');
Route::controller('profesor/registrar','Profesor_RegistrarController');
Route::controller('profesor/eliminar','Profesor_EliminarController');
Route::controller('profesor/editar','Profesor_ModificarController');
Route::controller('profesor/ver','Profesor_VisualizarController');
Route::controller('profesor','ProfesorController');
Route::controller('compulsa/ver','Compulsa_ProfesorController');
Route::controller('compulsa/cotejar','Compulsa_CotejarController');
Route::controller('compulsa','CompulsaController');
Route::any('logout','LogoutController@getLogout');

//Route::get('profesor/documentos','ProfesorController@getDocumentos');



