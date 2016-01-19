@extends('layouts.principal')

@section('nav')
						<a href="/home">
							<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 nav_tab">
								<div class="nav_ic icon1">
								</div>
								<p class="">Home</p>
							</div>
						</a>

						<a href="/micuenta">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab ">
								<div class="nav_ic icon2">
								</div>
								<p>Mi Cuenta</p>
							</div>
						</a>

						<a href="/mifraccionamiento">
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2  nav_tab">
								<div class="nav_ic icon3">
								</div>
								<p>Mi Fraccionamiento</p>
							</div>
						</a>

						<a href="/transparencia">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
								<div class="nav_ic icon4">
								</div>
								<p>Transparencia</p>
							</div>
						</a>

						<a href="/calendario">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
								<div class="nav_ic icon5">
								</div>
								<p>Calendario</p>
							</div>
						</a>
									
						<a href="/contacto">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2  nav_tab">
								<div class="nav_ic icon6">
								</div>
								<p>Contacto</p>
							</div>
						</a>
	@stop

@section('content')

{{--*/ 
$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
/*--}}

			<div id="main_cont">
				<div class="cont_left col-lg-12">
					
					<div class="box_header">
						{!!Html::image('img/n_4.png')!!}
						<h1>Transparencia</h1>
					</div>

					<ul class="nav nav-tabs">
	    				{{--*/
							$year_c = date('Y');
							

	      					for ($j = 2014; $j < 2017; $j++) {
	        					if( $j == $year_c)
	          						echo "<li class='active'><a href='#" . $j  . "'>" . $j . "</a></li>";
	        					else
	          						echo "<li><a href='#" . $j  . "'>" . $j . "</a></li>";
	        					}
	    				/*--}}   
  					</ul>
						
						<br>

 
					<div class="tab-content tabla">
						{{--*/ 
	    					for ($j = 2014; $j < 2017; $j++) {
	      						if($j==$year_c)
	        						echo "<div id='" . $j . "' class='tab-pane fade in active'>";
	      						else
	        						echo "<div id='" . $j . "' class='tab-pane fade'>"; 
	  					/*--}} 

							<ul class="nav nav-tabs">
							    {{--*/
							    $mes = date('n'); 
							      for ($k = 0; $k < 12; $k++) {
							        if(($k+1)==$mes)
							          echo "<li class='active'><a href='#" .$month[$k] . $j . "'>".$month[$k]."</a></li>";
							        else
							          echo "<li><a href='#" .$month[$k] . $j ."'>".$month[$k]."</a></li>";         
							        }
							    /*--}}
							  </ul>

							  {{--*/ 
							    for ($q = 0; $q < 12; $q++) {
							      if(($q+1)==$mes)
							        echo "<div id='" . $month[$q] . $j . "' class='tab-pane fade in active'>";
							      else
							        echo "<div id='" . $month[$q] . $j . "' class='tab-pane fade'>"; 
							  /*--}} 

							    <br><br>


							<table class="table table-bordered table-condensed">
										    <tbody>
												{{--*/ $mes=$q; $total_egresos=0; $total_ingresos=0; /*--}}
												@foreach($saldos as $saldo)
													{{--*/ $date = explode("-", $saldo->date) /*--}}
													@if(($date[1] == $mes) && ($date[0] == $j))
														<tr>
															{{--*/ $m1 = number_format($saldo->ingresos, 2) /*--}}
															{{--*/ $total_ingresos = $saldo->ingresos /*--}}
															<td class="info">Ingresos del mes</td>
															<td><p>{{'$ '.$m1}}</p></td>
														</tr>
														<tr>
															{{--*/ $m2 = number_format($saldo->saldo, 2) /*--}}
															<td class="active">Saldo mes anterior</td>
															<td><p>{{'$ '.$m2}}</p></td>
														</tr>
														<tr>
															{{--*/ $m3 = number_format(($saldo->ingresos - $saldo->saldo), 2) /*--}}
															<td class="success">Saldo Total</td>
															<td><p>{{'$ '.$m3}}</p></td>
														</tr>
													@endif
												@endforeach
										    </tbody>
										</table>
										
											<br>
										<h3>Egresos del mes:</h3>
											<br>
										<table class="table table-bordered table-striped table-condensed">
										    <thead>
										      <tr class="info">
										        <th>Fecha</th>
										        <th>Monto</th>
										        <th>Descripción</th>
										        <th>Archivo</th>
										      </tr>
										    </thead>
											
											
										    <tbody id="tbody_egresos">
												@foreach($egresos as $egreso)
													{{--*/ $date = explode("-", $egreso->date) /*--}}
													@if(($date[1] == $mes) && ($date[0] == $j))
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
															<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
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
										        <td>Total de egresos en el mes</td>
										        {{--*/ $money = number_format($total_egresos, 2) /*--}}
										        <td><p>{{'$ '.$money}}</p></td>
										      </tr>
										      <tr>
										        <td class="success">Saldo</td>
										        {{--*/ $money = number_format(($total_ingresos - $total_egresos), 2) /*--}}
										        <td><p>{{'$ '.$money}}</p></td>
										      </tr>
										    </tbody>
										</table>

							    {{--*/ 
	        						echo "</div>"; 
	    						}
	  							/*--}}  


						{{--*/ 
	        				echo "</div>"; 
	    					}
	  					/*--}}   

					</div>

					

					  
				</div>
			</div> <!-- END main_cont -->

@stop

@section('script')
	{!!Html::script('js/trans.js')!!}
@stop




<style>
	
.tabla{
	width: 80%;
    margin: 0pt auto;
}

.fade {
    display: none !important;
}
.fade.in {
    display: block !important;
}

</style>



