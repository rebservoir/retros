
	<h3>Finanzas</h3>

	<p>Mostrar u ocultar para los usuarios la pestaña de Finanzas.</p>
		<br>
	<strong><p>Status:</p></strong>
	

@foreach($morosos as $moroso)	
	@if($moroso->id == 1)
		@if($moroso->is_active == 1)
			<h3><span class="label label-success">Mostrando</span></h3>
		@else
			<h3><span class="label label-danger">Oculto</span></h3>
		@endif
	@endif
@endforeach	

	<br>

	{!!Form::model($morosos, ['route'=> ['morosos.update', $morosos->id = 1], 'method'=>'PUT'])!!}

			<div class="form-group">
				{!!Form::label('Habilitar/Deshabilitar pestaña de Finanzas para usuarios')!!}
				{!!Form::select('is_active', ['NO', 'SI'], $moroso->is_active )!!}
			</div>

			{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}


