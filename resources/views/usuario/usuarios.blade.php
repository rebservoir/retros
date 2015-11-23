		<table class="table">
			<thead>
				<th>Nombre</th>
				<th>Email</th>
				<th>Dirección</th>
				<th>Telefono</th>
				<th>Celular</th>
				<th>Status</th>
				<th>Editar</th>
			</thead>

			@foreach($users as $user)
			<tbody>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->address}}</td>
				<td>{{$user->phone}}</td>
				<td>{{$user->celphone}}</td>
				<td>
					@if($user->status==0)
						<span class="label label-success">Ok</span>
					@elseif($user->status==1)
						<span class="label label-danger">Adeudo</span>
					@else
						<span class="label label-info">Admin</span>
					@endif
				</td>
				<td><button value='{{$user->id}}' OnClick='Mostrar(this);' class='btn btn-primary' data-toggle="modal" data-target="#user_edit">Editar</button></td>
			</tbody>
			@endforeach
		</table>

