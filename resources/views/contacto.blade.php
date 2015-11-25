@extends('layouts.principal')

@section('nav')
						<a href="http://localhost:8080/laravel5_1/public/home">
							<div class="col-xs-12 col-sm-1 col-md-1 col-lg-2 nav_tab">
								<div class="nav_ic icon1">
								</div>
								<p class="">Home</p>
							</div>
						</a>

						<a href="http://localhost:8080/laravel5_1/public/micuenta">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab ">
								<div class="nav_ic icon2">
								</div>
								<p>Mi Cuenta</p>
							</div>
						</a>

						<a href="http://localhost:8080/laravel5_1/public/mifraccionamiento">
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2  nav_tab">
								<div class="nav_ic icon3">
								</div>
								<p>Mi Fraccionamiento</p>
							</div>
						</a>

						<a href="http://localhost:8080/laravel5_1/public/transparencia">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
								<div class="nav_ic icon4">
								</div>
								<p>Transparencia</p>
							</div>
						</a>

						<a href="http://localhost:8080/laravel5_1/public/calendario">
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
								<div class="nav_ic icon5">
								</div>
								<p>Calendario</p>
							</div>
						</a>
									
						<a href="http://localhost:8080/laravel5_1/public/contacto">
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
						
						

						<div id="form" >
								<div class="contact_input row">
									<div class="col-xs-1 col-sm-3 col-md-3 col-lg-3">
										<p>Nombre:</p>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
										{{Auth::user()->name}}
										<input type="hidden" name="name" value="{{Auth::user()->name}}">
									</div>		
								</div>
							
								<div class="contact_input row">
									<div class="col-xs-1 col-sm-3 col-md-3 col-lg-3">
										<p>Email:</p>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
										{{Auth::user()->email}}
										<input type="hidden" name="email" value="{{Auth::user()->email}}">
									</div>	
								</div>
								
								<div class="contact_input row">
									<div class="col-xs-1 col-sm-3 col-md-3 col-lg-3">
										<p>Mensaje:</p>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
										<textarea id="msg" class="col-xs-12 col-lg-6" name="msg" maxlength="1000" cols="25" rows="5" resizable="false" required> </textarea>
									</div>			
								</div>	
	
								<div class="">
									<input type="submit" value="ENVIAR" id="submit_btn" class="col-xs-12 col-lg-3 col-lg-offset-3">
								</div>	

								<div id="form_msg"></div>

						</div> 
					</div>
				</div>
			</div> <!-- END main_cont -->
@stop


<script type="text/javascript">
	
$(document).ready(function() {

    $("#submit_btn").click(function() { 
       
        var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields       
        $("#form input[required=true], #form textarea[required=true]").each(function(){
            $(this).css('border-color',''); 
            if(!$.trim($(this).val())){ //if this field is empty 
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag
            }
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag              
            }   
        });
       
        if(proceed) //everything looks good! proceed...
        {
            //get input field values data to be sent to server
            post_data = {
                'name'     : $('input[name=name]').val(), 
                'email'    : $('input[name=email]').val(),
                'subject'       : 'Contacto', 
                'msg'           : $('textarea[name=msg]').val()
            };
            
            var formMessages = $('#form_msg');  
            
            //Ajax post data to server
            $.post('contacto.php', post_data, function(response){  
                if(response.type == 'mail'){ //load json data from server and output message 
                    $(formMessages).removeClass('verde');
                    $(formMessages).addClass('rojo');
                    $(formMessages).text('Introduzca un email valido.');
                }else if(response.type == 'error'){ //load json data from server and output message 
                    $(formMessages).removeClass('verde');
                    $(formMessages).addClass('rojo');
                    $(formMessages).text('Hubo un error. Intentelo de nuevo.');
                }else if(response.type == 'message'){
                	$(formMessages).removeClass('rojo');
                    $(formMessages).addClass('verde');
                    $(formMessages).text('Mensaje enviado. Gracias.');
                    //reset values in all input fields
                    $("#contact_form  input[required=true], #contact_form textarea[required=true]").val(''); 
                }
            }, 'json');
        }
    });
    
});


</script>