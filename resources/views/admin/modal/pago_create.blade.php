<div class="modal fade" id="pago_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registro Manual de Pago</h4>
			</div>
<div id="msj-success" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Pago registrado exitosamente.</p>
</div>

<div id="msj-fail" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

				<div id="the-basics" class="form-group">
					{!!Form::label('Usuario:')!!}
					{!!Form::text('id_user',null,['id'=>'search-input','class'=>'typeahead form-control','placeholder'=>'Ingresar Usuario'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Fecha:')!!}
					{!! Form::text('date', '', ['id' => 'datepicker'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Cantidad:')!!}
					{!!Form::text('amount',null,['id'=>'amount','class'=>'form-control','placeholder'=>'Ingresar Cantidad'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Status:')!!}
					{!!Form::select('status', ['Pagado', 'Adeudo'],null,['id'=>'status'])!!}
				</div>
			</div>
				<div class="modal-footer">
					{!!link_to('#', $title='Registrar pago', $attributes = ['id'=>'registrar_pago', 'class'=>'btn btn-primary'], $secure=null)!!}
				</div>
		</div>
	</div>
</div>

