<div class="noticias col-lg-6">
	@foreach($noticias as $noticia)
		<div class="noticia">
			<img src="file/{{$noticia->path}}" class="col-lg-3">
			<h1>{{$noticia->titulo}} - {!!substr($noticia->created_at, 0, 10)!!}</h1>
			<p>{!!(substr($noticia->texto, 0, 60)) . ' ...'!!}

			<a href="noticia_show/{{$noticia->id}}">Leer mas...</a>						
		</div>

		
	@endforeach

	{!!$noticias->render()!!}
</div>