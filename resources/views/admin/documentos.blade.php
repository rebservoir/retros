<h3>Documentos</h3>

<div id="msj-success-doc" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Nuevo Documento Creado exitosamente.</p>
</div>
<div id="msj-fail-doc" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>

<div id="msj-success-doc3" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Documento eliminado exitosamente.</p>
</div>
<div id="msj-fail-doc3" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>

<button class='btn btn-primary' data-toggle="modal" data-target="#documento_create">Crear Documento</button>

	<br><br>

<div id="divDocs">
	<table class="table">
		<thead>
			<th>Titulo</th>
			<th>Eliminar</th>
		</thead>
		<tbody>
			<input type="hidden" name="_token_doc1" value="{{ csrf_token() }}" id="token_doc1">
			@foreach($documentos as $doc)
				<tr>      	
					<td><p><a href="/file/{{$doc->path}}" target="_blank">{{$doc->titulo}}</a></p></td>
					<td><button value='{{$doc->id}}' OnClick='delete_doc(this);' class='btn btn-danger'>Eliminar</button></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>