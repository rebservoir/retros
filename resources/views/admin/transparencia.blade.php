{{--*/ 
$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
/*--}}
					
	
				<h3>Transparencia</h3>

					<ul class="nav nav-tabs">
	    				{{--*/
							$year_c = date('Y');
							

	      					for ($j = 2015; $j < 2018; $j++) {
	        					if( $j == $year_c)
	          						echo "<li class='active'><a href='#t" . $j  . "'>" . $j . "</a></li>";
	        					else
	          						echo "<li><a href='#t" . $j  . "'>" . $j . "</a></li>";
	        					}
	    				/*--}}   
  					</ul>
						
						<br>

 
					<div class="tab-content tabla">
						{{--*/ 
	    					for ($j = 2015; $j < 2018; $j++) {
	      						if($j==$year_c)
	        						echo "<div id='t" . $j . "' class='tab-pane fade in active'>";
	      						else
	        						echo "<div id='t" . $j . "' class='tab-pane fade'>"; 
	  					/*--}} 

							<ul class="nav nav-tabs">
							    {{--*/
							    $mes = date('n'); 
							      for ($k = 0; $k < 12; $k++) {
							        if(($k+1)==$mes)
							          echo "<li class='active'><a href='#t" .$month[$k] . $j . "'>".$month[$k]."</a></li>";
							        else
							          echo "<li><a href='#t" .$month[$k] . $j ."'>".$month[$k]."</a></li>";         
							        }
							    /*--}}
							  </ul>

							  {{--*/ 
							    for ($q = 0; $q < 12; $q++) {
							      if(($q+1)==$mes)
							        echo "<div id='t" . $month[$q] . $j . "' class='tab-pane fade in active'>";
							      else
							        echo "<div id='t" . $month[$q] . $j . "' class='tab-pane fade'>"; 
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

