<div class="modal fade" id="user_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modificar Información</h4>
			</div>

<div id="msj-success" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Información actualizada exitosamente.</p>
</div>

<div id="msj-fail" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_info">
				<input type="hidden" id="id">
				
				<div class="form-group">
					{!!Form::label('Nombre:')!!}
					{!!Form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'Ingresar nombre de usuario'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Email:')!!}
					{!!Form::email('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Ingresar Email'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Dirección:')!!}
					{!!Form::text('address',null,['id'=>'address','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Telefono:')!!}
					{!!Form::text('phone',null,['id'=>'phone','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Celular:')!!}
					{!!Form::text('celphone',null,['id'=>'cel','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
				</div>
			</div>
			
			<div class="modal-footer">
				{!!link_to('#', $title='Modificar', $attributes = ['id'=>'modificar_info', 'class'=>'btn btn-primary'], $secure=null)!!}
			</div>
		</div>
	</div>
</div>
