$("#registrar").click(function(){
    $("#msj-success4").addClass( "hide");
    $("#msj-fail4").addClass( "hide");
    var dato1 = $("#concept1").val();
    var dato2 = $("#address1").val();
    var dato3 = $("#phone_num1").val();
    var dato4 = $("#category1").val();
    var dato5 = $("#url1").val();
    var route = "/utiles";
    var token = $("#token1").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{concept: dato1, address: dato2, phone_num: dato3, category: dato4, url: dato5},

        success:function(){
             $("#msj-success4").removeClass( "hide");
             $("#tablaUtiles").load(location.href+" #tablaUtiles>*","");
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail4").removeClass( "hide");
            console.log(obj);
            var msj = obj.concept + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/concept/gi, 'Concepto');
            $(".msj").html(res);
        } 
    });
});

function Mostrar(btn){
    $("#msj-success4").addClass( "hide");
    $( "#msj-fail4").addClass( "hide");
    $("#msj-success5").addClass( "hide");
    $( "#msj-fail5").addClass( "hide");
    $("#msj-success6").addClass( "hide");
    $( "#msj-fail6").addClass( "hide");
    var route = "/utiles/"+btn.value+"/edit";
    $.get(route, function(res){
        $("#concept").val(res.concept);
        $("#address").val(res.address);
        $("#phone_num").val(res.phone_num);
        $("#category").val(res.category);
        $("#url").val(res.url);
        $("#id").val(res.id);
    });
}

$("#actualizar").click(function(){
    $("#msj-success5").addClass( "hide");
    $( "#msj-fail5").addClass( "hide");
    $("#msj-success6").addClass( "hide");
    $( "#msj-fail6").addClass( "hide");
    var value = $("#id").val();
    var dato1 = $("#concept").val();
    var dato2 = $("#address").val();
    var dato3 = $("#phone_num").val();
    var dato4 = $("#category").val();
    var dato5 = $("#url").val();

    var route = "/utiles/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{concept: dato1, address: dato2, phone_num: dato3, category: dato4, url: dato5},

        success:function(){
            $("#msj-success5").removeClass( "hide");
            $("#tablaUtiles").load(location.href+" #tablaUtiles>*","");
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail5").removeClass( "hide");
            console.log(obj);
            var msj = obj.concept + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/concept/gi, 'Concepto');
            $(".msj").html(res);
        } 

    });
});

$("#eliminar").click(function(){
    $("#msj-success5").addClass( "hide");
    $( "#msj-fail5").addClass( "hide");
    $("#msj-success6").addClass( "hide");
    $( "#msj-fail6").addClass( "hide");
    var value = $("#id").val();
    var route = "/utiles/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success:function(){
            $("#msj-success6").removeClass( "hide");
            $("#tablaUtiles").load(location.href+" #tablaUtiles>*","");
        },
        error: function (jqXHR, exception) {
            $( "#msj-fail6").removeClass( "hide");
        } 

    });
});


var file_noti;

function Mostrar_noticia(btn){
    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");
    $("#msj-success1").addClass( "hide");
    $( "#msj-fail1").addClass( "hide");
    $("#msj-success2").addClass( "hide");
    $( "#msj-fail2").addClass( "hide");
    var route = "/noticia/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#titulo1").val(res.titulo);
        $("#contenido1").val(res.texto);
        file_noti = res.path;
        $("#id_noti_1").val(res.id);
    });
}


$("#registrar_noticia").on("submit", function(e){
    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");
    e.preventDefault();
    var fd = new FormData(this);

    var route = "/noticia";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: fd,
        contentType: false,
        processData: false,

        success:function(){
            $("#msj-success").removeClass( "hide");
            $("#tablaNoticias").load(location.href+" #tablaNoticias>*","");
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            console.log(obj);
            var msj = obj.titulo + '<br>' + obj.texto + '<br>' + obj.path + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/titulo/gi, 'Titulo');
            var res = res.replace(/texto/gi, 'Contenido');
            var res = res.replace(/path/gi, 'Imagen');
            $(".msj").html(res);
        }
    });

});

$("#actualizar_noticia").on("submit", function(e){
    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");
    e.preventDefault();
    var formData = new FormData(this);

    var value = $("#id_noti_1").val();
    var dato1 = $("#titulo1").val();
    var dato2 = $("#contenido1").val();
    var dato3 = $("#path1").val();
    console.log(dato3);
    console.log("file_noti:" + file_noti);

    var route = "/noticia/"+value+"";
    var token = $("#token_noti_1").val();

    if(dato3 == ""){
        dato3 = file_noti;
    }

    console.log(dato3);

    //formData.append('path', dato3);

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:formData,
        contentType: false,
        processData: false,

        success:function(){
            $("#msj-success1").removeClass( "hide");
            $("#tablaNoticias").load(location.href+" #tablaNoticias>*","");
            console.log('hell yeah!');
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail1").removeClass( "hide");
            console.log(obj);
            var msj = obj.titulo + '<br>' + obj.texto + '<br>' + obj.path + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
            var res = res.replace(/titulo/gi, 'Titulo');
            var res = res.replace(/texto/gi, 'Contenido');
            var res = res.replace(/path/gi, 'Imagen');
            $(".msj").html(res);
        }
    });

});


$("#eliminar_noticia").click(function(){
    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");
    if (confirm("Eliminar esta Noticia?") == true) {
        var value = $("#id_noti_1").val();
        var route = "/noticia/"+value;
        var token = $("#token_noti_1").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
            $("#msj-success2").removeClass( "hide");
            $("#tablaNoticias").load(location.href+" #tablaNoticias>*","");
            },
            error: function (jqXHR, exception) {
            $( "#msj-fail2").removeClass( "hide");
            }
        });
    } else {
    } 
});


var file_sitio;


function Mostrar_sitio(btn){
    $("#msj-success_sitio").addClass( "hide");
    $( "#msj-fail_sitio").addClass( "hide");
    $("#msj-success2_sitio").addClass( "hide");
    $( "#msj-fail2_sitio").addClass( "hide");

    var route = "/sitio/"+btn.value+"/edit";

    $.get(route, function(res){
        $("#name_frac").val(res.name);
        $("#path_sitio").val(res.picture);

    });
}



$("#actualizar_sitio").on("submit", function(e){
    $("#msj-success_sitio").addClass( "hide");
    $( "#msj-fail_sitio").addClass( "hide");
    e.preventDefault();
    var formData = new FormData(this);

    var value = 1;
    var dato1 = $("#name_frac").val();
    var dato2 = $("#picture").val();
    var file_sitio = $("#path_sitio").val()
    console.log("dato2: " + dato2);

    var route = "/sitio/"+value+"";
    var token = $("#token_sitio_1").val();

    if(dato2 == ""){
        dato2 = file_sitio;
        console.log('se hizo');
    }

    //formData.append('path', dato3);

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:formData,
        contentType: false,
        processData: false,

        success:function(){
            $("#msj-success_sitio").removeClass( "hide");
            $("#divSitio").load(location.href+" #divSitio>*","");
            console.log('ok');
        },
        error: function () {
            //var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail_sitio").removeClass( "hide");
            console.log('error');
        }
        
    });

});
