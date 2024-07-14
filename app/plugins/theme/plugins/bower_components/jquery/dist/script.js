$(document).ready(function(){
//code
});


function dependencia_item(principal, dependencia, pagina){

    var code = $("#"+principal).val();
    var page = pagina+"/"+code+"/";
    //alert(page)
    $.get(page, { code: code }, function(resultado){
      //  alert(resultado);
        if(resultado == false){
            alert('No se encontraron dependencias de este elemento');
            $("#"+dependencia).attr("disabled",true);
            $("#"+dependencia).addClass("disabled");
            document.getElementById(dependencia).options.length=1;          
        }else{
            $("#"+dependencia).attr("disabled",false);
            $("#"+dependencia).removeClass("disabled");
            document.getElementById(dependencia).options.length=1;
            $('#'+dependencia).append(resultado);           
        }
    }); 
}

function PanelOSX(dir, titulo){
    Seturl = "/"+dir+"/";
    $.ajax({
        type: "POST",
        url: Seturl,
        success:function(msg){
            result = msg;
            $("#myLargeModalLabel").html(titulo);
            $(".modal-body").html(result);
            $(".open-modal-window").click();

        }
    });
}


function Getajax(pag, who){

    var URL = '/'+pag+'/';
    $.ajax({
        type: 'POST',
        url: URL,
        success: function(msg){
            $("#"+who).html(msg);
        }
    });
}

function SetStatusTicket(st, tid, actvk){
    var URL = '/ticket/setstatus/'+tid+'/';
    var str = "ACTIVEKEY="+actvk+"&status="+st;
    $.ajax({
        type: 'POST',
        url: URL,
        data: str,
        success: function(msg){
            if (msg == "1") {
                window.location.reload()
            }else{
                Myalert("Error al actualizar el Ticket. "+msg);
            }
        }
    });
}