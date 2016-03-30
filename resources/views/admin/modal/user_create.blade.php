<div class="modal fade" id="user_create" role="dialog">

	<div class="modal-dialog" role="document">
		<div class="modal-content">


			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registrar Usuario</h4>
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
