@extends('layouts.principal')

@section('content')

<div id="slider" class="">
					<div id="slider_box">
					</div>
					<div id="slider_name">
						<p>Lomas Punta del Este Residencial</p>
					</div>
				</div> <!--END Slider -->

				<div id="main_cont">
					<div class="">

						<div class="cont_left col-sm-4 col-lg-4 cont_400">
							<div class="box_header">
								{!!Html::image('img/morosos.png')!!}
								<h1>Morosos</h1>
							</div>
							
							<div class="col-xs-12 pull-right">
								<ul>
									@foreach($morosos as $moroso)
										@if($moroso->is_active == 1)
											@foreach($users as $user)
												@if ($user->status == 1)
													<li>{{$user->name}}</li>
												@endif
											@endforeach
										
											@else
												<li>No disponible</li>
											@endif
									@endforeach

									{!!$users->render()!!}
								</ul>
							</div>
						</div>

						<div class="cont_right col-sm-8 col-lg-8 cont_400">
							<div class="row">
								<div class="box_header">
									{!!Html::image('img/noticias.png')!!}
									<h1>Noticias y Avisos</h1>
								</div>

								@foreach($noticias as $noticia)
    								<div class="noticia col-xs-12 col-sm-11 col-md-11 col-lg-11 pull-right">
										{!!Html::image('file/'.$noticia->path)!!}
										<div class="col-xs-12 col-sm-8 col-md-9  col-lg-9">
											<h1>{{$noticia->titulo}} - {!!substr($noticia->created_at, 0, 10)!!}</h1>
											<p>{!!(substr($noticia->texto, 0, 60)) . ' ...'!!}<a href="http://localhost:8080/laravel5_1/public/noticia_show/{{$noticia->id}}">Leer mas...</a></p>
										</div>
									</div>
  								@endforeach

								<div class="row">
									<a class="vmas col-xs-8 col-sm-4 col-lg-3 pull-right" href="noticias" >Ver mas noticias ></a>
								</div>

							</div> <!-- END row -->
						</div> <!-- END cont_right -->
					</div>
				</div> <!-- END main_cont -->

@stop