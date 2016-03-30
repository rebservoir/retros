
	<h3>Finanzas</h3>

	<p>Mostrar u ocultar para los usuarios la pestaña de Finanzas.</p>
		<br>
	<strong><p>Status:</p></strong>
	

@foreach($sections as $section)	
	@if($section->id == 1)
		@if($section->is_active == 1)
			<h3><span class="label label-success">Mostrando</span></h3>
		@else
			<h3><span class="label label-danger">Oculto</span></h3>
		@endif
	@endif
@endforeach	

	<br>

	{!!Form::model($sections, ['route'=> ['sections.update', $sections->id = 1], 'method'=>'PUT'])!!}
			<div class="form-group">
				{!!Form::label('Habilitar/Deshabilitar pestaña de Finanzas para usuarios')!!}
				{!!Form::select('is_active', ['NO', 'SI'], $section->is_active )!!}
			</div>

			<div id="btns_finanzas">
				<a href="#" id="act_finanzas" class="btn btn-primary">Actualizar</a>
			</div>

			<div id="btns_confirm_finanzas" class="btns_confirm"> 
				<div class="alert alert-warning alert-dismissible">
					<p>Atención: En status 'Mostrando' la pestaña Finanzas sera visible para todos lo usuarios. ¿Esta seguro de proceder?</p>
				</div>
				<a href="#" id="cancel_finanzas" class="btn btn-default cancel">Cancelar</a>
				{!!Form::submit('Ok',['class'=>'btn btn-primary'])!!}
			</div>

	{!!Form::close()!!}