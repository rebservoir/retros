		<table class="table">
			<thead id="thead_user">
				<th id="th1" class="th_op">Nombre
					<select id="nombre_select" name="nombre_select" class="select_user">
					<option value="null">--</option>
					<option value="name">A-Z</option>
					<option value="desc">Z-A</option>
					</select></th>
				</th>
				<th id="th2" class="th_op">Email
					<select id="status_select" name="status" class="select_user">
					<option value="null">--</option>
					<option value="email">A-Z</option>
					<option value="email_desc">Z-A</option>
					</select></th>
				</th>
				<th id="th3" class="th_op">Dirección</th>
				<th >Telefono</th>
				<th >Celular</th>
				<th id="th4" class="th_op">Status<br>
					<select id="status_select" name="status" class="select_user">
					<option value="null">--</option>
					<option value="all">Todos</option>
					<option value="adeudo">Adeudo</option>
					<option value="corriente">Corriente</option>
					</select></th>
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


<style>

#thead_user th{
	cursor: pointer;
}
.th_op:hover{
	background-color: #C5DEF5;
}
.th_sel{
	background-color: #C5DEF5;
}



</style>

<script>
	/*+++++++++++++++++ usuario sort ++++++++++++++++++++*/

var current_sort = "#sort1";
var x;

function Toggle_sort(id_sel){
    $( current_sort ).addClass( "hidden" );
    x = document.getElementById(id_sel).value;
    current_sort= x;
    $( current_sort ).removeClass( "hidden" );
}


</script>