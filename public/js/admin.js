var id_usuario,id_actual;
var user_name;
var id_usuario_actual;


function get_id_user_pago(id_user){
    id_usuario = id_user;
    //console.log('la id_user es:' + id_usuario);
}

$(function() {
	$( "#datepicker" ).datepicker();
    $( "#datepicker" ).datepicker("option", "dateFormat", "yy-mm-dd");
  
	$( "#datepicker_eg" ).datepicker();
    $( "#datepicker_eg" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_pago" ).datepicker();
    $( "#datepicker_pago" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_eg_edit" ).datepicker();
    $( "#datepicker_eg_edit" ).datepicker("option", "dateFormat", "yy-mm-dd");
  });


function close_modals(){
    $("#msj-success").addClass( "hide");
    $("#msj-success1").addClass( "hide");
    $("#msj-success2").addClass( "hide");
    $("#msj-success3").addClass( "hide");
    $("#msj-success4").addClass( "hide");
    $("#msj-success5").addClass( "hide");
    $( "#msj-fail").addClass( "hide");
    $( "#msj-fail1").addClass( "hide");
    $( "#msj-fail2").addClass( "hide");
    $( "#msj-fail3").addClass( "hide");
    $( "#msj-fail4").addClass( "hide");
    $( "#msj-fail5").addClass( "hide");
}

$("#registrar_pago").click(function(){

    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");

    var dato1 = id_usuario;
    var dato2 = $("#datepicker").val();
    var dato3 = $("#amount").val();
    var dato4 = $("#status").val();
    var dato5 = $('#search-input').val();
   
    var route = "/pagos";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{id_user: dato1, date: dato2, amount: dato3, status: dato4, user_name: dato5},

        success:function(){
            $("#msj-success").removeClass( "hide");
            $("#tablaPagos").load(location.href+" #tablaPagos>*","");
            $('#pago_create').modal('toggle');
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            //console.log(obj);
            var msj = obj.id_user + '<br>' + obj.date + '<br>' + obj.amount + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/id_user/gi, 'Usuario');
            var res = res.replace(/date/gi, 'Fecha');
            var res = res.replace(/amount/gi, 'Cantidad');
            $(".msj").html(res);
        } 
    });
});

function Mostrar_pago(btn){
    id_usuario='';
    $("#msj-success").addClass( "hide");
    $("#msj-fail").addClass( "hide");
    $("#msj-success1").addClass( "hide");
    $("#msj-fail1").addClass( "hide");
    $("#msj-success2").addClass( "hide");
    $("#msj-fail2").addClass( "hide");

    
    var route = "/pagos/"+btn.value+"/edit";

    $.get(route, function(res){
        //console.log(res);
        $("#hidden_id").val(res.id);
        $("#hidden_id_user").val(res.id_user);
        $("#datepicker_pago").val(res.date);
        $("#amount_pago").val(res.amount);
        $("#status_pago").val(res.status);
        $("#search-input2").val(res.user_name);
    });

}

$("#actualizar_pago").click(function(){
    $("#msj-success1").addClass( "hide");
    $("#msj-fail1").addClass("hide");
    $("#msj-success2").addClass("hide");
    $("#msj-fail2").addClass("hide");
    
    var dato1 = $("#hidden_id_user").val();
    var dato2 = $("#datepicker_pago").val();
    var dato3 = $("#amount_pago").val();
    var dato4 = $("#status_pago").val();
    var dato5 = $("#search-input2").val();
    var value = $("#hidden_id").val();

    if(id_usuario!=''){
        if(dato1!=id_usuario){
            dato1 = id_usuario;
        }
    }

    var route = "/pagos/"+value+"";
    var token = $("#token_pago").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{id_user: dato1, date: dato2, amount: dato3, status: dato4, user_name: dato5},
        success:function(){
            $("#msj-success1").removeClass( "hide");
            $("#tablaPagos").load(location.href+" #tablaPagos>*","");
            $('#pago_edit').modal('toggle');
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail1").removeClass( "hide");
            //console.log(obj);
            var msj = obj.id_user + '<br>' + obj.date + '<br>' + obj.amount + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/id_user/gi, 'Usuario');
            var res = res.replace(/date/gi, 'Fecha');
            var res = res.replace(/amount/gi, 'Cantidad');
            $(".msj").html(res);
        } 

    });
});

