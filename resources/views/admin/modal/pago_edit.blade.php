<div class="modal fade" id="pago_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registro Manual de Pago</h4>
			</div>
<div id="msj-success1" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Pago actualizado exitosamente.</p>
</div>

<div id="msj-success2" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Pago eliminado exitosamente.</p>
</div>

<div id="msj-fail1" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>

<div id="msj-fail2" class="alert alert-danger alert-dismissible hide" role="alert">
  <p>Intentar de nuevo.</p>
</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_pago">
				<input type="hidden" name="user_name" value="" id="hidden_id">
				<input type="hidden" name="hidden_id_user" value="" id="hidden_id_user">
				<input type="hidden" id="id_pago">
				<div id="the-basics" class="form-group">
					{!!Form::label('Usuario:')!!}
					{!!Form::text('id_user',null,['id'=>'search-input2','class'=>'typeahead form-control','placeholder'=>'Ingresar Usuario'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Fecha:')!!}
					{!! Form::text('date', '', ['id' => 'datepicker_pago'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Cantidad:')!!}
					{!!Form::text('amount',null,['id'=>'amount_pago','class'=>'form-control','placeholder'=>'Ingresar Cantidad'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Status:')!!}
					{!!Form::select('status', ['Pagado', 'Adeudo'],null,['id'=>'status_pago'])!!}
				</div>
			</div>
				<div class="modal-footer">
					{!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar_pago', 'class'=>'btn btn-primary'], $secure=null)!!}
					{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'eliminar_pago', 'class'=>'btn btn-danger'], $secure=null)!!}
				</div>
		</div>
	</div>
</div>

