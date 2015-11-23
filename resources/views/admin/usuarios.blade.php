@extends('admin.admin')

	@include('alerts.success')
	@include('admin.modal.user_create')
	@include('admin.modal.user_edit')

	@section('nav')
		<a href="/admin/home">
				<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 nav_tab">
				<div class="nav_ic icon1">
				</div>
				<p>Home</p>
			</div>
		</a>
		<a href="/admin/administracion">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon7">
				</div>
				<p>Administración</p>
			</div>
		</a>
		<a href="/admin/contenidos">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2  nav_tab">
				<div class="nav_ic icon8">
				</div>
				<p>Contenidos</p>
			</div>
		</a>
		<a href="/admin/usuarios">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 nav_tab nav_sel">
				<div class="nav_ic icon9">
				</div>
				<p>Usuarios</p>
			</div>
		</a>
	@stop

	@section('content')

	<div class="cont_left col-lg-12">		
		<div class="box_header">
			{!!Html::image('img/n_9.png')!!}
			<h1>Usuarios</h1>
		</div>
		<br>	
			<button value='' OnClick='' class='btn btn-primary' data-toggle="modal" data-target="#user_create">Registrar un Nuevo Usuario</button>
		<br><br>
		<div id="the-basics" class="form-group">
			<input type="text" id="search-input" class="typeahead form-control" placeholder="Buscar..." >
			<button value='' OnClick='search();' class='btn btn-primary'>Buscar</button>
		</div>
		

		<div id="search_result">
		</div>

		<br><br>

		<div id="tablaUsuarios">
			@include('usuario.usuarios')
		</div>

	</div>

	@stop

	@section('script')
		
		{!!Html::script('js/typeahead.js/bloodhound.js')!!}
		{!!Html::script('js/typeahead.js/typeahead.bundle.js')!!}
		{!!Html::script('js/typeahead.js/typeahead.jquery.js')!!}
		{!!Html::script('js/user.js')!!}
	@stop







			