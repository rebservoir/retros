<div class="modal fade" id="egresos_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registro de Egresos</h4>
			</div>

			<div class="modal-body">
			{!! Form::open(array('id' => 'registrar_egresos', 'files' => true)) !!}
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_eg">
				<div class="form-group">
					{!!Form::label('Concepto:')!!}
					{!!Form::text('concept',null,['id'=>'concept','class'=>'form-control','placeholder'=>'Ingresar Concepto'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Archivo:')!!}
					{!!Form::file('path', ['id'=>'path'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Fecha:')!!}
					{!! Form::text('date', '', ['id' => 'datepicker_eg'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Cantidad:')!!}
					{!!Form::text('amount',null,['id'=>'amount_egresos','class'=>'form-control','placeholder'=>'Ingresar Cantidad'])!!}
				</div>
			</div>
				<div class="modal-footer">
					{!!Form::submit('Registrar Egresos',['id'=>'registrar_egresos', 'class'=>'btn btn-primary'])!!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>