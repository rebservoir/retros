@extends('layouts.principal')

	@include('modal.user_edit')
	@include('modal.pass_edit')

	@section('css')
		{!!Html::style('css/jquery-ui.min.css')!!}
	@stop

@section('nav')
						<a href="/home">
							<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 nav_tab">
								<div class="nav_ic icon1">
								</div>
								<p class="">Home</p>
							</div>
						</a>

						<a href="/micuenta">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
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
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
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
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2  nav_tab nav_sel">
								<div class="nav_ic icon6">
								</div>
								<p>Contacto</p>
							</div>
						</a>
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

					<div class="cont_right col-lg-8">

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
								        <td class="text-center precio"><h3>$200.00</h3></td>
								        <td class="text-center precio"><h3>$1,200.00</h3></td>
								        <td class="text-center precio"><h3>$2,200.00</h3></td>
								      </tr>
								      <tr> 
								     	<td class="text-center pagar"><button type="button" class="btn-primary btn-block btn_paypal"></button></td>
								        <td class="text-center pagar"><button type="button" class="btn btn-primary btn-lg btn-block btn_paypal"><img src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/btn_10.png" alt="undefined" /></button></td>
								        <td class="text-center pagar"><button type="button" class="btn btn-primary btn-lg btn-block btn_paypal"><img src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/btn_10.png" alt="undefined" /></button></td>
								      </tr>
								    </tbody>
								  </table> 

								  <img src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/TDC_btn_4.png" alt="undefined" />
											<img src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/TD_btn_1.png" alt="undefined" />

							</div>
						</div>
					</div> <!-- END cont_right -->
		
	@stop

	@section('script')
		{!!Html::script('js/userMode.js')!!}
	@stop


	<style>
.btn_paypal{
    width: 172px !important;
    padding: 0px !important;
    margin: 0pt auto !important;
    margin-top: 5px !important;
    border: 1px solid transparent;
    border-radius: 4px;
    background-image: url("https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/btn_10.png");
    height: 34px;
}
.precio{
	 height: 150px;
}
.pagar{
	background-color: #C7C7C7;
    height: 110px;
    padding-top: 30px !important;
}
	</style>