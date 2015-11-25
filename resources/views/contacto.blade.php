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

				<div id="main_cont">
				<div class="">

					<div class="cont_left col-lg-12">
					
						<div class="box_header">
							<img src="img/n_6.png">
							<h1>Contacto</h1>
						</div>
						

						<div class="contact-form">
								{!!Form::open(['route'=>'mail.store','method'=>'POST'])!!}
								    <div class="col-md-6">
										{!!Form::label('Nombre:')!!}
										{!!Form::text('name',null,['class'=>'typeahead form-control','placeholder'=>'Nombre'])!!}
									</div>
									<div class="col-md-6">
										{!!Form::label('Email:')!!}
										{!!Form::text('email',null,['class'=>'typeahead form-control','placeholder'=>'Email'])!!}
									</div>
									<div class="col-md-6">
										{!!Form::label('Mensaje:')!!}
										{!!Form::textarea('msg',null,['placeholder'=>'Mensaje'])!!}
									</div>
									{!!Form::submit('SEND')!!}
								{!!Form::close()!!}
						</div> 
					</div>
				</div>
			</div> <!-- END main_cont -->
@stop


