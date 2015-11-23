function Mostrar(btn){
    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");
    var route = "../usuario/"+btn.value+"/edit";
    $.get(route, function(res){
        $("#name1").val(res.name);
        $("#email1").val(res.email);
        $("#address1").val(res.address);
        $("#phone1").val(res.phone);
        $("#cel1").val(res.celphone);
        $("#role1").val(res.role);
        $("#id1").val(res.id);
    });
}

$("#registrar").click(function(){
    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");
    var value = $("#id").val();
    var dato1 = $("#name").val();
    var dato2 = $("#email").val();
    var dato3 = $("#address").val();
    var dato4 = $("#phone").val();
    var dato5 = $("#cel").val();
    var dato6 = $("#role").val();
    var dato7 = $("#password").val();

    var route = "../usuario";
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
            password:   dato7
        },
        success:function(){
            $("#msj-success").removeClass( "hide");
            $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
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
            $(".msj").html(res);
        }              
    });
});

$("#actualizar").click(function(){

    $("#msj-success1").addClass( "hide");
    $( "#msj-fail1").addClass( "hide");

    var value = $("#id1").val();
    var dato1 = $("#name1").val();
    var dato2 = $("#email1").val();
    var dato3 = $("#address1").val();
    var dato4 = $("#phone1").val();
    var dato5 = $("#cel1").val();
    var dato6 = $("#role1").val();


    var route = "../usuario/"+value+"";
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
            role:       dato6
        },

        success:function(){
            $("#msj-success1").removeClass( "hide");
            $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail1").removeClass( "hide");
            var msj = obj.name + '<br>' + obj.email + '<br>' + obj.password + '<br>' + obj.address + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
             var res = res.replace(/name/gi, 'Nombre');
              var res = res.replace(/address/gi, 'Dirección');
              var res = res.replace(/email/gi, 'Email');
              var res = res.replace(/password/gi, 'Password');
            $(".msj").html(res);
        }

    });
});


$("#eliminar").click(function(){

    var value = $("#id1").val();
    var route = "../usuario/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success:function(){
            $("#msj-success2").removeClass( "hide");
            $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
        }
    });
});



