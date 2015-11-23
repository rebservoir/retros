var id_usuario,id_actual;
var user_name;
var id_usuario_actual;


function get_id_user_pago(id_user){
    id_usuario = id_user;
    console.log('la id_user es:' + id_usuario);
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


$("#registrar_pago").click(function(){

    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");

    var dato1 = id_usuario;
    console.log('agarro la ' + dato1);
    var dato2 = $("#datepicker").val();
    var dato3 = $("#amount").val();
    var dato4 = $("#status").val();
    var dato5 = $('#search-input').val();
   
    console.log(dato1);
    console.log(dato2);
    console.log(dato3);
    console.log(dato4);
    console.log(dato5);

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
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            console.log(obj);
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
        console.log(res);
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
    $( "#msj-fail1").addClass( "hide");
    $("#msj-success2").addClass( "hide");
    $( "#msj-fail2").addClass( "hide");
    
    var dato1 = $("#hidden_id_user").val();
    var dato2 = $("#datepicker_pago").val();
    var dato3 = $("#amount_pago").val();
    var dato4 = $("#status_pago").val();
    var dato5 = $("#search-input2").val();
    var value = $("#hidden_id").val();

    console.log(dato1);
    console.log(dato2);
    console.log(dato3);
    console.log(dato4);
    console.log(dato5);
    console.log(value);

    if(id_usuario!=''){
        if(dato1!=id_usuario){
            dato1 = id_usuario;
        }
    }

    console.log('dato5:' + dato5);
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
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail1").removeClass( "hide");
            console.log(obj);
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
}

$("#eliminar_egresos").click(function(){
    if (confirm("Eliminar este egreso?") == true) {
        var value = $("#id_egresos").val();
        var route = "/egresos/"+value;
        var token = $("#token_eg").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
            $("#msj-success5").removeClass( "hide");
            $("#tablaEgresos").load(location.href+" #tablaEgresos>*","");
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
        console.log(names[index]);
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