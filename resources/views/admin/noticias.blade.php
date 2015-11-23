@extends('admin.admin')

@section('content')
			<div id="main_cont">
				<div class="">

					<div class="cont_left col-lg-12 ">

						<div class="box_header">
							{!!Html::image('img/noticias.png')!!}
							<h1>Noticias y Avisos</h1>
						</div>

						@include('admin.noticia.noticias')

					</div> <!-- END cont_left -->

				</div>
			</div> <!-- END main_cont -->

@stop