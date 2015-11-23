@extends('layouts.principal')

@section('content')
			<div id="main_cont">
				<div class="">

					<div class="cont_left col-lg-12 ">

						<div class="box_header">
							{!!Html::image('img/noticias.png')!!}
							<h1>Noticias y Avisos</h1>
						</div>

							@foreach($noti_show as $noticia)
								<div class="noticia">
									{!!Html::image('file/'.$noticia->path)!!}
									<h1>{{$noticia->titulo}} - {!!substr($noticia->created_at, 0, 10)!!}</h1>
									<p>{{$noticia->texto}}</p>
															
								</div>
							@endforeach

							<br><br>
							<a href="/noticias">Regresar a noticias</a>

					</div> <!-- END cont_left -->

				</div>
			</div> <!-- END main_cont -->

@stop