@extends('layouts.principal')

	@include('modal.user_edit')
	@include('modal.pass_edit')

	@section('css')
		{!!Html::style('css/jquery-ui.min.css')!!}
	@stop

	@section('content')


					<div class="cont_left cont_600 col-lg-4">
						<div class="box_header">
							<img src="img/n_2.png">
							<h1>Mi Cuenta</h1>
						</div>
						
						<ul id="ul_interna">
							<li id="int_l1" class="left_sel"><p>Información General</p></li>
							<li id="int_l2"><p>Estado de Cuenta</p></li>
							<li id="int_l3"><p>Módulo de Pago</p></li>
						</ul>
					</div>

					<div class="cont_right cont_600 col-lg-8">

						<div id="int_div1" class="int_div_sel">
							<div class="box_header">
								<p>Mi Fraccionamiento > Información General</p>
							</div>
						
							<div class="cont_in_r">
								
								<div id="info_user" class="table-responsive">          
								  <table class="table">
								    <tbody>

								      <tr>
								        <td><p>Nombre:</p></td>
								        <td><p>{!!Auth::user()->name!!}</p></td>
								      </tr>

								      <tr>
								        <td><p>Email:</p></td>
								        <td><p>{!!Auth::user()->email!!}</p></td>
								      </tr>

								      <tr>
								        <td><p>Dirección:</p></td>
								        <td><p>{!!Auth::user()->address!!}</p></td>
								      </tr>

								      <tr>
								      	<td><p>Telefono:</p></td>
								      	<td><p>{!!Auth::user()->phone!!}</p></td>
								      </tr>

								      <tr>
								      	<td><p>Celular:</p></td>
								      	<td><p>{!!Auth::user()->celphone!!}</p></td>
								      </tr>

								    </tbody>
								  </table>
								</div>

								<button value='{!!Auth::user()->id!!}' OnClick='mostrar_info(this);' class='btn btn-primary' data-toggle="modal" data-target="#user_edit">Modificar Información</button>
								<br><br>
								<button value='{!!Auth::user()->id!!}'  class='btn btn-primary' data-toggle="modal" data-target="#pass_edit">Modificar Contraseña</button>
							</div>
						</div>

						<div id="int_div2" class="int_div">
							<div class="box_header">
								<p>Mi Fraccionamiento > Estado de Cuenta</p>
							</div>
						
							<div class="cont_in_r">

								<p>Status de Pago:</p>
								@if (Auth::user()->status == 0)
									<p>Pagado</p>
								@else
									<p>Adeudo</p>
								@endif

								@include('cuenta/estado')

							</div>
						</div>

						<div id="int_div3" class="int_div">
							<div class="box_header">
								<p>Mi Fraccionamiento > Módulo de Pago</p>
							</div>
						
							<div class="cont_in_r">

								<table class="table table-bordered">
								    <thead>
								      <tr>
								        <th class="text-center success"><h3>Mensual</h3></th>
								        <th class="text-center info "><h3>Semestral</h3></th>
								        <th class="text-center success"><h3>Anual</h3></th>
								      </tr>
								    </thead>
								    <tbody>
								      <tr>
								        <td class="text-center"><h3>$200.00</h3></td>
								        <td class="text-center"><h3>$1,200.00</h3></td>
								        <td class="text-center"><h3>$2,200.00</h3></td>
								      </tr>
								      <tr> 
								     	<td class="text-center"><button type="button" class="btn btn-primary btn-lg btn-block">Pagar</button></td>
								        <td class="text-center"><button type="button" class="btn btn-primary btn-lg btn-block">Pagar</button></td>
								        <td class="text-center"><button type="button" class="btn btn-primary btn-lg btn-block">Pagar</button></td>
								      </tr>
								    </tbody>
								  </table> 

							</div>
						</div>
					</div> <!-- END cont_right -->
		
	@stop

	@section('script')
		{!!Html::script('js/userMode.js')!!}
	@stop