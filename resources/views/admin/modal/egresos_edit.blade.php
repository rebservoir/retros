<div class="modal fade" id="egresos_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Editar Egresos</h4>
			</div>

			<div class="modal-body">
			{!! Form::open(['route' => 'egresos.update', 'method'=>'PUT', 'files' => true ])!!}
				<input type="hidden" name="_token_edit" value="{{ csrf_token() }}" id="token_eg1">
				<input type="hidden" id="id_egresos" name="id_egresos">
				<div class="form-group">
					{!!Form::label('Concepto:')!!}
					{!!Form::text('concept',null,['id'=>'concept_eg','class'=>'form-control','placeholder'=>'Ingresar Concepto'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Archivo:')!!}
					{!!Form::file('path', ['id'=>'path_eg'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Fecha:')!!}
					{!! Form::text('date', '', ['id' => 'datepicker_eg_edit'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Cantidad:')!!}
					{!!Form::text('amount',null,['id'=>'amount_eg','class'=>'form-control','placeholder'=>'Ingresar Cantidad'])!!}
				</div>
			</div>
				<div class="modal-footer">
					{!!Form::submit('Actualizar',['id'=>'actualizar_egresos', 'class'=>'btn btn-primary'])!!}
					{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'eliminar_egresos', 'class'=>'btn btn-danger'], $secure=null)!!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

