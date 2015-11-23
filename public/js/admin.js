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

    var dato1 = $("#id_user").val();
    var dato2 = $("#datepicker").val();
    var dato3 = $("#amount").val();
    var dato4 = $("#status").val();
   
    console.log(dato1);
    console.log(dato2);
    console.log(dato3);
    console.log(dato4);

    var route = "../pagos";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{id_user: dato1, date: dato2, amount: dato3, status: dato4},

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

    $("#msj-success").addClass( "hide");
    $("#msj-fail").addClass( "hide");
    $("#msj-success1").addClass( "hide");
    $("#msj-fail1").addClass( "hide");
    $("#msj-success2").addClass( "hide");
    $("#msj-fail2").addClass( "hide");

    var route = "../pagos/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#id_user_pago").val(res.id_user);
        $("#datepicker_pago").val(res.date);
        $("#amount_pago").val(res.amount);
        $("#status_pago").val(res.status);
        $("#id_pago").val(res.id);
    });
}

$("#actualizar_pago").click(function(){
    $("#msj-success1").addClass( "hide");
    $( "#msj-fail1").addClass( "hide");
    $("#msj-success2").addClass( "hide");
    $( "#msj-fail2").addClass( "hide");
    var dato1 = $("#id_user_pago").val();
    var dato2 = $("#datepicker_pago").val();
    var dato3 = $("#amount_pago").val();
    var dato4 = $("#status_pago").val();
   
    console.log(dato1);
    console.log(dato2);
    console.log(dato3);
    console.log(dato4);

    var value = $("#id_pago").val();
    var route = "../pagos/"+value+"";
    var token = $("#token_pago").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{id_user: dato1, date: dato2, amount: dato3, status: dato4},


        success:function(){
            $("#msj-success1").removeClass( "hide");
            $("#tablaPagos").load(location.href+" #tablaPagos>*","");
            console.log('hell yeah!');
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
        var value = $("#id_pago").val();
        var route = "../pagos/"+value;
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

    var route = "../egresos";
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
    var route = "../egresos/"+btn.value+"/edit";
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
        var route = "../egresos/"+value;
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