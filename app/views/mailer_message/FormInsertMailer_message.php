<link href="<?= ASSETS.DS ?>css/estilo_editor.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/AjaxUpload.2.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/script_editor.js"></script>



<div class="block_mailer_menu" id="block_mailer_menu">
	<div class="mailer_header">
		<div id="mailer_title_body">
			<div class="icon inboxicon"></div>
			<div class="mailer_title">
				Buzón
			</div>
		</div>
	</div>

	<ul id="list_menu_mailer" style="padding-left: 0px; margin-left: 0px;">
<?
	$aa = "";
	$ab = "";
	$ac = "";
	$ad = "";

	if($action == "inbox"){
		$aa = "active";
	}elseif($action == "nuevo"){
		$ac = "active";
	}elseif ($action == "sent") {
		$ab = "active";
	}elseif ($action == "archived") {
		$ad = "active";
	}else{
		$aa = "active";
	}
?>
		<li style="margin-left: 0px;" class="<?= $aa; ?>">
			<div class="icon inbox <?= $aa; ?>"></div>
			<a class="<?= $aa; ?>" href="<?= HOMEDIR.DS.'correo'.DS.'inbox'.DS.$id.'.'.$pid.DS; ?>">Bandeja de entrada</a>
			<div class="clear"></div>
		</li>
<?
	if ($_SESSION['suscriptor_id'] == "" ) {
?>
		<li class="<?= $ac; ?>">
			<div class="icon nuevo <?= $ac; ?>"></div>
			<a class="<?= $ac; ?>" href="<?= HOMEDIR.DS.'correo'.DS.'nuevo'.DS.$id.'.'.$pid.DS; ?>">Redactar</a>
			<div class="clear"></div>
		</li>
		<li class="<?= $ab; ?>">
			<div class="icon sent <?= $ab; ?>"></div>
			<a class="<?= $ab; ?>" href="<?= HOMEDIR.DS.'correo'.DS.'sent'.DS.$id.'.'.$pid.DS; ?>">Enviados</a>
			<div class="clear"></div>
		</li>
		<li class="<?= $ad; ?>">
			<div class="icon archived <?= $ad; ?>"></div>
			<a class="<?= $ad; ?>" href="<?= HOMEDIR.DS.'correo'.DS.'archived'.DS.$id.'.'.$pid.DS; ?>">Archivados</a>
			<div class="clear"></div>
		</li>
<?
	}
?>
	</ul>
