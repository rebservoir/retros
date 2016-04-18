
function hide_alert(){
    $("#msj-success").addClass("hide");
    $("#msj-fail").addClass("hide");
    $("#alert-success").addClass("hide");
}

function hide_btn(){
    $(".btn_go").addClass("hide");
    $(".procesando").removeClass("hide");
}

function hide_btn2(){
    $(".procesando").addClass("hide");
    $(".btn_go").removeClass("hide");
}

var id_usuario;
function get_id_user_pago(id_user){
    id_usuario = id_user;
    console.log('la id_user es:' + id_usuario);
}

function Mostrar(btn){

    hide_alert();

    var route = "/usuario/"+btn.value+"/edit";
    $.get(route, function(res){
        $("#name1").val(res.name);
        $("#email1").val(res.email);
        $("#address1").val(res.address);
        $("#phone1").val(res.phone);
        $("#cel1").val(res.celphone);
        $("#role1").val(res.role);
        $("#id1").val(res.id);
        $("#type1").val(res.type);
    });
}

function loadData(){

    var route = "/load";
    $.get(route, function(res){
        console.log(res);
    });
}

 $("#load_data").on("submit", function(e){
    console.log('carga');

    hide_alert();
    e.preventDefault();
    var fd = new FormData(this);

    var route = "/load";
    var token = $("#token_load").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: fd,
        contentType: false,
        processData: false,

        success:function(){

        },
        error: function (jqXHR, exception) {
        }    
    });
});


