@extends('layouts.principal')

@section('content')

			<div id="main_cont">
					<div class="cont_left col-lg-12">
					
						<div class="box_header">
							{!!Html::image('img/n_4.png')!!}
							<h1>Transparencia</h1>
						</div>

					  <ul class="nav nav-tabs">
					    <li><a href="#2013">2013</a></li>
					    <li><a href="#2014">2014</a></li>
					    <li class="active"><a href="#2015">2015</a></li>
					    <li><a href="#2016">2016</a></li>
					    <li><a href="#2017">2017</a></li>
					  </ul>
						
	
					      <br>
						  <ul class="nav nav-tabs">
						    <li class="active"><a href="">Enero</a></li>
						    <li><a href="">Febrero</a></li>
						    <li><a href="">Marzo</a></li>
						    <li><a href="">Abril</a></li>
						    <li><a href="">Mayo</a></li>
						    <li><a href="">Junio</a></li>
						    <li><a href="">Julio</a></li>
						    <li><a href="">Agosto</a></li>
						    <li><a href="">Septiembre</a></li>
						    <li><a href="">Octubre</a></li>
						    <li><a href="">Noviembre</a></li>
						    <li><a href="">Diciembre</a></li>
					  	  </ul>

					  	  	<br><br>
							

							<br>	

						  	  <div class="tab-content">
										<table class="table table-condensed">
										    <tbody>
												{{--*/ $mes=1; $total_egresos=0; $total_ingresos=0; /*--}}
												@foreach($saldos as $saldo)
													{{--*/ $date = explode("-", $saldo->date) /*--}}
													@if($date[1]==$mes)
														<tr>
															{{--*/ $m1 = number_format($saldo->ingresos, 2) /*--}}
															{{--*/ $total_ingresos = $saldo->ingresos /*--}}
															<td>Ingresos del mes</td>
															<td><p>{{'$ '.$m1}}</p></td>
														</tr>
														<tr>
															{{--*/ $m2 = number_format($saldo->saldo, 2) /*--}}
															<td>Saldo mes anterior</td>
															<td><p>{{'$ '.$m2}}</p></td>
														</tr>
														<tr>
															{{--*/ $m3 = number_format(($m1-$m2), 2) /*--}}
															<td>Total</td>
															<td><p>{{'$ '.$m3}}</p></td>
														</tr>
													@endif
												@endforeach
										    </tbody>
										</table>
										
										<br>
										<p>Egresos del mes:</p>

										<table class="table table-condensed">
										    <thead>
										      <tr>
										        <th>Fecha</th>
										        <th>Monto</th>
										        <th>Descripción</th>
										        <th>Archivo</th>
										      </tr>
										    </thead>
											
											
										    <tbody id="tbody_egresos">
												@foreach($egresos as $egreso)
													{{--*/ $date = explode("-", $egreso->date) /*--}}
													@if($date[1]==$mes)
														<tr>
															{{--*/ $date = explode("-", $egreso->date) /*--}}
															{{--*/ $money = number_format($egreso->amount, 2) /*--}}
															<td><p>{{$egreso->date}}</p></td>
															<td><p>{{$egreso->concept}}</p></td>
															<td><p>{{'$ '.$money}}</p></td>
															{{--*/ $total_egresos = ($egreso->amount + $total_egresos)/*--}}
															<td><a href='file/{{$egreso->path}}'  target="_blank">Descargar</a></td>
														</tr>
													@endif
												@endforeach
										    </tbody>
										</table>

										<br>

										<table class="table table-condensed">
										    <tbody>
										      <tr>
										        <td>Total de egresos en el mes</td>
										        {{--*/ $money = number_format($total_egresos, 2) /*--}}
										        <td><p>{{'$ '.$money}}</p></td>
										      </tr>
										      <tr>
										        <td>Saldo</td>
										        {{--*/ $money = number_format(($total_ingresos - $total_egresos), 2) /*--}}
										        <td><p>{{'$ '.$money}}</p></td>
										      </tr>
										    </tbody>
										</table>
						  	  		</div>
					  
				</div>
			</div> <!-- END main_cont -->
@stop


@section('script')
	{!!Html::script('js/trans.js')!!}
@stop