$("#eliminar_pago").click(function(){
    $("#msj-success1").addClass( "hide");
    $( "#msj-fail1").addClass( "hide");
    $("#msj-success2").addClass( "hide");
    $( "#msj-fail2").addClass( "hide");
    if (confirm("Eliminar este pago?") == true) {
        var value = $("#hidden_id").val();
        var route = "/pagos/"+value;
        var token = $("#token_pago").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
            $("#msj-success2").removeClass( "hide");
            $("#tablaPagos").load(location.href+" #tablaPagos>*","");
            $('#pago_edit').modal('toggle');
            },
            error: function (jqXHR, exception) {
                $("#msj-fail2").removeClass( "hide");
            } 
        });
    } else {
    } 
});


 $("#registrar_egresos").on("submit", function(e){
        $("#msj-success3").addClass( "hide");
    $("#msj-fail3").addClass( "hide");
    e.preventDefault();
    var fd = new FormData(this);

    //var dato1 = $("#concept").val();
    //var dato2 = $("#datepicker_eg").val();
    //var dato3 = $("#amount_egresos").val();

    var route = "/egresos";
    var token = $("#token_eg").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: fd,
        contentType: false,
        processData: false,

        success:function(){
            $("#msj-success3").removeClass("hide");
            $("#tablaEgresos").load(location.href+" #tablaEgresos>*","");
            $('#egresos_create').modal('toggle');
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail3").removeClass("hide");
            var msj = obj.id_user + '<br>' + obj.date + '<br>' + obj.amount + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/id_user/gi, 'Usuario');
            var res = res.replace(/date/gi, 'Fecha');
            var res = res.replace(/amount/gi, 'Cantidad');
            $(".msj").html(res);
        }    
    });
});

function Mostrar_egresos(btn){
    $("#msj-success3").addClass( "hide");
    $("#msj-fail3").addClass( "hide");
    $("#msj-success4").addClass( "hide");
    $("#msj-fail4").addClass( "hide");
    $("#msj-success5").addClass( "hide");
    $("#msj-fail6").addClass( "hide");
    var route = "/egresos/"+btn.value+"/edit";
    $.get(route, function(res){
        $("#concept_eg").val(res.concept);
        $("#datepicker_eg_edit").val(res.date);
        $("#amount_eg").val(res.amount);
        $("#id_egresos").val(res.id);
    });
    var value = $("#id_egresos").val();
}


$("#actualizar_egresos").on("submit", function(e){
    e.preventDefault();
    var fd = new FormData(this);

    var value = $("#id_egresos").val();
    var route = "/egresos/" + value;
    var token = $("#token_eg1").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: fd,
        contentType: false,
        processData: false,

        success:function(){
            //$("#msj-success3").removeClass("hide");
            $("#tablaEgresos").load(location.href+" #tablaEgresos>*","");
            $('#egresos_edit').modal('toggle');
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail3").removeClass("hide");
            $('#egresos_edit').modal('toggle');
            var msj = obj.id_user + '<br>' + obj.date + '<br>' + obj.amount + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/id_user/gi, 'Usuario');
            var res = res.replace(/date/gi, 'Fecha');
            var res = res.replace(/amount/gi, 'Cantidad');
            $(".msj").html(res);
        }    
    });
});

$("#eliminar_egresos").click(function(){
    if (confirm("Eliminar este egreso?") == true) {
        var value = $("#id_egresos").val();
        var route = "/egresos/"+value;
        var token = $("#token_eg1").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
            $("#msj-success5").removeClass( "hide");
            $("#tablaEgresos").load(location.href+" #tablaEgresos>*","");
             $('#egresos_edit').modal('toggle');
            },
            error: function (jqXHR, exception) {
                $( "#msj-fail5").removeClass( "hide");
            } 

        });
    } else {
    } 
});




var index=0;
var names = [];

$( document ).ready(function() {

 var route = "/usuario/show";
    $.get(route, function(res){

    for (index = 0; index < res.length; index++) {
        names[index] = res[index].name + '/' +res[index].id;
        //console.log(names[index]);
    }

    });
});

var substringMatcher = function(strs) {

  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
    
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
          var xxx = str;
        //var xxx = str.split('/');
      if (substrRegex.test(str)) {
        matches.push(xxx);
      }
    });

    cb(matches);

  };
};

$('#the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(names)
});



function mostrar_cuota(btn){

    $("#msj-success7").addClass( "hide");
    $("#msj-fail7").addClass( "hide");
    $("#msj-success8").addClass( "hide");
    $("#msj-fail8").addClass( "hide");
    $("#msj-success9").addClass( "hide");
    $("#msj-fail9").addClass( "hide");


    var route = "/cuotas/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#concept_cuota1").val(res.concepto);
        $("#monto_cuota1").val(res.amount);
        $("#id_cuota1").val(res.id);
    });
}

