<div class="modal fade" id="user_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
			</div>
<div id="msj-success1" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Usuario actualizado exitosamente.</p>
</div>

<div id="msj-success2" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Usuario eliminado exitosamente.</p>
</div>

<div id="msj-fail1" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>

<div id="msj-fail2" class="alert alert-danger alert-dismissible hide" role="alert">
  <p>Intentar de nuevo.</p>
</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				<input type="hidden" id="id">
				@include('usuario.forms.usr_edit')
			</div>
			
			<div class="modal-footer">
				{!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'], $secure=null)!!}
				{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'eliminar', 'class'=>'btn btn-danger'], $secure=null)!!}
			</div>
		</div>
	</div>
</div>
