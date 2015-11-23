
<h3>Pagos</h3>
<button class='btn btn-primary' data-toggle="modal" data-target="#pago_create">Registrar Pago Manual</button>

<br><br>
<div id="tablaPagos">
	<table class="table">
		<thead>
			<th>Usuario</th>
			<th>Monto</th>
			<th>Fecha</th>
			<th>Editar</th>
		</thead>
		<tbody id="datos">
			@foreach($pagos as $pago)
				<tr>
					@foreach($users as $user)
						@if( $user->id == $pago->id_user)
							<td><p>{{$user->name}}</p></td>
						@endif
					@endforeach
					{{--*/ $money = number_format($pago->amount, 2, '.', '') /*--}}
					<td><p>{{'$ '.$money}}</p></td>
					<td><p>{{$pago->date}}</p></td>
					<td><button value='{{$pago->id}}' OnClick='Mostrar_pago(this)' class='btn btn-primary' data-toggle="modal" data-target="#pago_edit">Editar</button></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>


