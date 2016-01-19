
    var index=0;
    var idx = 0;
    var pagos = [];
    var id_user=0;
    var lng;



$("#actualizar_pago").click(function(){

    id_user = $("#id_user").val();

    var route = "/pagos_show/";

    $.get(route, function(res){
        
        console.log("res" + res.length);
        lng = res.length;
        console.log("lng:" + lng);
    
        id_user = res.id_user;

        for (index = 0; index < res.length; index++) {
            pagos[index] = res[index].id;
            console.log( pagos[index] );
        }

        update();

    });

});



function update(){

    for (idx = 0; idx < lng; idx++){

        var route = "/pagos/" + pagos[idx] + "";    
        var token = $("#token").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data:{status: 1},

            success:function(){
                console.log('yeah');
                $("#int_div3").load(location.href+" #int_div3>*","");
            },
             error: function (jqXHR, exception) {
                console.log('nop');
                var obj = jQuery.parseJSON(jqXHR.responseText);
            } 

        });
    }

}


function registrar_pagos($cont){

    if($cont==1){
        modal = '#mensual';
    }else if($cont==6){
        modal = '#semestral';
    }else{
        modal = '#anual';
    }

    id_user = $("#id_user").val();
    var date = $("#begin_date").val();

    var res = date.split("-");

    var year = parseInt(res[0]);
    var mes = parseInt(res[1]) + 1;
    var dia = parseInt(res[2]);
   
    var amount = $("#amount").val();
    var user_name = $("#user_name").val();
    var status = 1;


    if(mes==13){
        mes=1;
        year++;
    }

    var route = "/pagos";
    var token = $("#token").val();

    for (x = 0; x < $cont; x++){

        if(mes<10){
            date = year + "-0" + mes + "-15"; 
        }
        else{
            date = year + "-" + mes + "-15";
        }

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{id_user: id_user, date: date, amount: amount, status: status, user_name: user_name},

        success:function(){
            console.log('pagos realizados');    
            $("#cuenta_pago").load(location.href+" #cuenta_pago>*","");
            //$("#mensual").load(location.href+" #mensual>*","");

            if((x+1)==$cont){
                $(modal).modal('toggle');
            }
        },
         error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            console.log(obj);
        } 
    });

        mes++;

        if(mes==13){
            mes=1;
            year++;
        }
    }
}




$("#mensual_pago").click(function(){
   registrar_pagos(1);
});
$("#semestral_pago").click(function(){
   registrar_pagos(6);
});
$("#anual_pago").click(function(){
   registrar_pagos(12);
});





