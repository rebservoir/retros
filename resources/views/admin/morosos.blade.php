<h3>Morosos</h3>
@foreach($morosos as $moroso)
	<p>Status:</p>
	@if($moroso->is_active == 1)
		<h3><span class="label label-success">Mostrando</span></h3>
	@else
		<h3><span class="label label-danger">Oculto</span></h3>
	@endif
	<br>
	{!!Form::model($morosos, ['route'=> ['morosos.update', $morosos->id = 0], 'method'=>'PUT'])!!}
		<div class="form-group">
			{!!Form::label('Mostrar morosos en pagina principal:')!!}
			{!!Form::select('is_active', ['NO', 'SI'], $moroso->is_active )!!}
		</div>
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
@endforeach