</div>
<div class="block_mailer_body">
	<div class='mailer_header'>
		<div class="mailer_title" id='title_header'>
			Redactar Mensaje
		</div>
	</div>

	<div id='contenido_bloque' style="height:auto; overflow:auto;">

		<form id='formmailer_message' action='/mailer_message/nuevo/' method='POST'> 
			<input type='hidden' name='p_id' id='p_id' value="<?= $pid ?>" maxlength='10' /></td>
			<div class="mailer_new_element">
				<input type="text" name="to" id="to" maxlength='' style="width:100%; height:35px;" placeholder="Direccion de Correo" value="<?= $_REQUEST['cn'] ?>" >
				<div id='bloquebusqueda' style="width:100%; margin-top:10px"></div>
			</div><br>
			<div class="mailer_new_element">
				<input type='text' name='subject' <?= $blocked; ?> id='subject' maxlength='' style="width:100%; height:35px;" placeholder="Asunto" />
			</div>
			<div class="mailer_new_element">
				<label>
					<b>Deseo que el mensaje de datos expire dentro de:</b>
					<select name="deadline" id="deadline" <?= $blocked; ?> style="width:73%; margin:5px; height:35px;">
                        <option value="0">Hoy Mismo</option>
                        <option value="1">1 Dia</option>
                        <option value="2">2 Dia(s)</option>
                        <option value="3">3 Dia(s)</option>
                        <option value="4">4 Dia(s)</option>
                        <option value="5">5 Dia(s)</option>
					</select>
				</label>
			</div>
			<div class="mailer_new_element">
	    		<div id="bodyform_minutas" style="width:900px; margin: 10px auto;">
			        <div class="bloq_newdoc" style="float:left; width: 100%;" id="bloq_editor">
			           	<div id="buttons">
				            <button type="button" class="botone" onClick="format_buttonCSS('bold')"><span class="icon bold"></span></button>
				            <button type="button" class="botone" onClick="format_buttonCSS('italic')"><span class="icon italic"></span></button>
				            <button type="button" class="botone" onClick="format_buttonCSS('underline')"><span class="icon underline"></span></button>
				            <button type="button" class="botone" onClick="format_buttonCSS('sline')"><span class ="icon line"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyLeft')"><span class ="icon left"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyRight')"><span class ="icon right"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyCenter')"><span class ="icon center"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyFull')"><span class ="icon justify"></span></button>
				            <button type="button" class="botone" onClick="align_button('indent')"><span class="icon indent"></span></button>
				            <button type="button" class="botone" onClick="align_button('outdent')"><span class="icon outdent"></span></button>
				            <button type="button" class="botone" onClick="align_button('InsertOrderedList')"><span class="icon numberlist"></span></button>
				            <button type="button" class="botone" onClick="align_button('InsertUnorderedList')"><span class="icon dotslist"></span></button>
				            <button type="button" id="fontsize" class="botone"><span class="icon fontsize"></span>
				            <ul>
				                    <li onClick="format_buttonCSS('fontSizeDefault')">Normal</li>         
				                    <li onClick="format_buttonCSS('fontSizeSmall')">Pequeño</li>            
				                    <li onClick="format_buttonCSS('fontSizeBig')">Grande</li>
				                    <li onClick="format_buttonCSS('fontSizeRbig')">Muy Grande</li>
				                </ul>
				            </button>
				            <button type="button" id="fonttype" class="botone"><span class="icon fonttype"></span>
				                <ul>
				                    <li onClick="format_buttonCSS('fontArial')">Arial</li>         
				                    <li onClick="format_buttonCSS('fontCourrier')">Courrier New</li>            
				                    <li onClick="format_buttonCSS('fontVerdana')">Verdana</li>
				                    <li onClick="format_buttonCSS('fontMonotypeCorsiva')">Monotype</li>
				                    <li onClick="format_buttonCSS('fontTahoma')">Tahoma</li>
				                    <li onClick="format_buttonCSS('fontTimes')">Times</li>
				                </ul>
				            </button>
				            <button type="button" class="botone" onClick="InsertQuote('addquote')"><span class="icon quote"></span></button>
				            <button type="button" class="botone" onClick="DoTable()"><span class="icon gird"></span></button>
				            <button type="button" class="botone" id="upload_button"><span class="icon image"></span></button>
				            <button type="button" class="botone" onClick="InsertVideo()"><span class="icon video"></span></button>
				            <button type="button" class="botone" onClick="url_button()"><span class="icon link"></span></button>
				            <button type="button" class="botone" onClick="showhtml()"><span class="icon html"></span></button>
				            <br>
				            <div style="margin: 5px;">
			            	<?

			            	?>
				            </div>
				        </div>
				        <div  class="container_editor">
			            	<div id="editor" name="editor" class="text_notas scrollable"><?= $contenido ?></div>
				        </div>
			            <textarea style="display:none" class="text_notas marginbottom_2 scrollable" name='descripcion' id='descripcion' maxlength='' placeholder="Escribe tu nota aquí..."><?= $contenido ?></textarea>
			        </div>
			        <div class="clear"></div>
			    </div>
			</div>
			<div class="clear"><br></div>
			<div class="mailer_new_element" stye="text-align:right">
				<input type='button' id="EnviarCorreoElectronico" style="width:80px; height:37px; background-color:#3A3839; float:right; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px; border:none" value='Enviar'/>
				<input type="text" name="folder_id_search" id="folder_id_search" style="width:300px; height:37px" placeholder="Escriba aquí el numero de radicado a buscar" value="<?= $_REQUEST['id'] ?>">
				<button type="button" class="botone" id="atacchfiles">
                    <img src="<?= ASSETS ?>/images/upload.png" title="Adjuntar Archivos">
                </button>
			</div>


			<div class="mailer_new_element">
                  <input type="hidden" id="anexos_listado" name="anexos_listado">
                  <input type="hidden" id="archivos_anexos_listado" name="archivos_anexos_listado">
                  <input type="hidden" id="titulos_anexos_listado" name="titulos_anexos_listado">
                  <ul id="listado_anexos">
                  </ul>                  
			</div>
			<div class="clear"><br></div>

			<div id="listfiles"> 
		<?php 
	  $viewer =       array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,
                              ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,
                              ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,
                              ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,
                              ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,
                              "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,
                              "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,
                              ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video",

                              ".DOC" => "google"                        , "DOCX" => "google"                        , ".ZIP" => "google"                        , ".RAR" => "google"                        ,
                              ".TAR" => "google"                        , ".XLS" => "google"                        , "XLSX" => "google"                        , ".PPT" => "google"                        ,
                              ".PPS" => "google"                        , "PPTX" => "google"                        , "PPSX" => "google"                        , ".PDF" => "google"                        ,
                              ".TXT" => "google"                        , ".JPG" => "image"                         , "JPEG" => "image"                         , ".BMP" => "image"                         ,
                              ".GIF" => "image"                         , ".PNG" => "image"                         , ".DIV" => "image"                         , ".TIF" => "image"                         ,
                              "TIFF" => "image"                         , "MPEG" => "video"                         , ".AVI" => "video"                         , ".MP4" => "video"                         ,
                              "MIDI" => "audio"                         , ".ACC" => "audio"                         , ".WMA" => "audio"                         , ".OGG" => "audio"                         ,
                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video");
		?>	
				<div id="cargar_listas_demandas">
					<div align="center" style="border:0px solid #333;">
						<div style="margin-left:30px" id="laderdata">
							<div class="titulo" align="left">Anexos</div>
							<div class="alert alert-info">Escriba un numero de radicado</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<script>
