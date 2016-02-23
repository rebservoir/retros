
$("#btn_cal").click(function(){

    var myYear = document.getElementById('year_select').value;
    var myMonth = document.getElementById('month_select').value;
   
    if(myMonth<10){
        myMonth = "0" + myMonth;
    }

    var route = "/calendario/" +  myMonth + '/' + myYear;
    window.location.assign(route);

    //getEvents(myYear,myMonth);
});


$("#btn_cal_admin").click(function(){

    var myYear = document.getElementById('year_select').value;
    var myMonth = document.getElementById('month_select').value;
   
    if(myMonth<10){
        myMonth = "0" + myMonth;
    }

    var route = "/admin/calendario/" +  myMonth + '/' + myYear;
    window.location.assign(route);
});


function calendar(date){
        $('#calendar').fullCalendar({
            defaultDate: date,
            editable: false,
            lang: 'es',
            eventLimit: true, // allow "more" link when too many events
            events: eventos
        });
}


$(function() {
    $( "#datepicker_start" ).datepicker();
    $( "#datepicker_start" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_start1" ).datepicker();
    $( "#datepicker_start1" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_end" ).datepicker();
    $( "#datepicker_end" ).datepicker("option", "dateFormat", "yy-mm-dd");

    $( "#datepicker_end1" ).datepicker();
    $( "#datepicker_end1" ).datepicker("option", "dateFormat", "yy-mm-dd");
});



function Mostrar_evento(btn){

    console.log('Mostrar_evento');

    var route = "/calendario/"+btn.value+"/edit";

    $.get(route, function(res){
        console.log(res);
        $("#ev_title").val(res.title);
        $("#datepicker_start1").val(res.start);
        $("#datepicker_end1").val(res.end);
        $("#evento_id").val(res.id);
    });
}


$("#registrar_evento").on("submit", function(e){
    //$("#msj-success").addClass( "hide");
    //$( "#msj-fail").addClass( "hide");
    e.preventDefault();

    var dato1 = $("#title").val();
    var dato2 = $("#datepicker_start").val();
    var dato3 = $("#datepicker_end").val();

    var route = "/calendario";
    var token = $("#token_evento").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{title: dato1, start: dato2, end: dato3},
        contentType: false,
        processData: false,

        success:function(){
            //$("#msj-success").removeClass( "hide");
            $("#tablaEventos").load(location.href+" #tablaeventos>*","");
            $('#eventos_create').modal('toggle');
        },
        error: function (jqXHR, exception) {
            //var obj = jQuery.parseJSON(jqXHR.responseText);
            //$("#msj-fail").removeClass( "hide");
            //var msj = obj.titulo + '<br>' + obj.texto + '<br>' + obj.path + '<br>';
            //var res = msj.replace(/undefined<br>/gi, '');
            //var res = res.replace(/titulo/gi, 'Titulo');
            //var res = res.replace(/texto/gi, 'Contenido');
            //var res = res.replace(/path/gi, 'Imagen');
            //$(".msj").html(res);
            $('#eventos_create').modal('toggle');
        }
    });

});