@extends('admin.admin')

	@include('admin.modal.util_edit')
	@include('admin.modal.util_create')
	@include('admin.modal.noticia_create')
	@include('admin.modal.noticia_edit')
	@include('admin.modal.sitio_edit')
	@include('admin.modal.documento_create')

	@section('nav')
		<a href="home">
				<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 nav_tab">
				<div class="nav_ic icon1">
				</div>
				<p>Home</p>
			</div>
		</a>
		<a href="administracion">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon7">
				</div>
				<p>Administración</p>
			</div>
		</a>
		<a href="contenidos">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 nav_tab nav_sel">
				<div class="nav_ic icon8">
				</div>
				<p>Contenidos</p>
			</div>
		</a>
		<a href="/admin/finanzas">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 nav_tab">
				<div class="nav_ic icon4">
				</div>
				<p>Finanzas</p>
			</div>
		</a>
		<a href="/admin/calendario">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 nav_tab">
				<div class="nav_ic icon5">
				</div>
				<p>Calendario</p>
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

	<div class="cont_left cont_600 col-lg-4">
						
						<div class="box_header">
							{!!Html::image('img/n_8.png')!!}
							<h1>Contenidos</h1>
						</div>
						
						<ul id="ul_interna">
							<li id="int_l1" class="left_sel">	<p>Edición de Noticias</p></li>
							<li id="int_l2">					<p>Ventana Morosos</p></li>
							<li id="int_l3">					<p>Pestaña Finanzas</p></li>
							<li id="int_l4">					<p>Teléfonos y Lugares Útiles</p></li>
							<li id="int_l5">					<p>Configuración del sitio</p></li>
							<li id="int_l6">					<p>Documentos</p></li>
						</ul>
						
					</div>

					<div class="cont_right col-lg-8">

						<div id="int_div1" class="int_div_sel">
							<div class="box_header">
								<p>Contenidos > Edición de Noticias</p>
							</div>
						
							<div class="cont_in_r">
								@include('admin/noticia_create')
							</div>
						</div>

						<div id="int_div2" class="int_div">
							<div class="box_header">
								<p>Contenidos > Ventana Morosos</p>
							</div>
						
							<div class="cont_in_r">
								@include('admin/morosos')
							</div>
						</div>

						<div id="int_div3" class="int_div">
							<div class="box_header">
								<p>Contenidos > Pestaña Finanzas</p>
							</div>
						
							<div class="cont_in_r">
								@include('admin/trans')
							</div>
						</div>

						<div id="int_div4" class="int_div">
							<div class="box_header">
								<p>Contenidos > Teléfonos y Lugares Útiles</p>
							</div>
						
							<div class="cont_in_r">
								@include('admin/utiles_create')
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
								<p>Contenidos > Documentos</p>
							</div>
						
							<div class="cont_in_r">
								@include('admin/documentos')
							</div>
						</div>

					</div> <!-- END cont_right -->

	@stop

	@section('script')
		{!!Html::script('js/util.js')!!}
	@stop