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


function AbrirResumenDocumento(){
    var iddoc = $("#verresumendocumento").attr("data-role");
    OpenWindow("/gestion_anexos/resumendocumento/"+iddoc+"/");
}
function AbrirDocumento(url, type, title, stype, idb){

    //$("#mascara_registro").fadeIn("fast");
    $("#titulo_bloque_mascara").html(title);
    $("#verresumendocumento").attr("data-role", idb);

    id = $('#mascara_registro');

    //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
    //Set heigth and width to mask to fill up the whole screen
    $('#mascara_registro').css({'width':maskWidth,'height':maskHeight});
    //transition effect     
    $('#mascara_registro').fadeIn(1000);    
    $('#mascara_registro').fadeTo("slow",1);    
    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
    //Set the popup window to center
    $(id).css('top',  winH/2-$(id).height()/2);
    $(id).css('left', winW/2-$(id).width()/2);
    //transition effect
    $(id).fadeIn(2000); 
        var box = $('#mascara_registro');
    //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
    //Set height and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight});
    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
    //Set the popup window to center
    box.css('left', winW/2 - box.width()/2);
    var str = "url="+url+"&type="+type+"&stype="+stype+"&idb="+idb+"&title="+title;
    var URL = '/dashboard/viewfile/';
    $.ajax({
        type: 'POST',
        url: URL,
        data: str,
        success: function(msg){
            result = msg;
            $("#contenido_bloquex").html(result);
            $('input').attr('autocomplete','off');
        }
    }); 
}
function AbrirDocumentoPublico(url, type, title, stype, idb){

    //$("#mascara_registro").fadeIn("fast");
        $("#titulo_bloque_mascara").html(title);
        id = $('#mascara_registro');
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
        //Set heigth and width to mask to fill up the whole screen
        $('#mascara_registro').css({'width':maskWidth,'height':maskHeight});
        //transition effect     
        $('#mascara_registro').fadeIn(1000);    
        $('#mascara_registro').fadeTo("slow",1);    
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
        //Set the popup window to center
        $(id).css('top',  winH/2-$(id).height()/2);
        $(id).css('left', winW/2-$(id).width()/2);
        //transition effect
        $(id).fadeIn(2000); 
            var box = $('#mascara_registro');
            //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
        //Set the popup window to center
        box.css('left', winW/2 - box.width()/2);
        var str = "url="+url+"&type="+type+"&stype="+stype+"&idb="+idb;
        var URL = '/dashboard/viewPublicfile/';
        $.ajax({
    	        type: 'POST',
                url: URL,
                data: str,
                success: function(msg){
        	            result = msg;
                        $("#contenido_bloque").html(result);
                        // Some code here!
                        $('input').attr('autocomplete','off');
                    }
            }); 
    }
    function cargador_box(who, id){
	    $('#cargador_box').slideUp('fast');
        $('#menu_tab > div').removeClass('activa');
        $("#"+who).addClass('activa');
        var URL = '/dependencias/'+who+'/'+id+'/';
        $.ajax({
    	        type: 'POST',
                url: URL,
                success:function(msg){
        	            $('#cargador_box').slideDown('fast');
                        $('#cargador_box').html(msg);
                         var pos = $("#menu_tab").offset().top - 120;
                         $('#content').animate({ scrollTop : pos }, 'slow');
                    }
            });
    }
    function showfiles(show, marker){
    	    //ShowLoader("show");
        $('#menu_tab > div').removeClass('active');
        $("#"+marker).addClass('active');
        $('#cargador_box_upfiles').slideUp('fast');
        //location.replace();
        var URL = show;
        $.ajax({
    	        type: 'POST',
                url: URL,
                success: function(msg){
        	            result = msg;
                        $('#cargador_box_upfiles').html(result);
                        $('#cargador_box_upfiles').slideDown('fast');
                        // Some code here!
            //                var pos = $("#menu_tab").offset().top - 130;
//                $('#folders-list-content').animate({ scrollTop : pos }, 'slow');
        }
            }); 
    }


function showqanexos(show){
	    //ShowLoader("show");
        var URL = show;
        $.ajax({
    	        type: 'POST',
                url: URL,
                success: function(msg){
        	           $('#panelContent').html(msg);
                  }
           }); 
    }
    function showqanexos2(show){
	    //ShowLoader("show");
        var URL = show;
        $.ajax({
    	        type: 'POST',
                url: URL,
                success: function(msg){
        	           $('#modal-data-append').append(msg);
                  }
           }); 
    }


function OpenWindow(url){

    //alert("Abriendo: "+url)

    var opciones = "Width=800, Height=600, Top=0 Left=0, Scrollbars=NO, resizable=NO, Directories=NO, Location=NO, Menubar=NO, Status=NO, Titlebar=NO, Toolbar=NO, fullscreen=NO";
        var targ = "target='_blank'";

    

    window.open(url, "Reparto de Expedientes", targ, opciones);
}
function OpenWindow2(url){
	    var opciones = "Width=800, Height=600, Top=0 Left=0, Scrollbars=NO, resizable=NO, Directories=NO, Location=NO, Menubar=NO, Status=NO, Titlebar=NO, Toolbar=NO, fullscreen=NO";
        var targ = "target='_blank'";
        window.open(url, "Configurar Expediente", targ, opciones);
    }


