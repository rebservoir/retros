@extends('admin.admin')

	@section('nav')
		<a href="/home">
				<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 nav_tab">
				<div class="nav_ic icon1">
				</div>
				<p>Home</p>
			</div>
		</a>
		<a href="/administracion">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon7">
				</div>
				<p>Administración</p>
			</div>
		</a>
		<a href="/contenidos">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2  nav_tab">
				<div class="nav_ic icon8">
				</div>
				<p>Contenidos</p>
			</div>
		</a>
		<a href="/usuarios">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2  nav_tab">
				<div class="nav_ic icon9">
				</div>
				<p>Usuarios</p>
			</div>
		</a>
	@stop

@section('content')
			<div id="main_cont">
				<div class="">

					<div class="cont_left col-lg-12">

						<div class="box_header">
							{!!Html::image('img/noticias.png')!!}
							<h1>Noticias y Avisos</h1>
						</div>

							@foreach($noti_show as $noticia)
								<div class="noticia_show">
									{!!Html::image('file/'.$noticia->path)!!}
									<h1>{{$noticia->titulo}} - {!!substr($noticia->created_at, 0, 10)!!}</h1>
									<p>{{$noticia->texto}}</p>						
								</div>
							@endforeach


									<br><br>
									<a href="/admin/noticias" class="noticia_show_a">Regresar a noticias</a>
					</div> <!-- END cont_left -->
				</div>
			</div> <!-- END main_cont -->

@stop