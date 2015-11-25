
//internas
var current_li = "#int_l1";
var current_div = "#int_div1";

function Toogle(x,y){
    $( current_li ).removeClass( "left_sel" );
    $( current_div).css("display", "none"); 
    current_li=x;
    current_div = y;
    $( current_li ).addClass( "left_sel" );
    $( current_div ).css("display", "inline");    
}


$( "#int_l1" ).on( "click", function() {
    Toogle("#int_l1","#int_div1");
});
$( "#int_l2" ).on( "click", function() {
    Toogle("#int_l2","#int_div2");
});
$( "#int_l3" ).on( "click", function() {
    Toogle("#int_l3","#int_div3");
});
$( "#int_l4" ).on( "click", function() {
    Toogle("#int_l4","#int_div4");
});
$( "#int_l5" ).on( "click", function() {
    Toogle("#int_l5","#int_div5");
});
$( "#int_l6" ).on( "click", function() {
    Toogle("#int_l6","#int_div6");
});
$( "#int_l7" ).on( "click", function() {
    Toogle("#int_l7","#int_div7");
});


//TABS
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});


//AJAX PAGINATE

/*

$(document).on('click', '.pagination a',function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var route = "http://localhost:8080/laravel5_1/public/noticias";

    $.ajax({
        url: route,
        data: {page: page},
        type: 'GET',
        dataType: 'json',
        success: function(data){
           // $(".noticias").html(data);
           console.log(page);
        }
    });

});

*/


$(document).ready(function() {

    $("#submit_btn").click(function() { 
       
        var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields       
        $("#form input[required=true], #form textarea[required=true]").each(function(){
            $(this).css('border-color',''); 
            if(!$.trim($(this).val())){ //if this field is empty 
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag
            }
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag              
            }   
        });
       
        if(proceed) //everything looks good! proceed...
        {
            //get input field values data to be sent to server
            post_data = {
                'name'     : $('input[name=name]').val(), 
                'email'    : $('input[name=email]').val(),
                'subject'       : 'Contacto', 
                'msg'           : $('textarea[name=msg]').val()
            };
            
            var formMessages = $('#form_msg');  
            
            //Ajax post data to server
            $.post('contacto.php', post_data, function(response){  
                if(response.type == 'mail'){ //load json data from server and output message 
                    $(formMessages).removeClass('verde');
                    $(formMessages).addClass('rojo');
                    $(formMessages).text('Introduzca un email valido.');
                }else if(response.type == 'error'){ //load json data from server and output message 
                    $(formMessages).removeClass('verde');
                    $(formMessages).addClass('rojo');
                    $(formMessages).text('Hubo un error. Intentelo de nuevo.');
                }else if(response.type == 'message'){
                    $(formMessages).removeClass('rojo');
                    $(formMessages).addClass('verde');
                    $(formMessages).text('Mensaje enviado. Gracias.');
                    //reset values in all input fields
                    $("#contact_form  input[required=true], #contact_form textarea[required=true]").val(''); 
                }
            }, 'json');
        }
    });
    
});






