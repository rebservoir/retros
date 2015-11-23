@extends('layouts.principal')

	@section('content')

	<div class="cont_left cont_600 col-lg-4">
						
						<div class="box_header">
							<img src="img/n_3.png">
							<h1>Mi Fraccionamiento</h1>
						</div>
						
						<ul id="ul_interna">
							<li id="int_l1" class="left_sel"><p>Teléfonos y Sitios Útiles</p></li>
							<li id="int_l2"><p>Lost & Found</p></li>
							<li id="int_l3"><p>Políticas Internas</p></li>
							<li id="int_l4"><p>Encuestas</p></li>
							<li id="int_l5"><p>Venta, Donación y Alquiler</p></li>
						</ul>
						
					</div>

					<div class="cont_right col-lg-8">

						<div id="int_div1" class="int_div_sel">
							<div class="box_header">
								<p>Mi Fraccionamiento > Teléfonos y Sitios Útiles</p>
							</div>
						
							<div class="cont_in_r">
								@include('mifrac/utiles')
							</div>
						</div>

						<div id="int_div2" class="int_div">
							<div class="box_header">
								<p>Mi Fraccionamiento > Lost & Found</p>
							</div>
						
							<div class="cont_in_r">
							</div>
						</div>

						<div id="int_div3" class="int_div">
							<div class="box_header">
								<p>Mi Fraccionamiento > Políticas Internas</p>
							</div>
						
							<div class="cont_in_r">
								@include('mifrac/politicas')
							</div>
						</div>

						<div id="int_div4" class="int_div">
							<div class="box_header">
								<p>Mi Fraccionamiento > Encuestas</p>
							</div>
						
							<div class="cont_in_r">
							</div>
						</div>

						<div id="int_div5" class="int_div">
							<div class="box_header">
								<p>Mi Fraccionamiento > Venta, Donación y Alquiler</p>
							</div>
						
							<div class="cont_in_r">
							</div>
						</div>

					</div> <!-- END cont_right -->

	@stop