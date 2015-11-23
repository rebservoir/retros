
	<h3>Configuración del Sitio</h3>

<div id="divSitio">
	@foreach($sitio as $sitio)
		<button value='1' OnClick='Mostrar_sitio(this);' class='btn btn-primary' data-toggle="modal" data-target="#sitio_edit">Editar</button>
			<br><br>
			<p>Nombre del Fraccionamiento:</p>
				<h3>{{$sitio->name}}</h3>
			<br><br>
			<p>Imagen principal de home:</p>
				<img src="../file/{{$sitio->picture}}" class="col-lg-3">
			<br><br>
@endforeach

</div>