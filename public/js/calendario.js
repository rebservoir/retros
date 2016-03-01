
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


function mostrar_evento(btn){
    
    $("#msj-fail").addClass( "hide");

    var route = "/eventos/"+ btn.value;

    $.get(route, function(res){
        $('#ev_title1').val(res.title);
        $("#datepicker_start1").val(res.start);
        $("#datepicker_end1").val(res.end);
        $("#evento_id").val(res.id);
    });
}


$("#registrar_evento").click(function(){

    $("#msj-fail").addClass( "hide");

    var dato1 = $("#ev_title").val();
    var dato2 = $("#datepicker_start").val();
    var dato3 = $("#datepicker_end").val();
    var route = "/eventos";
    var token = $("#token_evento").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{title: dato1, start: dato2, end: dato3},
        success:function(){
            window.location.reload();
        },
        error: function (jqXHR, exception) {
            $('#eventos_create').modal('toggle');
            $("#msj-fail").removeClass( "hide");
        }
    });
});


$("#actualizar_evento").click(function(){

    var value = $("#evento_id").val();
    var dato1 = $("#ev_title1").val();
    var dato2 = $("#datepicker_start1").val();
    var dato3 = $("#datepicker_end1").val();

    var route = "/eventos/" + value;
    var token = $("#token_evento").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data:{title: dato1, start: dato2, end: dato3},
        success:function(){
            //$("#msj-success1").removeClass( "hide");
            $("#tablaEventos").load(location.href+" #tablaEventos>*","");
            $('#eventos_edit').modal('toggle');
            window.location.reload();
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail").removeClass( "hide");
            $('#eventos_edit').modal('toggle');
        } 
    });
});

$("#eliminar_evento").click(function(){

    if (confirm("Eliminar este Evento?") == true){

        var value = $("#evento_id").val();
        var route = "/eventos/"+value;
        var token = $("#token_evento").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success:function(){
            //$("#msj-success2").removeClass( "hide");
            //$("#tablaPagos").load(location.href+" #tablaPagos>*","");
            window.location.reload();
            },
            error: function (jqXHR, exception) {
                $("#msj-fail").removeClass( "hide");
            } 
        });
    } else {
    } 
});