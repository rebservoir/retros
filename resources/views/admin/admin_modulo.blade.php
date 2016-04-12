@extends('admin.admin')

	@include('admin.modal.pago_create')
	@include('admin.modal.pago_edit')
	@include('admin.modal.egresos_create')
	@include('admin.modal.egresos_edit')
	@include('admin.modal.cuota_create')
	@include('admin.modal.cuota_edit')
	@include('admin.modal.sitio_edit')
	@include('admin.modal.paypal_edit')

	@section('css')
		{!!Html::style('css/jquery-ui.min.css')!!}
	@stop

	@section('nav')
		<a href="home">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon1">
				</div>
				<p>Home</p>
			</div>
		</a>
		<a href="administracion">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
				<div class="nav_ic icon7">
				</div>
				<p>Administración</p>
			</div>
		</a>
		<a href="usuarios">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2  nav_tab">
				<div class="nav_ic icon9">
				</div>
				<p>Usuarios</p>
			</div>
		</a>
		<a href="contenidos">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2  nav_tab">
				<div class="nav_ic icon8">
				</div>
				<p>Contenidos</p>
			</div>
		</a>
		<a href="/admin/finanzas">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon4">
				</div>
				<p>Finanzas</p>
			</div>
		</a>
		<a href="/admin/calendario">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon5">
				</div>
				<p>Calendario</p>
			</div>
		</a>
@stop


@section('content')

	@include('alerts.update')
	@include('alerts.msg')

	<div id="main_cont">
		<div class="cont_left cont_600 col-lg-3">
			<div class="box_header">
				<div class="bx_title bx_80">
					{!!Html::image('img/n_7.png')!!}
					<h1>Administración</h1>
				</div>

				<div class="bx_20">
					<button class="burger">
						<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
		       		</button>
				</div>
			</div>

			<div id="admin_nav" class="nav_menu">
				<ul id="ul_interna">
					<li id="int_l1" class="left_sel">	<p>Pagos</p></li>
					<li id="int_l2">					<p>Egresos</p></li>
					<li id="int_l3">					<p>Registro de Cuotas</p></li>
					<li id="int_l4">					<p>Envió de Correos</p></li>
					<li id="int_l5">					<p>Configuración del sitio</p></li>
					<li id="int_l6">					<p>Configuración de PayPal</p></li>
				</ul>
			</div>
		</div>

		<div class="cont_right col-lg-9">
			<div id="int_div1" class="int_div_sel">
				<div class="box_header bh_left">
					<p>Administración > Pagos</p>
				</div>
						
				<div class="cont_in_r">
					@include('admin.pagos')
				</div>
			</div>

			<div id="int_div2" class="int_div">
				<div class="box_header">
					<p>Administración > Egresos</p>
				</div>
						
				<div class="cont_in_r">
					@include('admin.egresos')
				</div>
			</div>

			<div id="int_div3" class="int_div">
				<div class="box_header">
					<p>Administración > Registro de Cuotas</p>
				</div>
					
				<div class="cont_in_r">
					@include('admin.cuotas')
				</div>
			</div>

			<div id="int_div4" class="int_div">
				<div class="box_header">
					<p>Administración > Envió de Correos</p>
				</div>
						
				<div class="cont_in_r">
					@include('admin.correos')
				</div>
			</div>

			<div id="int_div5" class="int_div">
				<div class="box_header">
					<p>Contenidos > Configuración del Sitio</p>
				</div>
						
				<div class="cont_in_r">
					@include('admin/sitio')
				</div>
			</div>

			<div id="int_div6" class="int_div">
				<div class="box_header">
					<p>Contenidos > Configuración de PayPal</p>
				</div>
						
				<div class="cont_in_r">
					@include('admin/paypal')
				</div>
			</div>
		</div> <!-- END cont_right -->
	</div> <!-- END main_cont -->
@stop

@section('script')
	{!!Html::script('js/typeahead.js/bloodhound.js')!!}
	{!!Html::script('js/typeahead.js/typeahead.bundle.js')!!}
	{!!Html::script('js/typeahead.js/typeahead.jquery.js')!!}
	{!!Html::script('js/admin.js')!!}
@stop