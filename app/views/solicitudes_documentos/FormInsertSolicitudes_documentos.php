<link href="<?= ASSETS.DS ?>css/estilo_editor.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/script_editor.min.js"></script>

	<div id="tools-content">
		<div class="opc-folder blue">
			<div class="header-agenda">
				<div class="boton-new-proces-blankspace" style="float: left"></div>
				<div id="boton-new-proces" style="float: right">
					<a class="no_link" href="/solicitudes_documentos/nuevo/">
						<div  class="active" >Crear Solicitud</div>
					</a>
				</div>

				<div class="boton-new-proces-blankspace" style="float: right"></div>
				<div id="boton-new-proces" style="float: right">
					<a class="no_link" href="/solicitudes_documentos/listar/">
						<div>Solicitudes Pendientes</div>
					</a>
				</div>

			</div>
		</div>
	</div>
	<div id="folders-content">
		<div id="folders-list-content">
			<br>
			<div class='title right'>Solicitar Documento</div>
			<form id='formsolicitudes_documentos' action='/solicitudes_documentos/registrar/' method='POST' onsubmit="return CheckImportantes('formsolicitudes_documentos')"> 
				<div class="row" style="margin-left:0px; margin-top: 0px;">


					<div class="2u 12u(narrower)">
						<b><br>A quien solicito el documento</b>
					</div>
					<div class="4u 12u(narrower) " >
						<input type="text" id="dtform" name="dtform" placeholder='Nombre del Usuario' style="height:35px;" class='input1_0 form-control important'>
					    <div id='bloquebusqueda'></div>           
						<input type="hidden"  name="usuario_destino" id="usuario_destino">
					</div>


					<div class="2u 12u(narrower)">
						<b><br>Número de Radicado Rápido</b>
					</div>
					<div class="4u 12u(narrower) " >
						<input type="text" id="gestion_id" name="gestion_id" placeholder='Si lo conoce, Escriba el número de radicado del Expediente que Solicita' style="height:35px;" class='input1_0 form-control'>
					</div>


					<div class="2u 12u(narrower) ">
						<b style="text-align: right">Observación</b>
					</div>

					<div class="10u 12u(narrower) ">
						<div id="bodyform_minutas" style="width:95%; margin: 10px auto;">
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
						            <button type="button" class="botone" onClick="align_button('InsertUnorderedList')"><span class="icon dotslist"></span></button>
						            <button type="button" class="botone" onClick="url_button()"><span class="icon link"></span></button>
						        </div>
						        <div  class="container_editor" style="padding: 10px;">
					            	<div id="editor" name="editor" style="min-height: 170px;" class="text_notas scrollable"><br><span style='color:gray'>Si no Conoce el número del expediente que necesita, escriba Aquí el(los) nombre del documento que necesita de forma especifica y el expediente donde desea le sea compartido</span><br></div>
						        </div>
					            <textarea style="display:none;min-height: 170px;" class="text_notas marginbottom_2 scrollable" name='descripcion' id='descripcion' maxlength='' placeholder="Escribe tu nota aquí..."><?= $contenido ?></textarea>
					        </div>
					        <div class="clear"></div>
					    </div>
					</div>


					<div class="12u 12u(narrower) ">
						<input type='submit' value='Solicitar Documento'  style='margin:10px;'/>
					</div>

				</div>
			</form>
		</div>
	</div>

<script>
$(document).ready(function() {

	$("#dtform").on("keyup", function(){
		$("#bloquebusqueda").fadeIn();				
		$.ajax({
			type: "POST",
			url: '/usuarios/GestListadoUsuarios/'+$(this).val()+"/",
			success: function(msg){
				result = msg;
				$("#bloquebusqueda").html(result);					
			}
		});				
	})

	$("#atacchfiles").live("click", function(){
		var str = "dtf="+$("#folder_id_search").val();
		$.ajax({
			type: "POST",
			url: '/gestion_anexos/GetAnexosCarpeta/',
			data: str,
			success: function(msg){
				result = msg;
				$("#list-anexos").html(result);
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

	function AddUsuarioToListado(nombre, email, id){
		$("#dtform").val(nombre);
		$("#usuario_destino").val(email);
		$("#bloquebusqueda").fadeOut();		
	}
</script>