function BuscarAnexo(id){
    var cn = $("#searchanexo #searchfilter").val();    
    var URL = '/gestion_anexos/buscador/'+id+'/'+cn+'/';
    $.ajax({
	        type: 'POST',
            url: URL,
            success:function(msg){
    	            $("#list-anexos").html(msg);
                }
        });
}
function GotoPag(pag, id, folder){
  showfiles("/gestion/GetAnexos/"+id+"/"+folder+"/"+pag+"/", "cargador_box_upfiles_menu");
}

function base64_decode (encodedData) { // eslint-disable-line camelcase

  //  discuss at: http://locutus.io/php/base64_decode/

  // original by: Tyler Akins (http://rumkin.com)

  // improved by: Thunder.m

  // improved by: Kevin van Zonneveld (http://kvz.io)

  // improved by: Kevin van Zonneveld (http://kvz.io)

  //    input by: Aman Gupta

  //    input by: Brett Zamir (http://brett-zamir.me)

  // bugfixed by: Onno Marsman (https://twitter.com/onnomarsman)

  // bugfixed by: Pellentesque Malesuada

  // bugfixed by: Kevin van Zonneveld (http://kvz.io)

  //   example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==')

  //   returns 1: 'Kevin van Zonneveld'

  //   example 2: base64_decode('YQ==')

  //   returns 2: 'a'

  //   example 3: base64_decode('4pyTIMOgIGxhIG1vZGU=')

  //   returns 3: '✓ à la mode'

  if (typeof window !== 'undefined') {

    if (typeof window.atob !== 'undefined') {

      return decodeURIComponent(encodeURIComponent(window.atob(encodedData)))

    }

  } else {

    return new Buffer(encodedData, 'base64').toString('utf-8')

  }

  var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/='

  var o1

  var o2

  var o3

  var h1

  var h2

  var h3

  var h4

  var bits

  var i = 0

  var ac = 0

  var dec = ''

  var tmpArr = []

  if (!encodedData) {

    return encodedData

  }

  encodedData += ''

  do {

    // unpack four hexets into three octets using index points in b64

    h1 = b64.indexOf(encodedData.charAt(i++))

    h2 = b64.indexOf(encodedData.charAt(i++))

    h3 = b64.indexOf(encodedData.charAt(i++))

    h4 = b64.indexOf(encodedData.charAt(i++))

    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4

    o1 = bits >> 16 & 0xff

    o2 = bits >> 8 & 0xff

    o3 = bits & 0xff

    if (h3 === 64) {

      tmpArr[ac++] = String.fromCharCode(o1)

    } else if (h4 === 64) {

      tmpArr[ac++] = String.fromCharCode(o1, o2)

    } else {

      tmpArr[ac++] = String.fromCharCode(o1, o2, o3)

    }

  } while (i < encodedData.length)

  dec = tmpArr.join('')

  return decodeURIComponent(encodeURIComponent(dec.replace(/\0+$/, '')))

}


function ChecSuscriptoresExistsGestionRegistrar(){
    $("#formgestion").submit(); 
}

function SendExpedientes(){
    var str = $("#formgestion").serialize();  
    var URL = '/gestion/cargamasivapublica/';
    $.ajax({
        type: 'POST',
        url: URL,
        data: str,
        success:function(msg){
            $("#list-anexos").html(msg);
        }
    });
}

function SendInnerExpedientes(){
    $("body").css("cursor", "wait");
    var str = $("#formgestion").serialize();  
    var URL = '/importar_procesos/cargamasivainterna/';
    $.ajax({
        type: 'POST',
        url: URL,
        data: str,
        success:function(msg){
            $("#list-anexos").html(msg);
            $("body").css("cursor", "default");
        }
    });
}


function fnactualizarsession(){
    var URL = '/dashboard/fnactualizarsession/';
    $.ajax({
        type: 'POST',
        url: URL,
        success:function(msg){
        }
    });
}

function AddToFav(id){

    valor = $("#fav"+id).attr("data-role");
    var st = valor;
    var URL = '/gestion_favoritos/registrar/'+id+'/'+valor+'/';

    $.ajax({

        url:URL,
        type:'POST',
        success:function(msg){

            if (valor == "1") {

                $("#fav"+id).removeClass("text-muted");
                $("#fav"+id).addClass("text-warning");
                $("#fav"+id).removeClass("fa-star-o");
                $("#fav"+id).addClass("fa-star");
                $("#fav"+id).attr("data-role", "0");

            }else{

                $("#fav"+id).removeClass("text-warning");
                $("#fav"+id).removeClass("fa-star");
                $("#fav"+id).addClass("fa-star-o");
                $("#fav"+id).addClass("text-muted");
                $("#fav"+id).attr("data-role", "1");

            }
        }
    });
}

function AddToLock(id){

    valor = $("#lock"+id).attr("data-role");
    var st = valor;
    var URL = '/gestion/cerrarproceso/'+id+'/'+valor+'/';


    $.ajax({

        url:URL,
        type:'POST',
        success:function(msg){
            $("#col_"+id).remove();
        }
    });
}

setInterval('fnactualizarsession()',300000);