
		<h3>Creacion de Noticias</h3>
		<br>

<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<p>Noticia registrada exitosamente.</p>
</div>

@include('alerts.success')

<button class='btn btn-primary' data-toggle="modal" data-target="#noticia_create">Crear Nueva Noticia</button>
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
			