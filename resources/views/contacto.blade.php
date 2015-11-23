@extends('layouts.principal')

@section('content')

				<div id="main_cont">
				<div class="">

					<div class="cont_left col-lg-12">
					
						<div class="box_header">
							<img src="img/n_6.png">
							<h1>Contacto</h1>
						</div>
						
						

						<div id="form" >
								<div class="contact_input row">
									<div class="col-xs-1 col-sm-3 col-md-3 col-lg-3">
										<p>Nombre:</p>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
										<input  type="text" id="name" class="col-xs-12 col-lg-4" name="name" maxlength="50" size="30" required>
									</div>		
								</div>
							
								<div class="contact_input row">
									<div class="col-xs-1 col-sm-3 col-md-3 col-lg-3">
										<p>Email:</p>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
										<input  type="text" id="email" class="col-xs-12 col-lg-4" name="email" maxlength="80" size="30" required>
									</div>	
								</div>
						
								<div class="contact_input row">
									<div class="col-xs-1 col-sm-3 col-md-3 col-lg-3">
										<p>Telefono:</p>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
										<input type="text" id="phone_f" class="col-xs-12 col-lg-4" name="phone" maxlength="80" size="30" required>
									</div>			
								</div>
								
								<div class="contact_input row">
									<div class="col-xs-1 col-sm-3 col-md-3 col-lg-3">
										<p>Mensaje:</p>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
										<textarea id="msg" class="col-xs-12 col-lg-4" name="msg" maxlength="1000" cols="25" rows="5" resizable="false" required> </textarea>
									</div>			
								</div>	
	
								<div class="">
									<input type="submit" value="ENVIAR" id="submit_btn" class="col-xs-12 col-lg-3 col-lg-offset-3">
								</div>	

								

						</div> 
						
					</div>

				</div>
			</div> <!-- END main_cont -->
@stop