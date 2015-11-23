<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('login','FrontController@login');
Route::get('home','FrontController@index');
Route::get('noticias/{id?}','FrontController@noticias');
Route::get('contacto','FrontController@contacto');
Route::get('micuenta','FrontController@cuenta');
Route::get('transparencia','FrontController@transparencia');
Route::get('calendario','FrontController@calendario');

Route::get('admin/home','FrontController@admin');
Route::get('admin/administracion','FrontController@admin_modulo');
Route::get('admin/noticias','FrontController@noticias');
Route::get('mifraccionamiento','FrontController@mifrac');
Route::get('admin/contenidos','FrontController@contenidos');
Route::get('noticia_show/{id?}','NoticiaController@show');
Route::get('edit_info/{id?}','FrontController@edit_info');
Route::put('update_info_user/{id?}','FrontController@update_info_user');

Route::get('admin/noticia_show/{id?}','NoticiaController@show');
Route::get('admin/usuarios/','FrontController@usuarios');
Route::get('admin/usuarios/search/{id?}','UsuarioController@search');
Route::get('admin/usuarios/sort/{sort?}','UsuarioController@sort');

Route::resource('sitio','SitioController');
Route::resource('morosos','MorososController');
Route::resource('noticia','NoticiaController');
Route::resource('utiles','UtilesController');
Route::resource('usuario','UsuarioController');
Route::resource('log','LogController');
Route::resource('pagos','PagosController');
Route::resource('egresos','EgresosController');
Route::resource('saldos','SaldosController');

Route::get('logout','LogController@logout');

Route::get('controlador','PruebaController@index');
Route::get('name/{nombre}','PruebaController@nombre');
Route::resource('objeto','ObjetoController');  //php artisan make:controller ObjetoController


Route::get('prueba', function(){
	return "Hola desde routes.php";
});

Route::get('nombre/{nombre}', function($nombre){
	return "Mi nombre es ".$nombre;
});

Route::get('edad/{edad}', function($edad){
	return "Mi edad es ".$edad;
});

Route::get('edad2/{edad?}', function($edad = 20){
	return "Mi edad es ".$edad;
});

Route::get('/', function () {
    return view('welcome');
});

