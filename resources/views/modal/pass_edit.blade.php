<div class="modal fade" id="pass_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modificar Contraseña</h4>
			</div>

<div id="msj-success2" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Contraseña modificada exitosamente.</p>
</div>

<div id="msj-fail2" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_pass">
				<input type="hidden" id="id1">
				
				<div class="form-group">
					{!!Form::label('Introduzca contraseña actual:')!!}
					<br>
					{!!Form::password('name',null,['id'=>'pass1','class'=>'form-control','placeholder'=>'Contraseña actual'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Introduzca contraseña nueva:')!!}
					<br>
					{!!Form::password('name',null,['id'=>'pass2','class'=>'form-control','placeholder'=>'Contraseña nueva'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Confirmar contraseña nueva:')!!}
					<br>
					{!!Form::password('name',null,['id'=>'pass3','class'=>'form-control','placeholder'=>'Confirmar Contraseña nueva'])!!}
				</div>
			</div>
			
			<div class="modal-footer">
				{!!link_to('#', $title='Modificar', $attributes = ['id'=>'modificar_pass', 'class'=>'btn btn-primary'], $secure=null)!!}
			</div>
		</div>
	</div>
</div>