$("#registrar_cuota").click(function(){

    $("#msj-success7").addClass( "hide");
    $("#msj-fail7").addClass( "hide");
    $("#msj-success8").addClass( "hide");
    $("#msj-fail8").addClass( "hide");
    $("#msj-success9").addClass( "hide");
    $("#msj-fail9").addClass( "hide");

    var dato1 = $("#concept_cuota").val();
    var dato2 = $("#monto_cuota").val();
    var route = "/cuotas";
    var token = $("#token_cuota").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{concepto: dato1, amount: dato2},

        success:function(){
            $("#msj-success7").removeClass( "hide");
            $("#divCuotas").load(location.href+" #divCuotas>*","");
            $('#cuota_create').modal('toggle');
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail7").removeClass( "hide");
            var msj = obj.concept + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/concept/gi, 'Concepto');
            $(".msj").html(res);
            $('#cuota_create').modal('toggle');
        } 
    });
});


$("#actualizar_cuota").click(function(){

    $("#msj-success7").addClass( "hide");
    $("#msj-fail7").addClass( "hide");
    $("#msj-success8").addClass( "hide");
    $("#msj-fail8").addClass( "hide");
    $("#msj-success9").addClass( "hide");
    $("#msj-fail9").addClass( "hide");

    var value = $("#id_cuota1").val();
    var dato1 = $("#concept_cuota1").val();
    var dato2 = $("#monto_cuota1").val();

    var route = "/cuotas/"+value+"";
    var token = $("#token_cuota1").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{concepto: dato1, amount: dato2},

        success:function(){
            $("#msj-success8").removeClass( "hide");
            $("#divCuotas").load(location.href+" #divCuotas>*","");
            $('#cuota_edit').modal('toggle');
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail8").removeClass( "hide");
            var msj = obj.concept + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/concept/gi, 'Concepto');
            //$(".msj").html(res);
            $('#cuotas_edit').modal('toggle');
        } 

    });
});

$("#eliminar_cuota").click(function(){

    $("#msj-success7").addClass( "hide");
    $("#msj-fail7").addClass( "hide");
    $("#msj-success8").addClass( "hide");
    $("#msj-fail8").addClass( "hide");
    $("#msj-success9").addClass( "hide");
    $("#msj-fail9").addClass( "hide");
    $("#msj-warning").addClass( "hide");

    if (confirm("Eliminar esta Cuota?") == true) {

        var value = $("#id_cuota1").val();
        var route = "/cuotas/"+value;
        var token = $("#token_cuota1").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(data){
                
                if(data.tipo=='success'){
                    $("#msj-success9").removeClass( "hide");
                    $("#msj-success9").html(data.message);
                }else if(data.tipo=='warning'){
                    $("#msj-warning").removeClass( "hide");
                    $("#msj-warning").html(data.message);
                }
                $("#divCuotas").load(location.href+" #divCuotas>*","");
                $('#cuota_edit').modal('toggle');
            },
            error: function (jqXHR, exception) {
                $( "#msj-fail9").removeClass( "hide");
            }
        });
    } else {
    } 
});

var tipo=1;
//se selecciona el tipo de mensaje y se agrega el codigo correspondiente.
$( "#tipo_select" ).change(function() {

    var tipo1 =  '<div><h4>Asunto:</h4><input type="text" id="txt_subj" style="width: 300px;"></div><div><h4>Redactar mensaje:</h4><textarea id="txt_msg" rows="5" cols="50"></textarea></div>';
    var tipo2 =  "<div><h4>Mensaje de Corte</h4></div>";
    var tipo3 =  "<div><h4>Mensaje de Adeudo</h4></div>";

    if( this.value == 1){
         $("#tipos").html(tipo1);
         tipo = 1;
    }else if( this.value == 2){
        $("#tipos").html(tipo2);
        tipo = 2;
    }else{
        $("#tipos").html(tipo3);
        tipo = 3;
    }
});

//se selecciona el destinatario y se llama la funcion getusers. 
$( "#to_select" ).change(function(){

    var sort;
    var code=0;

        if( this.value == 1){
            getUsers(1);
            $( "#add_user").addClass( "hidden");
        }else if( this.value == 2){
            getUsers(2);
            $( "#add_user").addClass( "hidden");
        }else if( this.value == 3){
            getUsers(3);
            $( "#add_user").addClass( "hidden");
        }else if( this.value ==4 ){
            $( "#add_user").removeClass( "hidden");
            $('#user_table').html("<table id='myTable' class='table'<thead><th>Marcar</th><th>Nombre</th><th>Email</th><th>Status</th></thead><tbody></tbody></table>");
        }
});

    var usrs = [];

