@extends('admin.admin')

	@include('admin.modal.pago_create')
	@include('admin.modal.pago_edit')
	@include('admin.modal.egresos_create')
	@include('admin.modal.egresos_edit')

	@section('css')
		{!!Html::style('css/jquery-ui.min.css')!!}
	@stop

	@section('nav')
		<a href="home">
				<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 nav_tab">
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
		<a href="contenidos">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2  nav_tab">
				<div class="nav_ic icon8">
				</div>
				<p>Contenidos</p>
			</div>
		</a>
		<a href="usuarios">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2  nav_tab">
				<div class="nav_ic icon9">
				</div>
				<p>Usuarios</p>
			</div>
		</a>
	@stop

	@section('content')

					<div class="cont_left cont_600 col-lg-3">
						<div class="box_header">
							{!!Html::image('img/n_7.png')!!}
							<h1>Administración</h1>
						</div>
						
						<ul id="ul_interna">
							<li id="int_l1" class="left_sel">	<p>Pagos</p></li>
							<li id="int_l2">					<p>Egresos</p></li>
							<li id="int_l3">					<p>Transparencia</p></li>
							<li id="int_l4">					<p>Registro de Cuotas</p></li>
							<li id="int_l5">					<p>Tareas</p></li>
							<li id="int_l6">					<p>Envió de Correos</p></li>
						</ul>
					</div>

					<div class="cont_right col-lg-9">

						<div id="int_div1" class="int_div_sel">
							<div class="box_header">
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
								<p>Administración > Transparencia</p>
							</div>
						
							<div class="cont_in_r">
							</div>
						</div>

						<div id="int_div4" class="int_div">
							<div class="box_header">
								<p>Administración > Registro de Cuotas</p>
							</div>
						
							<div class="cont_in_r">
	
							</div>
						</div>

						<div id="int_div5" class="int_div">
							<div class="box_header">
								<p>Administración > Tareas</p>
							</div>
						
							<div class="cont_in_r">
	
							</div>
						</div>

						<div id="int_div6" class="int_div">
							<div class="box_header">
								<p>Administración > Envió de Correos</p>
							</div>
						
							<div class="cont_in_r">
							</div>
						</div>

					</div> <!-- END cont_right -->

	@stop

	@section('script')
		{!!Html::script('js/typeahead.js/bloodhound.js')!!}
		{!!Html::script('js/typeahead.js/typeahead.bundle.js')!!}
		{!!Html::script('js/typeahead.js/typeahead.jquery.js')!!}
		{!!Html::script('js/admin.js')!!}
	@stop