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

Route::get('finanzas/{mes_sel?}/{year_sel?}', 'FrontController@finanzas');
Route::get('calendario/{mes_sel?}/{year_sel?}', 'FrontController@calendario');
Route::get('misitio','FrontController@miSitio');
Route::get('noticia_show/{id?}','NoticiaController@show');
Route::get('edit_info/{id?}','FrontController@edit_info');
Route::get('pagos_show','FrontController@pagos_show');
Route::put('update_info_user/{id?}','FrontController@update_info_user');

Route::get('admin/home','FrontController@admin');
Route::get('admin/administracion','FrontController@admin_modulo');
Route::get('admin/calendario/{mes_sel?}/{year_sel?}', 'FrontController@calendario');
Route::get('admin/finanzas/{mes_sel?}/{year_sel?}', 'FrontController@finanzas');
Route::get('admin/noticias','FrontController@noticias');
Route::get('admin/contenidos','FrontController@contenidos');
Route::get('admin/noticia_show/{id?}','NoticiaController@show');
Route::get('admin/usuarios/','FrontController@usuarios');
Route::get('admin/usuarios/search/{id?}','UsuarioController@search');
Route::get('admin/usuarios/sort/{sort?}','UsuarioController@sort');
Route::get('admin/usuarios/sort_usr/{sort?}','UsuarioController@sort_usr');
Route::get('admin/usuarios/add/{id?}','UsuarioController@add');

Route::get('sendEmail/{id?}','MailController@sendEmail');
Route::get('sendEmailMsg/{id?}','MailController@sendEmailMsg');
Route::get('eventos/{id?}','CalendarioController@edit');
Route::get('eventos_create','CalendarioController@store');

Route::resource('mail','MailController@contact');
Route::resource('sitio','SitioController');
Route::resource('morosos','MorososController');
Route::resource('noticia','NoticiaController');
Route::resource('utiles','UtilesController');
Route::resource('usuario','UsuarioController');
Route::resource('log','LogController');
Route::resource('pagos','PagosController');
Route::resource('egresos','EgresosController');
Route::resource('saldos','SaldosController');
Route::resource('cuotas','CuotasController');
Route::resource('eventos','CalendarioController');
Route::resource('documentos','DocumentosController');
Route::resource('cashout','FrontController@cashOut');
Route::resource('duedate','FrontController@dueDate');
Route::resource('checkstatus','FrontController@checkStatus');

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

// Paypal

//Enviamos a PayPal

Route::get('pago/{type?}', array(
	'as' => 'pago',
	'uses' => 'PaypalController@postPayment',
));

// Paypal redirecciona a esta ruta
Route::get('payment/status', array(
	'as' => 'payment.status',
	'uses' => 'PaypalController@getPaymentStatus',
));
