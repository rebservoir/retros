<h3>Edición de Noticias</h3>
<br>

<div id="msj-success" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Noticia Creada exitosamente.</p>
</div>
<div id="msj-fail" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>
<div id="msj-success1" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Noticia actualizada exitosamente.</p>
</div>

<div id="msj-success2" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Noticia eliminada exitosamente.</p>
</div>

<div id="msj-fail1" class="alert alert-danger alert-dismissible hide" role="alert">
  <p>Llenar campos requeridos.</p>
</div>

<div id="msj-fail2" class="alert alert-danger alert-dismissible hide" role="alert">
  <p>Intentar de nuevo.</p>
</div>

@include('alerts.success')

<button class='btn btn-primary'  data-toggle="modal" data-target="#noticia_create">Crear Nueva Noticia</button>
<br><br>
<div id="tablaNoticias">
	<table class="table">
		<thead>
			<th>Titulo</th>
			<th>Editar</th>
		</thead>
		<tbody id="datos">
			@foreach($noticias as $noticia)
				<tr>
					<td><a href="noticia_show/{{$noticia->id}}" target="_blank"><p>{{$noticia->titulo}}</p></a></td>
					<td><button value='{{$noticia->id}}' OnClick='Mostrar_noticia(this);' class='btn btn-primary' data-toggle="modal" data-target="#noticia_edit">Editar</button></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
			