function detalle_pagos(btn){

    $('#tab-content').html("");
    hide_alert();
    $pagos = [];
    var JSONObject='';
    var s_year='';
    var year='';
    var years = [];
    var n=0;
    var str='',str2='',str3='';
    meses = ["x","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    var route = "/detalle_pagos/"+btn.value;

    $.get(route, function(res){

        str+="<table class='table table-condensed'><tbody><tr><td><strong>Cliente:</strong></td><td>"+ res[0].user_name +"</td></tr></tbody></table><br><br>";
        
        year = (res[0].date).split('-');
        save = year[0];
        years[n] = save;
        n++;
        for(index = 0; index < res.length; index++){
            year = (res[index].date).split('-');
            if(save !== year[0]){
                save = year[0];
                years[n] = save;
                n++
            }
        }
        
        str += "<ul class='nav nav-tabs'>"; // ul years
        str2 += "<div class='tab-content'>"; // tab years
        for(j=0;j<years.length;j++){
            str+= "<li><a href='#" + years[j] + "' data-toggle='pill'>" + years[j] + "</a></li>"; // li years
            str2+= "<div id='" + years[j] + "' class='tab-pane fade'>"; // divs years
            str2+="<ul class='nav nav-pills'>"; // ul months

            for(index = 0; index < res.length; index++){
                year = (res[index].date).split('-');
                if(years[j] == year[0]){
                    // li months
                    if(res[index].status == 0){
                        str2+="<li><a class='adeudo' href='#" + meses[parseInt(year[1])] + year[0] + "' data-toggle='pill'>" + meses[parseInt(year[1])] + "</a></li>";
                    }else if(res[index].status == 1){
                        str2+="<li><a class='saldado' href='#" + meses[parseInt(year[1])] + year[0] + "' data-toggle='pill'>" + meses[parseInt(year[1])] + "</a></li>";
                    }
                    str3+= "<div id='" + meses[parseInt(year[1])] + year[0] + "' class='tab-pane fade'>"; // divs months
                    str3+="<br><table class='table table-condensed'><thead><tr><th>Fecha</th><th>Importe</th><th>Status</th></tr></thead><tbody><tr><td><p>";
                    str3+= year[2]+"-"+meses[parseInt(year[1])]+"-"+year[0]+"</p></td><td><p>$"+res[index].amount+".00</p></td><td>";
                    if(res[index].status == 0){
                        str3+="<span class='label label-danger'>Adeudo</span>"; 
                    }else if(res[index].status == 1){
                        str3+="<span class='label label-success'>Saldado</span>";
                    }
                    str3+="</td></tr></tbody></table></div>";
                }
            }

            str2+="</ul><div class='tab-content'>"; // end ul months
            str3+="</div>";
            str2+=str3;
            str3='';
            str2+="</div>"; // end tab-pane
        }
        str += "</ul>"; // end ul years
        str2+="</div>"; // end tab-content

        $('#tab-content').html(str + str2);
    });
                                                    
}

$( "#email" ).change(function() {
    if(!($(this).val() == '')){
        $("#email_msg").html('');
        $("#react_btn").addClass('hidden');

        var dato = $(this).val();
        var route = "checkEmail/"+dato;

        $.get(route, function(response){
            console.log(response.res);
            if(response.res == '1'){ 
                $("#email_msg").html('<div class="alert alert-success" style="padding: 5px;"><p>Email sin registrar.</p></div>');
            }else if(response.res == '2'){ 
                $("#email_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Este email ya esta registrado para un usuario de este sitio.</p></div>');
            }else if(response.res == '3'){
                $("#email_msg").html('<div class="alert alert-warning" style="padding: 5px;"><p>Existe un usuario registrado con este email para otro sitio en Bill Box, desea asignar este sitio al usuario? Si/No</p></div>');
                $("#asignar_btn").removeClass('hidden');
                $("#asignar_btn").val(response.id_user);
            }else if(response.res == '4'){
                $("#email_msg").html('<div class="alert alert-warning" style="padding: 5px;"><p>Un usuario con este email existia anteriormente para otro sitio en Bill Box. Desea reactivarlo y asignarlo a este sitio? </p></div>');
                $("#react_btn").removeClass('hidden');
                $("#react_btn").val(response.id_user);
            }else if(response.res == '5'){
                $("#email_msg").html('<div class="alert alert-warning" style="padding: 5px;"><p>Un usuario con este email existia anteriormente para este sitio. desea reactivarlo? </p></div>');
                $("#react_btn").removeClass('hidden');
                $("#react_btn").val(response.id_user);
            }
        });
    }
});

$("#react_btn").click(function(){
    console.log('reactivar');

    var dato = $(this).val();
    var route = "reactivar/"+dato;

        $.get(route, function(response){
            if(response.res == 'ok'){ //load json data from server and output message 
                $("#msj-success").removeClass("hide");
                $("#msj-success").html('<p>El usuario se encuentra activo nuevamente.</p>');
                $("#react_btn").addClass('hidden');
                $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
                $("#divSitio").load(location.href+" #divSitio>*","");
                $('#user_create').modal('toggle');
            }else if(response.res == 'fail'){ //load json data from server and output message
                $("#msj-fail").removeClass("hide"); 
                $("#msj-fail").html('<p>Limite alcanzado. No se pueden crear más usuarios.</p>');
                $("#react_btn").addClass('hidden');
                $('#user_create').modal('toggle');
            }
        });
});

$("#asignar_btn").click(function(){

    var dato = $(this).val();
    var route = "asignar/"+dato;

        $.get(route, function(response){
            if(response.res == 'ok'){ //load json data from server and output message 
                $("#msj-success").removeClass("hide");
                $("#msj-success").html('<p>El usuario se encuentra activo para este sitio.</p>');
                $("#react_btn").addClass('hidden');
                $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
                $("#divSitio").load(location.href+" #divSitio>*","");
                $('#user_create').modal('toggle');
            }else if(response.res == 'fail'){ //load json data from server and output message
                $("#msj-fail").removeClass("hide"); 
                $("#msj-fail").html('<p>Limite alcanzado. No se pueden crear más usuarios.</p>');
                $("#react_btn").addClass('hidden');
                $('#user_create').modal('toggle');
            }
        });
});

$("#registrar").click(function(){

    hide_alert();

    var value = $("#id").val();
    var dato1 = $("#name").val();
    var dato2 = $("#email").val();
    var dato3 = $("#address").val();
    var dato4 = $("#phone").val();
    var dato5 = $("#cel").val();
    var dato6 = $("#role").val();
    var dato7 = $("#password").val();
    var dato8 = $("#type").val();

    var route = "/usuario";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{
            name:       dato1, 
            email:      dato2, 
            address:    dato3, 
            phone:      dato4,
            celphone:   dato5,
            role:       dato6,
            password:   dato7,
            type:       dato8
        },
        success:function(data){
            if(data.tipo=='success'){
                    $("#msj-success").removeClass("hide");
                    $("#msj-success").html(data.message);
                    $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
                    $("#divSitio").load(location.href+" #divSitio>*","");
                    $('#user_create').modal('toggle');
            }else if(data.tipo=='limite'){
                    $("#msj-fail").removeClass( "hide");
                    $("#msj-fail").html(data.message);
                    $('#user_create').modal('toggle');
            } 
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.name + '<br>' + obj.email + '<br>' + obj.password + '<br>' + obj.address + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/name/gi, 'Nombre');
            var res = res.replace(/address/gi, 'Dirección');
            var res = res.replace(/email/gi, 'Email');
            var res = res.replace(/password/gi, 'Password');
            $("#msj-fail").html(res);
            $('#user_create').modal('toggle');
        }              
    });
});

