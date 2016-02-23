<div class="modal fade" id="eventos_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Crear Evento</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token_evento" value="{{ csrf_token() }}" id="token_evento">

				<div id="the-basics" class="form-group">
					{!!Form::label('Titulo:')!!}
					{!!Form::text('title',null,['id'=>'title','class'=>'input_title','placeholder'=>'Ingresar Titulo'])!!}
				</div>

				<div class="form-group">
					{!!Form::label('Fecha de Inicio:')!!}
					{!! Form::text('start', '', ['id' => 'datepicker_start'])!!}
				</div>

				<div class="form-group">
					{!!Form::label('Fecha:')!!}
					{!! Form::text('end', '', ['id' => 'datepicker_end'])!!}
				</div>
			</div>
				<div class="modal-footer">
					{!!link_to('#', $title='Crear Evento', $attributes = ['id'=>'registrar_evento', 'class'=>'btn btn-primary'], $secure=null)!!}
				</div>
		</div>
	</div>
</div>



<style type="text/css">
	
	.input_title{
		 width: 100%;
	}
	
</style>