//funcion para llamar a los users y popular la tabla en base al select. 
function getUsers(sort){
    var route = "/admin/usuarios/sort_usr/" + sort + "" ;

    $.get(route, function(res){

        var code="<table class='table'<thead><th>Marcar</th><th>Nombre</th><th>Email</th><th>Status</th></thead><tbody>";

        for (index = 0; index < res.length; index++){
            code+="<tr><td><input type='checkbox' name='chk' value='" + res[index].id + "' checked></td><td>";
            code+= res[index].name + "</td><td>" + res[index].email + "</td><td>";

            if(res[index].status == 0){ 
                code+="<span class='label label-success'>Ok</span>";
            }else if(res[index].status == 1){
                code+="<span class='label label-danger'>Adeudo</span>";
            }
            code+="</td></tr>";
        }
            code+="</tbody></table>";

        $('#user_table').html(code);
    });

}

//se llama al user por medio de su id y se agrega a la tabla. 
function add(){
    var route = "/admin/usuarios/add/" + id_usuario + "" ;
    var code='';

    $.get(route, function(res){

        code+="<tr><td><input type='checkbox' name='chk' value='" + res[0].id + "' checked></td><td>";
        code+= res[0].name + "</td><td>" + res[0].email + "</td><td>";

            if(res[0].status == 0){ 
                code+="<span class='label label-success'>Ok</span>";
            }else if(res[0].status == 1){
                code+="<span class='label label-danger'>Adeudo</span>";
            }
            code+="</td></tr>";

            $('#myTable > tbody:last-child').append(code);
    });
}

//se llama la funcion para llenar la tabla con todos los users. 
$(document).ready(function() { 
    getUsers(1);
});

//aqui se checan los checkboxes y si estan marcados el id del user se agrega al array.
//el array esta listo para mandarse y enviar mails.  
$("#btn_send").click(function(){

    $("#msj-success-email").addClass( "hide");
    $("#msj-fail-email").addClass( "hide");

    var usrs = [];
    var index=0;
    var $boxes = $('input[name=chk]:checked');
    var i=0;
        $boxes.each(function(){
            usrs[i] = this.value;
            i++;
        });

    if( tipo == 1){
        console.log('mensaje');
            var msg = $("#txt_msg").val();
            var subj = $("#txt_subj").val();

                    jQuery.each( usrs, function() { 
                        var route = "/sendEmailMsg/" + usrs[index];
                        var token = $("#token_send").val();
                            $.ajax({
                                url: route,
                                headers: {'X-CSRF-TOKEN': token},
                                type: 'GET',
                                dataType: 'json',
                                data:{
                                    msg:msg,
                                    subj:subj
                                },
                                success:function(){
                                    console.log('ok');
                                    $("#msj-success-email").removeClass( "hide");
                                },
                                error: function (jqXHR, exception) {
                                    console.log('nope');
                                    $("#msj-fail-email").removeClass( "hide");
                                }
                            });
                                console.log(usrs[index]);
                                index++;
                        });
    }else if( tipo == 2){
        console.log('Corte');
            jQuery.each( usrs, function() { 
                    var route = "/sendEmail/" + usrs[index];
                    var token = $("#token_send").val();
                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'GET',
                        dataType: 'json',
                        success:function(){
                            console.log('ok');
                            $("#msj-success-email").removeClass( "hide")
                        },
                        error: function (jqXHR, exception) {
                            console.log('nope');
                            $("#msj-fail-email").removeClass( "hide");
                        }
                    });
                        console.log(usrs[index]);
                        index++;
                }); 
    }else{
        console.log('adeudo');
    }
 /*          
    var msg = $("#txt_msg").val();
    var subj = $("#txt_subj").val();

            jQuery.each( usrs, function() { 
                var route = "/sendEmailMsg/" + usrs[index];
                var token = $("#token_send").val();
                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'GET',
                        dataType: 'json',
                        data:{
                            msg:msg,
                            subj:subj
                        },
                        success:function(){
                            console.log('ok');
                            $("#msj-success-email").removeClass( "hide");
                        },
                        error: function (jqXHR, exception) {
                            console.log('nope');
                            $("#msj-fail-email").removeClass( "hide");
                        }
                    });
                        console.log(usrs[index]);
                        index++;
                });
    //}

    /*
        console.log('corte');
        jQuery.each( usrs, function() { 
                var route = "/sendEmail/" + usrs[index];
                var token = $("#token_send").val();
                $.ajax({
                    url: route,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'GET',
                    dataType: 'json',
                    success:function(){
                        console.log('ok');
                    },
                    error: function (jqXHR, exception) {
                        console.log('nope');
                    }
                });
                    console.log(usrs[index]);
                    index++;
            }); 
    */

    

});