$(document).ready(function() {
	$("#atacchfiles").live("click", function(){
		var str = "dtf="+$("#folder_id_search").val();
		$.ajax({
			type: "POST",
			url: '/gestion_anexos/GetAnexosCarpeta/',
			data: str,
			success: function(msg){
				result = msg;
				$("#listfiles").html(result);
			}
		});				
	})

	<?
		if ($_REQUEST['id'] != "") {
?>
			$("#atacchfiles").click();
<?
		};
	?>

});
</script>
<script>
	$(".active_check").live("click", function(){
		var date = $(this).attr("checked"); 
		var valor = $(this).attr("value");
		var titulo = $(this).attr("title");
		var idan = $(this).attr("id");

		if (date){

			var strx = "<li id='l"+idan+"'>"+titulo+"</li>";
			$("#listado_anexos").append(strx);

			var x = $("#anexos_listado").val()+";"+idan;
			$("#anexos_listado").val(x);

			var y = $("#archivos_anexos_listado").val()+";"+valor;
			$("#archivos_anexos_listado").val(y);

			var y = $("#titulos_anexos_listado").val()+"@@@"+titulo;
			$("#titulos_anexos_listado").val(y);                  

		}else{
			var strx = "l"+idan;
			$("#"+strx).remove();

			var xl   = $("#anexos_listado").val();
			vector  = xl.split(";");

			var yl   = $("#archivos_anexos_listado").val();
			vectory  = yl.split(";");

			var ml   = $("#titulos_anexos_listado").val();
			vectorm  = ml.split("@@@");

			var xt = "";
			var yt = "";
			var mt = "";

			for (var i = 0 ; i < vector.length ; i++){
				if(vector[i] == idan){

					vector.slice(i);                        
					vectory.slice(i);
					vectorm.slice(i);

				}else{
					xt += vector[i]+";";
					yt += vectory[i]+";";
					mt += vectorm[i]+"@@@";
				}
			}
			$("#anexos_listado").val(xt);
			$("#archivos_anexos_listado").val(yt);
			$("#titulos_anexos_listado").val(mt);
		} 
	});
	
	$("#EnviarCorreoElectronico").live("click", function(){

		if ($('#to').val() == ""){
			alert("Debe seleccionar por lo menos un destinatario");
			return false
		}
		if ($('#subject').val() == ""){
			if(!confirm("Desea enviar el mensaje sin asunto ")){
			    return false;
			}
		}
		if ($('.note-editable').html() == ""){
			if(!confirm("Desea enviar el mensaje sin mensaje ")){
			    return false;
			}
		}
		$("body").css("cursor", "wait");

		var str = $("#formmailer_message").serialize();
		$.ajax({
		    type: 'POST',
		    url: '/correo/enviar/',
		    data: str,
		    success: function(msg){
		        alert(msg);
		        $("body").css("cursor", "default");
		        window.location.href = "/correo/inbox/";
		        //$("#formmessage").reset();
		    }   
		});     
	})
</script>
<script>
	
	var lst = $("#anexos_listado").val();
	vector = lst.split(";");

	$("#f195").attr("checked", true)
	for (var i = 1 ; i < vector.length ; i++){
		$('#'+vector[i]).attr('checked', true);
	}
