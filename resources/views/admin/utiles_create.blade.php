
		<h3>Creacion de Teléfonos y Sitios Útiles</h3>
		<br>

<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<p>Telefono/Sitio Util registrado exitosamente.</p>
</div>

@include('alerts.success')

<button class='btn btn-primary' data-toggle="modal" data-target="#util_create">Registrar Nuevo Telefono/Sitio</button>
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
			