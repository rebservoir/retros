<h3>Cuotas</h3>

<div id="msj-success7" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Nueva Cuota Creada exitosamente.</p>
</div>
<div id="msj-fail7" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>

<div id="msj-success8" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Cuota actualizada exitosamente.</p>
</div>
<div id="msj-fail8" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>

<div id="msj-success9" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Cuota eliminada exitosamente.</p>
</div>
<div id="msj-fail9" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>

<div id="msj-warning" class="alert alert-warning alert-dismissible hide" role="alert">
</div>

<button class='btn btn-primary' data-toggle="modal" data-target="#cuota_create">Crear Cuota</button>

	<br><br>

<div id="divCuotas">
	<table class="table">
		<thead>
			<th>Concepto</th>
			<th>Monto</th>
			<th>Editar</th>
		</thead>
		<tbody>
			@foreach($cuotas as $cuota)
				<tr>
					<td><p>{{$cuota->concepto}}</p></td>
					<td><p>{{ '$ '. number_format($cuota->amount, 2) }}</p></td>
					<td><button value='{{$cuota->id}}' OnClick='mostrar_cuota(this);' class='btn btn-primary' data-toggle="modal" data-target="#cuota_edit" data_value="{{$cuota->id}}">Editar</button></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>