</script>
<script>
	$(document).ready(function(){

		$("#to").live("keyup", function(){
			$("#bloquebusqueda").html("<ul><li>Buscando coincidencias</li></ul>");
			$("#bloquebusqueda").fadeIn();				
			var str = "dtf="+$(this).val();
			//$("#truedata").val($(this).val());
			
			$.ajax({
				type: "POST",
				url: '/correo/autofillcontats/',
				data: str,
				success: function(msg){
					result = msg;
					$("#bloquebusqueda").html(result);
				}
			});				
			
		})	

		capa = $("#bloq_editor");
        $("#folders-list-content").scroll(function () {
          var elt = $("#buttons");    
          //Bt = window.name = window.pageYOffset;
          var p = $( "#bloq_editor" );
          var position = p.position();
          Bt = position.top ;
          if (Bt < 0){
            elt.addClass("pointed");
            elt.css("position","fixed");
            elt.css("width", $("#bloq_editor").width()+"px");
            elt.css("top","122px");
            elt.css("-moz-box-shadow","0px 3px 8px 0px rgba(50, 50, 50, 0.21)");
            elt.css("-webkit-box-shadow","0px 3px 8px 0px rgba(50, 50, 50, 0.21)");
            elt.css("box-shadow","0px 3px 8px 0px rgba(50, 50, 50, 0.21)");           
          }else{
            elt.removeClass("pointed");
            elt.css("position","relative");
            elt.css("top","auto");
            elt.css("width","auto");
            elt.css("-moz-box-shadow","none");
            elt.css("-webkit-box-shadow","none");
            elt.css("box-shadow","none");           
          }

        });
	});	
	/*
	$("#dtform").blur(function(event) {
		$("#bloquebusqueda").fadeOut();	
	});
	*/
	function onTecla(e){	
		var num = e?e.keyCode:event.keyCode;
		if (num == 9 || num == 27){
			$("#bloquebusqueda").fadeOut();	
			$("#to").blur();
		}
	}
	
	document.onkeydown = onTecla;
		if(document.all){
			document.captureEvents(Event.KEYDOWN);	
	}
	function AddContact(x){
		$("#to").val(x);
		$("#to").focus();
		$("#bloquebusqueda").fadeOut();	
	}

</script>
<script>
	jQuery.fn.multiselect = function() {
	    $(this).each(function() {
	        var checkboxes = $(this).find("input:checkbox");
	        checkboxes.each(function() {
	            var checkbox = $(this);
	            // Highlight pre-selected checkboxes
	            if (checkbox.prop("checked"))
	                checkbox.parent().addClass("multiselect-on");
	 
	            // Highlight checkboxes that the user selects
	            checkbox.click(function() {
	                if (checkbox.prop("checked"))
	                    checkbox.parent().addClass("multiselect-on");
	                else
	                    checkbox.parent().removeClass("multiselect-on");
	            });
	        });
	    });
	};
	$(function() {
	     $(".multiselect").multiselect();
	});

</script>
<style>
		
	#message{
		height: 300px;
	}
	.note-editable{
		height: 400px;
	}
	.main_elm 	{
		width: 90%;
		padding-left: 20px;
		clear: both;
		height: 30px;
	}
 	.check_elm 	{
 		float: left;
 		width: 20px;
 		height: 30px;
 		margin-top: 4px;

 	}
 	.title_elm 	{
		float: left;
		text-align: left;
		line-height: 30px;
 	}
 	.title_elm:hover{
 		cursor: pointer;
 		text-decoration: underline;
 	}
	#cargar_listas_demandas{
		height: 480px;
		overflow-x: auto;
	}

	.multiselect {
	    height:100px;
	    width: 97%;
	    line-height: 20px;
	    border:solid 1px #c0c0c0;
	    overflow:auto;
	    padding: 0px;
	    padding-top: 0px;
	    border-radius: 15px;

	}

	.multiselect .title_multi{
		font-weight: bold;
		font-size: 13px;
		margin: 10px;
	}
	 
	.multiselect label {
	    display:block;
	    padding-left: 15px;
	    padding-bottom: 10px;
	    margin:0px;
	    margin-top: 0px;
	    font-size: 11px;
	    width: 98%;

	}
	 
	.multiselect-on {
	    color:#000;
	    background-color:#F5F5F5;
	}

	.mailer_new_element{
		margin: 7px;
	}

    .album_inner_button{
        position: relative;
        z-index: 999;
    }
    
    #list-anexos{
        padding-left: 0px;
    }
    #list-anexos li.anexos-li{
        height: 45px;
        line-height: 45px;
        border-top:1px solid #CCC;
        width: 100%;
        list-style: none;

    }

    #list-anexos li.anexos-li .nom_anexo{
        float:left;
        line-height: 35px;

        font-size: 12px;
        overflow-y: hidden ; 
        overflow-x: hidden ; 
        padding: 5px;
        padding-right: 9px;
        cursor: normal;
    }
    #list-anexos li.anexos-li .nom_anexo:hover{
        text-decoration: underline;
        cursor: pointer;
    }

    #FormUpdategestion .no_editable{
        display: none;
    }
</style>
