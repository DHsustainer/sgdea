<link href="<?= ASSETS.DS ?>css/estilo_editor.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/AjaxUpload.2.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/script_editor.js"></script>
	<form id='FormUpdateplantillas_email' action='/plantillas_email/actualizar/' method='POST'> 
		<h2>Editar Plantilla: <? echo $object -> Getnombre(); ?></h2>
		<blockquote class="text-muted"><? echo $object->GetAyuda(); ?></blockquote>
		<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar plantillas_email</td>
			</tr> 
			
			<input type='text' class='form-control' placeholder='tipo' name='tipo' id='tipo' maxlength='' value='<? echo $object -> Gettipo(); ?>' />
			
			<input type='text' class='form-control' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
			
			<input type='text' class='form-control' placeholder='contenido' name='contenido' id='contenido' maxlength='' value='<? echo $object -> Getcontenido(); ?>' />
			-->
			<!--<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />-->
			<div id="bodyform_minutas" style="width: 100%; margin: 0px auto;">
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
			                    <li onClick="format_buttonCSS('FontSize8')">8</li>
			                    <li onClick="format_buttonCSS('FontSize9')">9</li>
			                    <li onClick="format_buttonCSS('FontSize10')">10</li>
			                    <li onClick="format_buttonCSS('FontSize11')">Normal (11)</li>
			                    <li onClick="format_buttonCSS('FontSize12')">12</li>
			                    <li onClick="format_buttonCSS('FontSize14')">14</li>
			                    <li onClick="format_buttonCSS('FontSize16')">16</li>
			                    <li onClick="format_buttonCSS('FontSize18')">18</li>
			                    <li onClick="format_buttonCSS('FontSize20')">20</li>
			                    <li onClick="format_buttonCSS('FontSize22')">22</li>
			                    <li onClick="format_buttonCSS('FontSize24')">24</li>
			                    <li onClick="format_buttonCSS('FontSize26')">26</li>
			                    <li onClick="format_buttonCSS('FontSize28')">28</li>
			                    <li onClick="format_buttonCSS('FontSize30')">30</li>
			                    <li onClick="format_buttonCSS('FontSize32')">32</li>
			                    <li onClick="format_buttonCSS('FontSize34')">34</li>
			                    <li onClick="format_buttonCSS('FontSize36')">36</li>
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
			            <select class='select-opc' id='sel_plantillaemail' style='margin-bottom:5px; width:170px'>
							<option>Datos del Expediente</option>
							<option value="&nbsp;<b>[elemento]rad_externo[/elemento]</b>&nbsp;">Radicado Externo</option>
							<option value="&nbsp;<b>[elemento]rad_completo[/elemento]</b>&nbsp;">Radicado Completo</option>
							<option value="&nbsp;<b>[elemento]rad_rapido[/elemento]</b>&nbsp;">Radicado Rapido</option>
							<option value="&nbsp;<b>[elemento]Suscriptor[/elemento]</b>&nbsp;">Nombre del Suscriptor Principal</option>
							<option value="&nbsp;<b>[elemento]Estado[/elemento]</b>&nbsp;">Estado de la Solicitud</option>
							<option value="&nbsp;<b>[elemento]Fecha_registro[/elemento]</b>&nbsp;">Fecha de Ingreso</option>
							<option value="&nbsp;<b>[elemento]tipo_documento[/elemento]</b>&nbsp;">Tipo de Documento</option>
							<option value="&nbsp;<b>[elemento]fecha_vence[/elemento]</b>&nbsp;">Fecha de Vencimiento</option>
							<option value="&nbsp;<b>[elemento]Resuelto[/elemento]</b>&nbsp;">¿Resuelto?</option>
							<option value="&nbsp;<b>[elemento]fecha_respuesta[/elemento]</b>&nbsp;">Fecha de Respuesta</option>
							<option value="&nbsp;<b>[elemento]prioridad[/elemento]</b>&nbsp;">Prioridad</option>
							<option value="&nbsp;<b>[elemento]folios[/elemento]</b>&nbsp;"># Folios</option>
							<option value="&nbsp;<b>[elemento]departamento[/elemento]</b>&nbsp;">Departamento de Origen</option>
							<option value="&nbsp;<b>[elemento]ciudad[/elemento]</b>&nbsp;">Ciudad de Origen</option>
							<option value="&nbsp;<b>[elemento]oficina[/elemento]</b>&nbsp;">Oficina de Origen</option>
							<option value="&nbsp;<b>[elemento]area[/elemento]</b>&nbsp;">Area Asignada</option>
							<option value="&nbsp;<b>[elemento]responsable[/elemento]</b>&nbsp;">Usuario Responsable</option>
							<option value="&nbsp;<b>[elemento]serie[/elemento]</b>&nbsp;">Serie Documental</option>
							<option value="&nbsp;<b>[elemento]sub_Serie[/elemento]</b>&nbsp;">Sub Serie Documental</option>
							<option value="&nbsp;<b>[elemento]observacion[/elemento]</b>&nbsp;">Observacion</option>
							<option value="&nbsp;<b>[elemento]ubicacion[/elemento]</b>&nbsp;">Ubicación</option>

							<option value="&nbsp;<b>[elemento]USUARIO[/elemento]</b>&nbsp;">Usuario</option>
							<option value="&nbsp;<b>[elemento]CLAVE_USUARIO[/elemento]</b>&nbsp;">Clave Usuario</option>
							<option value="&nbsp;<b>[elemento]PROJECTNAME[/elemento]</b>&nbsp;">Nombre empresa</option>
							<option value="&nbsp;<b>[elemento]ASUNTO[/elemento]</b>&nbsp;">Asunto</option>
							<option value="&nbsp;<b>[elemento]BOTON_RECIBIR[/elemento]</b>&nbsp;">Boton recibir</option>
							<option value="&nbsp;<b>[elemento]BOTON_NORECIBIR[/elemento]</b>&nbsp;">Boton no recibir</option>
							<option value="&nbsp;<b>[elemento]HOMEDIR[/elemento]</b>&nbsp;">Direccion Web</option>
							<option value="&nbsp;<b>[elemento]CODIGO_MENSAJE[/elemento]</b>&nbsp;">Codigo Mensaje</option>
							<option value="&nbsp;<b>[elemento]LOGO[/elemento]</b>&nbsp;">Logo</option>
							
			            </select>
			            </div>
			        </div>
		            <div  class="container_editor2">
		            	<div id="editor" name="editor" class="text_notas2 scrollable"><? echo $object -> Getcontenido(); ?></div>
			        </div>
		            <textarea style="display:none" class="text_notas2 marginbottom_2 scrollable" name='descripcion' id='descripcion' maxlength='' placeholder="Escribe tu nota aquí..."><? echo $object -> Getcontenido(); ?></textarea>
		        </div>
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='button' value='Actualizar Plantilla' class="btn btn-info m-t-30" onClick="updatePlantillaEmail();"/>
	</form>
	<script>
    $(document).ready(function() {

        $('.select-opc').change(function() {
            AddHtml($(this).attr("id"), $(this).val());
            select = $(this);
            select.val($('option:first', select).val());

        });
    });
</script>
