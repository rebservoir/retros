<div class="noticias col-lg-12">
	@foreach($noticias as $noticia)
		<div class="noticia col-xs-12 col-sm-11 col-md-11 col-lg-11">
			{!!Html::image('file/'.$noticia->path)!!}
			<div class="col-xs-12 col-sm-8 col-md-9  col-lg-9">
				<h1>{{$noticia->titulo}}</h1>
				<p>{!!substr($noticia->created_at, 0, 10)!!} | {!!(substr($noticia->texto, 0, 100)) . ' ...'!!}
					<a href="/admin/noticia_show/{{$noticia->id}}">Leer mas...</a>
				</p>										
			</div>
		</div>
	@endforeach
	{!!$noticias->render()!!}
</div>



