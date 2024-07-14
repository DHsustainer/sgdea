
<link href="<?= ASSETS.DS ?>css/estilo_editor.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/script_editor.min.js"></script>

	<div id="tools-content">
		<div class="opc-folder blue">
			<div class="header-agenda">
				<div class="boton-new-proces-blankspace" style="float: left"></div>
				<div id="boton-new-proces" style="float: right">
					<a class="no_link" href="/solicitudes_documentos/nuevo/">
						<div>Crear Solicitud</div>
					</a>
				</div>

				<div class="boton-new-proces-blankspace" style="float: right"></div>
				<div id="boton-new-proces" style="float: right">
					<a class="no_link" href="/solicitudes_documentos/listar/">
						<div class="active">Solicitudes Pendientes</div>
					</a>
				</div>

			</div>
		</div>
	</div>
	<div id="folders-content">
		<div id="folders-list-content">
			<div class='title'>Responder Solicitud</div>
			<form id='FormUpdatesolicitudes_documentos' action='/solicitudes_documentos/actualizar/' method='POST'  onsubmit="return CheckForm()"> 
				<div class="row" style="margin-left:0px; margin-top: 0px;">
				<?
					$fecha_solicitud = $object -> GetFecha_solicitud();
					$fecha_respuesta = $object -> GetFecha_respuesta();
					$fecha_caducidad = $object -> GetFecha_caducidad();
					
					$usuarios_s = new MUsuarios;
					$usuarios_s->CreateUsuarios("user_id", $object->GetUsuario_solicita());

					$area = $c->GetDataFromTable("areas", "id", $usuarios_s->GetRegimen(), "nombre", $separador = " ");
					$usuario = $usuarios_s->GetP_nombre()." ".$usuarios_s->GetP_apellido().", ($area)";

					$gestion_id = "NS";
					if ($object->GetGestion_id() != "0") {
						$g = new MGestion;
						$g->CreateGestion("id", $object->GetGestion_id());
						$gestion_id = $g->GetMin_rad();
					}

					if ($fecha_respuesta == "0000-00-00 00:00:00") {
						$fecha_respuesta = "-";
					}
					
					if ($fecha_caducidad == "0000-00-00") {
						$fecha_caducidad = "-";
					}
				?>

					<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
					<!--
						<input type="text" id="gestion_id" name="gestion_id" placeholder='Si lo conoce, Escriba el número de radicado del Expediente que Solicita' style="height:35px;" class='input1_0 form-control'> 
					-->

					<div class="2u 12u(narrower)">
						<b>Solicitado Por</b>
					</div>
					<div class="4u 12u(narrower) " >
						<?= $usuario ?>
					</div>

					<div class="2u 12u(narrower)">
						<b>Fecha de Solicitud</b>
					</div>
					<div class="4u 12u(narrower) " >
						<?= $object -> Getfecha_solicitud(); ?>
					</div>

					<div class="2u 12u(narrower)">
						<b>Observación</b>
					</div>
					<div class="10u 12u(narrower) " >
						<?= $object -> Getobservacion(); ?>
					</div>


					<div class="2u 12u(narrower)" align="right">
						<b><br>Num. Radicado</b>
					</div>
					<div class="2u 12u(narrower) " >
						<input type='text' <?= ($gestion_id != "0")?"readonly='readonly'":"" ?> class='input1_0 form-control' placeholder='gestion_id' name='gestion_id' id='gestion_id' maxlength='' value='<? echo $gestion_id; ?>' />
					</div>
					<div class="2u 12u(narrower)" align="right">
						<b><br>Caducidad del Permiso</b>
					</div>
					<div class="2u 12u(narrower) " >
						<input type='text' class='input1_0 form-control datepicker' placeholder='fecha_caducidad' name='fecha_caducidad' id='fecha_caducidad' maxlength='' value='<? echo $object -> Getfecha_caducidad(); ?>' />
					</div>

					<div class="2u 12u(narrower)" align="right">
						<b><br>¿Compartir Todo Expediente?</b>
					</div>
					<div class="2u 12u(narrower) " >
						<select id="dar_permiso" name="dar_permiso" style="height:35px;" class="form-control">
							<option value="-1">Seleccione una Opción</option>
							<option value="0">Deseo Que el Usuario Pueda Consultar el Expediente </option>
							<option value="1">Deseo Que el Usuario Pueda Interactuar con el Expediente </option>
							<option value="-1">No Deseo Compartir este Expediente con el Usuario</option>
						</select>
					</div>


					<div class="2u 12u(narrower) "><br><br>
						<b style="text-align: right">Respuesta</b>
						<br><br><br><br>
						<input type='submit' value='Aceptar Solicitud'/>
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
					            	<div id="editor" name="editor" style="min-height: 170px;" class="text_notas scrollable"><?= $object -> GetRespuesta() ?> </div>
						        </div>
					            <textarea style="display:none;min-height: 170px;" class="text_notas marginbottom_2 scrollable" name='descripcion' id='descripcion' maxlength='' placeholder="Escribe tu nota aquí..."><?= $contenido ?></textarea>
					        </div>
					        <div class="clear"></div>
					    </div>
					</div>

				</div>
			</form>
		</div>
	</div>
<script type="text/javascript">

	$('.datepicker').datepicker({
		dateFormat: 'yy-mm-dd',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
		dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday				
	});

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

	function CheckForm(){
		if ($("#dar_permiso").val() == "1" && $("#gestion_id").val() == "0") {
			alert("Para compartir todo el expediente debe ingresar el número de radicado");
			return false;
		};
	}

</script>
