@extends('layouts.principal')

@section('nav')
	<a href="/home">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
			<div class="nav_ic icon1">
			</div>
			<p class="">Home</p>
		</div>
	</a>
	<a href="/micuenta">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon2">
			</div>
			<p>Mi Cuenta</p>
		</div>
	</a>
	<a href="/misitio">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon3">
			</div>
			<p>Mi Sitio</p>
		</div>
	</a>
	@foreach($sections as $section)
		@if($section->id == 1)
			@if($section->is_active == 1)
				<a href="/finanzas">
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
						<div class="nav_ic icon4">
						</div>
						<p>Finanzas</p>
					</div>
				</a>
			@endif
		@endif
	@endforeach
	<a href="/calendario">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon5">
			</div>
			<p>Calendario</p>
		</div>
	</a>			
	<a href="/contacto">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon6">
			</div>
			<p>Contacto</p>
		</div>
	</a>	
@stop

@section('content')
	<div id="slider" class="">
		@foreach($sitios as $sitio)
			<img src="../file/{{$sitio->path}}" class="">
			<div id="slider_box">		
			</div>
			<div id="slider_name">
				<p>{{$sitio->name}}</p>
			</div>
		@endforeach
	</div> <!--END Slider -->

	<div id="main_cont">
		@foreach($sections as $section)
				@if($section->id == 0)
						@if($section->is_active == 1)
							<div class="cont_left col-sm-4 col-lg-4 cont_500">
								<div class="row">
									<div class="box_header">
										<div class="bx_title bx_100">
											{!!Html::image('img/morosos.png')!!}
											<h1>Morosos</h1>
										</div>
									</div>

									<div class="col-xs-12 pull-right">
										<ul>
											@foreach($users as $user)
												@if ($user->status == 0)
													<li>{{$user->name}}</li>
												@endif
											@endforeach		
										</ul>
									</div>
									{!!$users->render()!!}
								</div>
							</div>

								<div class="cont_right col-xs-12 col-sm-8 col-lg-8 cont_500">
							@else
								<div class="cont_right col-xs-12 col-sm-12 col-lg-12 cont_500" style="border-left: 1px solid #e2e2e2;">
							@endif
						@endif
					@endforeach
									<div class="row">
										<div class="box_header">
											<div class="bx_title bx_100">
												{!!Html::image('img/noticias.png')!!}
												<h1>Noticias y Avisos</h1>
											</div>
										</div>

									@foreach($noticias as $noticia)
	    								<div class="noticia col-xs-12 col-sm-11 col-md-12 col-lg-12">
	    									<div class="col-xs-0 col-sm-1 col-md-1 col-lg-1">
											</div>
											<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
												{!!Html::image('file/'.$noticia->path)!!}
											</div>
											<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
												<h1>{{$noticia->titulo}}</h1>
												<p>{!!substr($noticia->created_at, 0, 10)!!} | {!!(substr($noticia->texto, 0, 100)) . ' ...'!!}<a href="/admin/noticia_show/{{$noticia->id}}">Leer mas...</a></p>
											</div>
										</div>
	  								@endforeach

										<div class="row">
											<a class="vmas col-xs-4 col-sm-4 col-lg-3 pull-right" href="../admin/noticias" >Ver mas noticias ></a>
										</div>
									</div> <!-- END row -->
								</div> <!-- END cont_right -->
	</div> <!-- END main_cont -->
@stop
