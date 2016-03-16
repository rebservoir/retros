var id_usuario;
function get_id_user_pago(id_user){
    id_usuario = id_user;
    console.log('la id_user es:' + id_usuario);
}

function Mostrar(btn){
    $("#msj-success").addClass( "hide");
    $( "#msj-fail").addClass( "hide");
    $("#msj-success1").addClass( "hide");
    $( "#msj-fail1").addClass( "hide");
    $("#msj-success2").addClass( "hide");
    $( "#msj-fail2").addClass( "hide");
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

$( "#email" ).change(function() {
    if(!($(this).val() == '')){
        $("#email_msg").html('');
        $("#react_btn").addClass('hidden');

        var dato = $(this).val();
        var route = "checkEmail/"+dato;

        $.get(route, function(response){
            console.log(response.res);
            if(response.res == '1'){ //load json data from server and output message 
                $("#email_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Este mail ya esta registrado para un usuario activo.</p></div>');
            }else if(response.res == '2'){ //load json data from server and output message 
                $("#email_msg").html('<div class="alert alert-danger" style="padding: 5px;"><p>Un usuario con este email fue eliminado anteriormente</p></div>');
                $("#react_btn").removeClass('hidden');
                $("#react_btn").val(response.id_user);
            }else if(response.res == '3'){
                $("#email_msg").html('<div class="alert alert-success" style="padding: 5px;"><p>Email sin registrar.</p></div>');
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
                $("#email_msg").html('<div class="alert alert-success" style="padding: 5px;"><p>El usuario se encuentra activo nuevamente.</p></div>');
                $("#react_btn").addClass('hidden');
            }
        });

});

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
        success:function(){
            $("#msj-success").removeClass( "hide");
            $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
            $('#user_create').modal('toggle');
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
            $('#user_create').modal('toggle');
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
            $("#msj-success1").removeClass( "hide");
            $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
            $('#user_edit').modal('toggle');
        },
        error: function (jqXHR, exception) {
            var obj = jQuery.parseJSON(jqXHR.responseText);
            $("#msj-fail1").removeClass( "hide");
            var msj = obj.name + '<br>' + obj.email + '<br>' + obj.password + '<br>' + obj.address + '<br>';
            var res = msj.replace(/undefined<br>/gi, '');
             var res = res.replace(/name/gi, 'Nombre');
              var res = res.replace(/address/gi, 'Dirección');
              var res = res.replace(/email/gi, 'Email');
            $(".msj").html(res);
            $('#user_edit').modal('toggle');
        }

    });
});


$("#eliminar").click(function(){

    var value = $("#id1").val();
    var route = "/usuario/"+value+"";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success:function(){
            $("#msj-success2").removeClass( "hide");
            $("#tablaUsuarios").load(location.href+" #tablaUsuarios>*","");
            $('#user_edit').modal('toggle');
        }
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