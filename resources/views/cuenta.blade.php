@extends('layouts.principal')

	@include('modal.user_edit')
	@include('modal.pass_edit')
	@include('modal.mensual')
	@include('modal.semestral')
	@include('modal.anual')

	@section('css')
		{!!Html::style('css/jquery-ui.min.css')!!}
	@stop

	@section('nav')
						<a href="/home">
							<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 nav_tab">
								<div class="nav_ic icon1">
								</div>
								<p class="">Home</p>
							</div>
						</a>

						<a href="/micuenta">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
								<div class="nav_ic icon2">
								</div>
								<p>Mi Cuenta</p>
							</div>
						</a>

						<a href="/mifraccionamiento">
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2  nav_tab">
								<div class="nav_ic icon3">
								</div>
								<p>Mi Fraccionamiento</p>
							</div>
						</a>

						<a href="/transparencia">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
								<div class="nav_ic icon4">
								</div>
								<p>Transparencia</p>
							</div>
						</a>

						<a href="/calendario">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
								<div class="nav_ic icon5">
								</div>
								<p>Calendario</p>
							</div>
						</a>
									
						<a href="/contacto">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2  nav_tab">
								<div class="nav_ic icon6">
								</div>
								<p>Contacto</p>
							</div>
						</a>
	@stop

	@section('content')

					<div class="cont_left cont_600 col-lg-4">
						<div class="box_header">
							<img src="img/n_2.png">
							<h1>Mi Cuenta</h1>
						</div>
						
						<ul id="ul_interna">
							<li id="int_l1" class="left_sel"><p>Información General</p></li>
							<li id="int_l2"><p>Estado de Cuenta</p></li>
							<li id="int_l3"><p>Módulo de Pago</p></li>
						</ul>
					</div>

					<div class="cont_right col-lg-8">

						<div id="int_div1" class="int_div_sel">
							<div class="box_header">
								<p>Mi Fraccionamiento > Información General</p>
							</div>

								<div id="msj-success" class="alert alert-success alert-dismissible hide" role="alert">
								  <p>Información actualizada exitosamente.</p>
								</div>

								<div id="msj-fail" class="alert alert-danger alert-dismissible hide" role="alert">
								  <div class="msj"></div>
								</div>

								<div id="msj-success2" class="alert alert-success alert-dismissible hide" role="alert">
								  <p>Contraseña modificada exitosamente.</p>
								</div>

								<div id="msj-fail2" class="alert alert-danger alert-dismissible hide" role="alert">
								  <div class="msj"></div>
								</div>
						
							<div class="cont_in_r">
								@include('cuenta/info')
							</div>
						</div>

						<div id="int_div2" class="int_div">
							<div class="box_header">
								<p>Mi Fraccionamiento > Estado de Cuenta</p>
							</div>
						
							<div class="cont_in_r">
								@include('cuenta/estado')
							</div>
						</div>

						<div id="int_div3" class="int_div">
							<div class="box_header">
								<p>Mi Fraccionamiento > Módulo de Pago</p>
							</div>
						
							<div class="cont_in_r" >
								@include('cuenta/pago')
							</div>
						</div>
					</div> <!-- END cont_right -->
		
	@stop

	@section('script')
		{!!Html::script('js/userMode.js')!!}
		{!!Html::script('js/cuenta.js')!!}
	@stop


<style>
.mid_cont{
	margin: 0pt auto;
    width: 330px;
}

	</style>