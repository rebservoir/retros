<div class="modal fade" id="noticia_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modificar Noticia</h4>
			</div>

			<div class="modal-body">
				{!! Form::open(array('id' => 'actualizar_noticia', 'files' => true)) !!}
					<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_noti_1">
					<input type="hidden" id="id_noti_1">
					<div class="form-group">
						{!!Form::label('Titulo:')!!}
						{!!Form::text('titulo',null,['id'=>'titulo1','class'=>'form-control','placeholder'=>'Titulo'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('Contenido:')!!}
						{!!Form::textarea('texto',null,['id'=>'contenido1','class'=>'form-control','placeholder'=>'Contenido'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('Imagen:')!!}
						{!!Form::file('path', ['id'=>'path1'])!!}
					</div>
			</div>
			
				<div class="modal-footer">
						{!!Form::submit('Modificar Noticia',['class'=>'btn btn-primary'])!!}
						{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'eliminar_noticia', 'class'=>'btn btn-danger'], $secure=null)!!}
				</div>
			{!! Form::close() !!}


		</div>
	</div>
</div>