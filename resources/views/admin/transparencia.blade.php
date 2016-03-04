@extends('admin.admin')


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
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 nav_tab nav_sel">
				<div class="nav_ic icon4">
				</div>
				<p>Transparencia</p>
			</div>
		</a>
		<a href="/admin/calendario">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 nav_tab">
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
$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
/*--}}

{{--*/ 
	$year = date('Y');
	$mes = date('n');
	$day = date('j');
	$total_egresos=0;
	$total_ingresos=0;
/*--}}

	<div id="main_cont">
		<div class="cont_left col-lg-12">
	
			<div class="box_header">
				{!!Html::image('img/n_4.png')!!}
					<h1>Transparencia</h1>
			</div>

				<div id="select_date">
					<p>Seleccionar Año y Mes</p>
						{{--*/ 
								echo "<select id='year_select' name='year_select' class='select_trans'>";

								for ($j = 2014; $j < 2017; $j++){
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
										echo "<option value='" . $k . "' selected='selected'>" . $month[$k-1] . "</option>";
									}else{
										echo "<option value='" . $k . "'>" . $month[$k-1] . "</option>";
									}
								}
								echo "</select>"; 
						/*--}}

						<button id="btn_select_admin" value='' class='btn btn-primary'>Mostrar</button>
				</div>

				<br><br>


	{{--*/ 
		$year = $year_sel;
		$mes = $mes_sel;
	/*--}}

	{{--*/ $pagos_num=0; $pagos_p=0; $pagos_a=0; /*--}}
		@foreach($pagos as $pago)
			{{--*/ 	$date_pago = explode("-", $pago->date);/*--}}
			@if(($date_pago[1] == $mes) && ($date_pago[0] == $year))
				{{--*/ $pagos_num++;/*--}}					
					@if($pago->status == 1)
						{{--*/ $pagos_p++;/*--}}
					@else
						{{--*/ $pagos_a++;/*--}}
					@endif
			@endif
		@endforeach

	{{--*/ 
		$mes_ant=$mes_sel - 1;
		$year_ant=0;
		$ing=0;
		$egr=0;
		$amount_ant=0;
		if($mes_ant==0){
			$mes_ant=12;
			$year_ant=$year_sel-1;
		}else{
			$mes_ant=$mes_sel-1;
			$year_ant=$year_sel;
		}
	/*--}}

		@foreach($pagos as $pago)
			{{--*/ 	$date_pago = explode("-", $pago->date);/*--}}
			@if(($date_pago[1] == $mes_ant) && ($date_pago[0] == $year_ant))	
				@if($pago->status == 1)
					{{--*/ $ing = $ing + $pago->amount; /*--}}
				@endif
			@endif
		@endforeach

		@foreach($egresos as $egreso)
			{{--*/ $date = explode("-", $egreso->date) /*--}}
				@if(($date[1] == $mes_ant) && ($date[0] == $year_ant))
						{{--*/ $egr = $egr + $egreso->amount; /*--}}
				@endif
		@endforeach

		{{--*/ $amount_ant = $ing - $egr; /*--}}
		
    <script type="text/javascript">
        var paga = <?php echo $pagos_p ?>;
        var deuda = <?php echo $pagos_a ?>;
        window.onload = function(){
        	loadChart(paga,deuda);	
        }
    </script>


    <div id="cont_table">
		<table class="table cifras table-bordered table-condensed">
			<thead>
				<th class="egremes">
					<h4>{{$month[$mes_sel-1]}} {{$year_sel}}</h4>
				</th>
			</thead>



		@foreach($pagos as $pago)
			{{--*/ 	$date_pago = explode("-", $pago->date);/*--}}
			@if(($date_pago[1] == $mes_ant) && ($date_pago[0] == $year_ant))	
				@if($pago->status == 1)
					{{--*/ $ing = $ing + $pago->amount; /*--}}
				@endif
			@endif
		@endforeach

		@foreach($pagos as $pago)
			{{--*/ $date = explode("-", $pago->date) /*--}}
				@if(($date[1] == $mes) && ($date[0] == $year))
					@if($pago->status == 1)
						{{--*/ $total_ingresos = $total_ingresos + $pago->amount; /*--}}
					@endif
				@endif
		@endforeach

			<tbody>								
				<tr>
					<td class="ingreso">
						<h4>Ingresos del Mes</h4>
						<h3>{{'$ '. number_format($total_ingresos,2) }}</h3>
					</td>
				</tr>
				<tr>
					<td class="anterior">
						<h4>Saldo Mes Anterior</h4>
						<h3>{{'$ '. number_format($amount_ant,2)}}</h3>
					</td>
				</tr>
				<tr>
					<td class="total">
						<h4>Saldo Total</h4>
						<h3>{{'$ '. number_format( $total_ingresos - $amount_ant , 2) }}</h3>
					</td>
				</tr>
			</tbody>
		</table>

			<br>

		<div id='chart_div' class='chart'>
			<p style="margin-top: 185px;text-align: center;">Cargando grafica...</p>
		</div>

		<div style="width: 200px;float: right;">
			<p>Total de Usuarios: {{ $pagos_num }}</p>
		</div>	
			
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<th class="egremes">
					<h4>Egresos del mes</h4>
				</th>
			</thead>

			<tbody id="tbody_egresos">
				<tr>
					<th>Fecha</th>
					<th>Descripción</th>
					<th>Monto</th>
					<th>Archivo</th>
				</tr>

			@foreach($egresos as $egreso)
				{{--*/ $date = explode("-", $egreso->date) /*--}}
					@if(($date[1] == $mes) && ($date[0] == $year))
						<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
							<td><p>{{$egreso->date}}</p></td>
							<td><p>{{$egreso->concept}}</p></td>
							<td><p>{{'$ '.$money}}</p></td>
								{{--*/ $total_egresos = ($egreso->amount + $total_egresos)/*--}}
															
						@if($egreso->path=="")
							<td><p>No disponible</p></td>
						@else
							<td><a href='/file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
						@endif
							</tr>
					@endif
			@endforeach
			 </tbody>
		</table>

				<br>

		<table class="table table-bordered table-striped table-condensed">
			<tbody>
				<tr> 
						{{--*/ $money = number_format($total_egresos, 2) /*--}}
					<td class="cifras2 egresos">
						<h4>Total de Egresos en el Mes</h4>
						<h3>{{'$ '.$money}}</h3>
					</td>
							{{--*/ $money = number_format(($total_ingresos - $total_egresos), 2) /*--}}
					<td class="cifras2 saldo">	
						<h4>Saldo</h4>
						<h3>{{'$ '.$money}}</h3>
					</td>
				</tr>
			</tbody>
		</table>

			</div> <!-- END cont_table -->
		</div>	  
	</div> <!-- END main_cont -->


@stop

@section('script')
	{!!Html::script('js/trans.js')!!}
	{!!Html::script('https://www.gstatic.com/charts/loader.js')!!}
@stop


<script type="text/javascript">
	window.onload = function() {
		var $mes = document.getElementById('year_select');
	};
	
</script>

<style>

div#select_date{
	margin: 0px auto;
	width: 300px;
}
div#cont_table{
	width: 85%;
    margin: 0pt auto;
}

.chart{
	width: 400px;
	height: 400px;
	float: right;
	margin: -60px 100px 0px 0px;
}
	
.tabla{
	width: 80%;
    margin: 0pt auto;
}

.cifras{
	width:40% !important;
	text-align: center; 
	float: left;
}
.cifras h3{

}
.cifras h4{

}
.ingreso{
	background: #E4F1FE;
    color: #555;
}
.anterior{
    background: #E4F1FE;
    color: #555;
}
.total{
    background: #E4F1FE;
    color: #555;
}
.cifras2{
	text-align: center;
}
.cifras2 h4{
}
.egremes{
	font-weight: normal;
    background: #2574A9;
	color: white;
    margin: 5px;
}
.egresos{
    color: #555;
}
.saldo{
    color: #555;
}
.fade {
    display: none !important;
}
.fade.in {
    display: block !important;
}

</style>



