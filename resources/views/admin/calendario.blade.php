	@extends('admin.admin')

	@include('admin.modal.eventos_create')
	@include('admin.modal.eventos_edit')

	@section('css')
		{!!Html::style('fullcalendar-2.6.0/fullcalendar.css')!!}
		{!!Html::style('fullcalendar-2.6.0/fullcalendar.print.css')!!}
		{!!Html::style('css/jquery-ui.min.css')!!}
	@stop

@section('nav')
		<a href="/admin/home">
				<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 nav_tab">
				<div class="nav_ic icon1">
				</div>
				<p>Home</p>
			</div>
		</a>
		<a href="/admin/administracion">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab ">
				<div class="nav_ic icon7">
				</div>
				<p>Administración</p>
			</div>
		</a>
		<a href="/admin/contenidos">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 nav_tab">
				<div class="nav_ic icon8">
				</div>
				<p>Contenidos</p>
			</div>
		</a>
		<a href="/admin/transparencia">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 nav_tab ">
				<div class="nav_ic icon4">
				</div>
				<p>Transparencia</p>
			</div>
		</a>
		<a href="/admin/calendario">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 nav_tab nav_sel">
				<div class="nav_ic icon5">
				</div>
				<p>Calendario</p>
			</div>
		</a>
		<a href="/admin/usuarios">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2  nav_tab">
				<div class="nav_ic icon9">
				</div>
				<p>Usuarios</p>
			</div>
		</a>
	@stop


@section('content')

{{--*/
	$month = array("x","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
	$year = $year_sel;
	$mes = $mes_sel;
	$day = date('j');
	$fecha = $year . "-" . $mes . "-" . $day;
/*--}}


			<div id="main_cont">
				<div class="cont_left col-lg-12">

					<div class="box_header">
						{!!Html::image('img/n_5.png')!!}
						<h1>Calendario</h1>
					</div>


					<div id="select_date">
						<p>Seleccionar Año y Mes</p>

							{{--*/ 
								echo "<select id='year_select' name='year_select' class='select_trans'>";
									for ($j = ($year-1); $j < ($year+2); $j++){
										if($j==$year){
											echo "<option value='" . $j . "' selected='selected'>" . $j . "</option>";
										}else{
											echo "<option value='" . $j . "'>" . $j . "</option>";
										}
									}
								echo "</select>"; 
							/*--}}

							{{--*/ 
								echo "<select id='month_select' name='month_select' class='select_trans'>";
									for ($k = 1; $k < 13; $k++){
										if($k==$mes){
											echo "<option value='" . $k . "' selected='selected'>" . $month[$k] . "</option>";
										}else{
											echo "<option value='" . $k . "'>" . $month[$k] . "</option>";
										}
									}
								echo "</select>"; 
							/*--}}

						
							<button id="btn_cal_admin" value="" class="btn btn-primary">Mostrar</button>
							<button id="btn_add_event" value="" class="btn btn-primary" data-toggle="modal" data-target="#eventos_create">Crear Evento</button>
					</div>

						<br><br>
						
					<div id="calendar">
					</div>

						<br><br>

					<div id="tablaEventos">
						<table class="table">
							<thead>
								<th>Titulo</th>
								<th>Inicio</th>
								<th>Fin</th>
								<th>Editar</th>
							</thead>
							<tbody>
								@foreach($calendario as $cale)
									<tr>
										<td>
											<p>{{$cale->title}}</p>
										</td>
										<td>
											<p>{{$cale->start}}</p>
										</td>
										<td>
											<p>{{$cale->end}}</p>
										</td>
										<td>
											<button value='{{$cale->id}}' OnClick='Mostrar_evento(this);' class='btn btn-primary' data-toggle="modal" data-target="#eventos_edit">Editar</button>
										</td>
									</tr>
								@endforeach	
							</tbody>
						</table>
					</div>

				</div>
			</div> <!-- END main_cont -->
@stop


	@section('script')
		{!!Html::script('js/calendario.js')!!}
		{!!Html::script('fullcalendar-2.6.0/lib/moment.min.js')!!}
		{!!Html::script('fullcalendar-2.6.0/fullcalendar.min.js')!!}
		{!!Html::script('fullcalendar-2.6.0/lang-all.js')!!}
	@stop

<style>
	#calendar {
		max-width: 80% !important;
		margin: 0 auto;
	}
	div#select_date{
		margin-left: 10%;
		width: 500px;
	}
	div#tablaEventos{
		width: 80%;
		margin: 0 auto;
	}
</style>


    <script type="text/javascript">
        var date = <?php echo "'" . $fecha . "'" ?>;
        var eventos = [];
        eventos = <?php echo $calendario ?>;
        window.onload = function(){
        	calendar(date,eventos);	
        }
    </script>