$("#actualizar").click(function(){

    hide_alert();

    var value = $("#id1").val();
    var dato1 = $("#name1").val();
    var dato2 = $("#email1").val();
    var dato3 = $("#address1").val();
    var dato4 = $("#phone1").val();
    var dato5 = $("#cel1").val();
    var dato6 = $("#role1").val();
    var dato7 = $("#type1").val();


    var route = "/usuario/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{
            name:       dato1, 
            email:      dato2, 
            address:    dato3, 
            phone:      dato4,
            celphone:   dato5,
            role:       dato6,
            type:       dato7
        },

        success:function(){
            $("#msj-success").removeClass( "hide");
            $("#msj-success").html("Usuario actualizado exitosamente.");
            $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
            $('#user_edit').modal('toggle');
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            var msj = obj.name + '<br>' + obj.email + '<br>' + obj.password + '<br>' + obj.address + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/name/gi, 'Nombre');
            var res = res.replace(/address/gi, 'Dirección');
            var res = res.replace(/email/gi, 'Email');
            $("#msj-fail").html(res);
            $('#user_edit').modal('toggle');
        }

    });
});


$("#delete_att").click(function(){
    $('#btns_delete').slideUp( "fast", function() {
        console.log('hola');
        $("#btns_confirm").show( "fast" );
    });
});

$("#delete").click(function(){

    hide_alert();

        var value = $("#id1").val();
        var route = "/usuario/"+value+"";
        var token = $("#token").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
                $("#msj-success").removeClass( "hide");
                $("#msj-success").html("Usuario eliminado exitosamente.");
                $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
                $("#divSitio").load(location.href+" #divSitio>*","");
                $('#user_edit').modal('toggle');
            },
            error: function (jqXHR, exception) {
                $("#msj-fail").removeClass("hide");
                $("#msj-fail").html("<p>Intentar de nuevo.</p>");
                $('#user_edit').modal('toggle');
            } 
        });

        $('#btns_confirm').hide( "fast");
        $("#btns_delete").show( "fast" );
});

$("#cancel").click(function(){
    $('#btns_confirm').hide( "fast", function() {
        $("#btns_delete").show( "fast" );
    });
});


var index=0;
var names = [];

$( document ).ready(function() {
 var route = "/usuario/show";
    $.get(route, function(res){
        for (index = 0; index < res.length; index++) {
            names[index] = res[index].name + '/' +res[index].id;
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

function search(){
    var route = "/admin/usuarios/search/" + id_usuario + "" ;
    window.location.assign(route);
}

$( ".select_user" ).change(function() {
    sort(this.value);
});

function sort(sort){
    var route = "/admin/usuarios/sort/" + sort + "" ;
     window.location.assign(route);
}