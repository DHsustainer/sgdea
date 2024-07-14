!function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples 
    SweetAlert.prototype.init = function() {
        
        //Basic
        $('#sa-basic').click(function(){
            swal($("#titulo_alerta").html());
        });

        //A title with a text under
        $('#sa-title').click(function(){
            swal($("#titulo_alerta").html(), $("#sub_titulo_alerta").html())
        });

        //Success Message
        $('#sa-success').click(function(){
            swal($("#titulo_alerta").html(), $("#sub_titulo_alerta").html(), "success")
        });

        //Error
        $('#sa-error').click(function(){
            swal($("#titulo_alerta").html(), $("#sub_titulo_alerta").html(), "error")
        });

        //Warning Message
        $('#sa-warning').click(function(){
            swal({   
                title: "Estas seguro?",   
                text: $("#titulo_alerta").html(),   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Si, Continuar!",
                cancelButtonText: "Cencelar",   
                closeOnConfirm: true 
            }, function(){   
                $("#sub_titulo_alerta").html("true")
                //swal("Ok!", "Your imaginary file has been deleted.", "success"); 
            });
        });


        //Warning Message
        $('#sa-warning2').click(function(){
            swal({   
                title: "Completa tu perfil!",   
                text: "Su perfil de usuario, se encuentra incompleto, si desea que en sus citatorios aparezca su firma y datos oficiales completa tu perfil aqui",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Completar Perfil!",
                cancelButtonText: "No, Completar Despues",   
                closeOnConfirm: true 
            }, function(){  
                window.location.href = '/dashboard/profile/';
            });
        });

    

    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);