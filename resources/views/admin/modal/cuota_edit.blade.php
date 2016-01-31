<div class="modal fade" id="cuota_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Editar Cuota</h4>
			</div>

			<div class="modal-body">

				<input type="hidden" name="_token_cuota" value="{{ csrf_token() }}" id="token_cuota1">
				<input type="hidden" id="id_cuota1">
				<div class="form-group">
					{!!Form::label('Concepto:')!!}
					{!!Form::text('concept',null,['id'=>'concept_cuota1','class'=>'form-control','placeholder'=>'Ingresar concepto'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Monto:')!!}
					{!!Form::text('monto',null,['id'=>'monto_cuota1','class'=>'form-control','placeholder'=>'Ingresar monto'])!!}
				</div>
			</div>

				<div class="modal-footer">
					{!!link_to('#', $title='Modificar cuota', $attributes = ['id'=>'actualizar_cuota', 'class'=>'btn btn-primary'], $secure=null)!!}
					{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'eliminar_cuota', 'class'=>'btn btn-danger'], $secure=null)!!}
				</div>
		</div>
	</div>
</div>