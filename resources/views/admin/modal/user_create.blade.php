

<div class="modal fade" id="user_create" role="dialog">

	<div class="modal-dialog" role="document">
		<div class="modal-content">


			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registrar Usuario</h4>
			</div>

<div id="msj-success" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Usuario registrado exitosamente.</p>
</div>

<div id="msj-fail" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				<input type="hidden" id="id">
				@include('usuario.forms.usr_create')
			</div>
			
			<div class="modal-footer">
				{!!link_to('#', $title='Registrar', $attributes = ['id'=>'registrar', 'class'=>'btn btn-primary'], $secure=null)!!}
			</div>
		</div>
	</div>
</div>
