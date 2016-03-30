
	<h3>Morosos</h3>

	<p>Mostrar u ocultar para los usuarios la sección Morosos.</p>
		<br>
	<strong><p>Status:</p></strong>

	@foreach($sections as $section)
		@if($section->id == 0)
			@if($section->is_active == 1)
				<h3><span class="label label-success">Mostrando</span></h3>
			@else
				<h3><span class="label label-danger">Oculto</span></h3>
			@endif
		@endif
	@endforeach

		<br>

		{!!Form::model($sections, ['route'=> ['sections.update', $sections->id = 0], 'method'=>'PUT'])!!}
			<div class="form-group">
				{!!Form::label('Mostrar morosos en pagina principal:')!!}
				{!!Form::select('is_active', ['NO', 'SI'], $section->is_active )!!}
			</div>

			<div id="btns_morosos">
				<a href="#" id="act_morosos" class="btn btn-primary">Actualizar</a>
			</div>

			<div id="btns_confirm_morosos" class="btns_confirm"> 
				<div class="alert alert-warning alert-dismissible">
					<p>Atención: En status 'Mostrando' los nombres de morosos (usuarios con adeudo) serán publicados para todos lo usuarios en la página de inicio. ¿Esta seguro de proceder?</p>
				</div>
				<a href="#" id="cancel_morosos" class="btn btn-default cancel">Cancelar</a>
				{!!Form::submit('OK',['class'=>'btn btn-primary'])!!}
			</div>

		{!!Form::close()!!}


		

					