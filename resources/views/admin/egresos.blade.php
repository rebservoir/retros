<h3>Egresos</h3>
<button class='btn btn-primary' data-toggle="modal" data-target="#egresos_create">Registrar Egresos</button>

<br><br>
<ul class="nav nav-tabs">
    <li><a href="#2013">2013</a></li>
    <li><a href="#2014">2014</a></li>
    <li class="active"><a href="#2015">2015</a></li>
    <li><a href="#2016">2016</a></li>
</ul>

  <div class="tab-content">
    <br><br>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#ene">Enero</a></li>
		<li><a href="#feb">Febrero</a></li>
		<li><a href="#mar">Marzo</a></li>
		<li><a href="#abr">Abril</a></li>
		<li><a href="#may">Mayo</a></li>
		<li><a href="#jun">Junio</a></li>
		<li><a href="#jul">Julio</a></li>
		<li><a href="#ago">Agosto</a></li>
		<li><a href="#sep">Septiembre</a></li>
		<li><a href="#oct">Octubre</a></li>
		<li><a href="#nov">Noviembre</a></li>
		<li><a href="#dic">Diciembre</a></li>
	</ul>

<div class="tab-content">
	<div id="tablaEgresos">
	  <div id="ene" class="tab-pane fade in active">

			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==1)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="feb" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==2)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="mar" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==3)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="abr" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==4)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="may" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==5)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="jun" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==6)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="jul" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==7)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="ago" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==8)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="sep" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==9)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="oct" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==10)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="nov" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==11)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
	  </div>
	  <div id="dic" class="tab-pane fade">
			<table class="table">
				<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if($date[1]==12)
							<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
								<td><p>{{$egreso->date}}</p></td>
								<td><p>{{$egreso->concept}}</p></td>
								<td><p>{{'$ '.$money}}</p></td>
								<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
		</div>
	  </div>
	</div> <!-- END tablaEgresos -->
</div> <!-- END tab-content -->



<style>
.fade {
    display: none !important;
}
.fade.in {
    display: block !important;
}
</style>