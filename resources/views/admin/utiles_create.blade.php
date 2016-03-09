<h3>Creacion de Teléfonos y Lugares Útiles</h3>
<br>

<div id="msj-success4" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Sitio registrado exitosamente.</p>
</div>
<div id="msj-fail4" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>
<div id="msj-success5" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Sitio actualizado exitosamente.</p>
</div>
<div id="msj-success6" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Sitio eliminado exitosamente.</p>
</div>
<div id="msj-fail5" class="alert alert-danger alert-dismissible hide" role="alert">
  <p>Llenar campos requeridos.</p>
</div>
<div id="msj-fail6" class="alert alert-danger alert-dismissible hide" role="alert">
  <p>Intentar de nuevo.</p>
</div>

@include('alerts.success')

<button class='btn btn-primary' onclick=""  data-toggle="modal" data-target="#util_create">Registrar Nuevo Telefono/Lugar</button>
<br><br>
<div id="tablaUtiles">
	<table class="table">
		<thead>
			<th>Concepto</th>
			<th>Editar</th>
		</thead>
		<tbody id="datos">
				@foreach($utiles as $util)
					<tr>
						<td><p>{{$util->concept}}</p></td>
						<td><button value='{{$util->id}}' OnClick='Mostrar(this);' class='btn btn-primary' data-toggle="modal" data-target="#util_edit">Editar</button></td>
				@endforeach
		</tbody>
	</table>
</div>
			