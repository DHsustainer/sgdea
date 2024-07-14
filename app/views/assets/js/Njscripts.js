$(document).ready(function(){
    $('input').attr('autocomplete','off');
    $("#cerrar").click(function(){
        $("#mascara_registro").fadeOut("slow");
        //$("#contenido_bloque").html("");        
    });
    $("#cerrar_preload").click(function() {
        $("#preloader_mask").fadeOut("fast");
        $(document).ajaxStop();
    });
})

function BuscarElementoAyudaId(){
  if($('#id_busqueda_elemento').val() <= 0){
    alert('Ingrese id del elemento');
  }
  LoadModal('medium', 'Editar Articulo', '/ayuda_elementos/editar/'+$('#id_busqueda_elemento').val()+'/');
  $('#id_busqueda_elemento').val('');
}

function LoadModal(modal,  titulo, enlace){

   if (modal == "large") {
      $("#myLargeModalLabel").html(titulo);
   }else{
      $("#myRegularModalLabel").html(titulo);
   }

   $.ajax({
      type: 'POST',
      url: enlace,
      success:function(msg){
          if (modal == "large") {
              $("#myLargeModalBody").html(msg);
              $("#mylargemodalbtn").click();
          }else{
              $("#myRegularModalBody").html(msg);
              $("#myregularmodalbtn").click();
          }
          $('input').attr('autocomplete','off');
       }
   });
}

function LoadHModal(modal,  titulo){


      $("#myXLargeModalLabel").html(titulo);
      $("#myXLargeModalBody").html("");
      $("#myXlargemodalbtn").click();


}

function CargarDiv(div, enlace){
   $.ajax({
      type: 'POST',
      url: enlace,
      success:function(msg){
         $("#"+div).html(msg);
      }
   });
}
///Alert2("Hola");
function Alert2(tit, subt, stat){


swal({   
                title: tit,   
                text: subt,
                type: stat,
            });
/*
    $("#titulo_alerta").html(tit)
    $("#sub_titulo_alerta").html(subt)

    switch(stat) {
        case "basic":
            $('#sa-basic').click();
            break;
        case "title":
            $('#sa-title').click();
            break;
        case "success":
            $('#sa-success').click();
            break;
        case "error":
            $('#sa-error').click();
            break;
        default:
            $('#sa-basic').click();
    }    */
}
function Confirm2(tit){
    $("#titulo_alerta").html(tit)
    $('#sa-warning').click();
    
    if ($("#sub_titulo_alerta").html() == "true") {
      alert("Continuar!!!")
    }
    
}
//Confirm2("Está seguro de eliminar el coso ? ")