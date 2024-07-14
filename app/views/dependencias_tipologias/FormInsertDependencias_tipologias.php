<h2>Crear Tipologia Documental </h2>
<form id='formdependencias_tipologias' class="mycoolform" action='/dependencias_tipologias/registrar/' method='POST'> 
	<input type='hidden' class='form-control' value="<?= $id ?>" placeholder='Id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='10' />
	<input type='hidden' class='form-control' value="<?= $_SESSION['usuario']; ?>" placeholder='Usuario' name='usuario' id='usuario' maxlength='50' />
	<input type='hidden' class='form-control' value="<?= date("Y-m-d")?>" placeholder='Fecha' name='fecha' id='fecha' maxlength='' />

	<select class='form-control important' name="requiere_firma" id="requiere_firma" style="display: none;"><br>
		<option value="NO">El Documento Requiere Firma Electrónica</option>
		<option value="NO">NO</option>
		<option value="SI">SI</option>
	</select>
	
	<div class="row" >
		<div class="col-md-9">
			<input type='text' class='form-control important' placeholder='Tipologia' name='tipologia' id='tipologia' maxlength='400' title="Escriba un nombre de tipología documental" /><br>
		</div>
		<div class="col-md-3">
			<a href="#" id="uploadbtn" class="btn btn-success">Cargar Formato de Datos</a>
			<input type="text" id="formato" style="display:none" name="formato">	
			<div id="status"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<textarea id="prioridad" name="prioridad" class="form-control" placeholder="Procedimiento" style="resize:none; height: 70px;"></textarea>
		</div>
		<div class="col-md-6">
			<div class="row m-t-10">
				<div class="col-md-6">
					<input type="checkbox" id="is_inm" name="is_inm">
					<label for="is_inm">¿Tipología de Inmaterialización?</label>
				</div>
				<div class="col-md-6">
					<input type="checkbox" id="is_entrada" name="is_entrada">
					<label for="is_entrada">¿Documento de Salida?</label>
				</div>
			</div>
			<div class="row m-t-10" >
				<div class="col-md-6">
					<input type="checkbox" id="is_obl" name="is_obl">
					<label for="is_obl">¿Documento Obligatorio?</label>
				</div>
				<div class="col-md-6">
					<input type="checkbox" id="is_pbl" name="is_pbl">
					<label for="is_pbl">¿Documento Publico?</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row m-t-20">
		<div class="col-md-4">
			<select placeholder="Días de Vencimiento" class="form-control" name='dias_vencimiento' id='dias_vencimiento'>
				<option value="0">Vencimiento</option>
				<option value="0">Documento Persistente</option>		
				<option value="15">15 Días</option>			<option value="30">1 Mes</option>
				<option value="90">3 Meses</option>			<option value="180">6 Meses</option>		<option value="270">9 Meses</option>
				<option value="365">1 Año(s)</option>		<option value="730">2 Año(s)</option>		<option value="1095">3 Año(s)</option>
				<option value="1460">4 Año(s)</option>		<option value="1825">5 Año(s)</option>		<option value="2190">6 Año(s)</option>
				<option value="2555">7 Año(s)</option>		<option value="2990">8 Año(s)</option>		<option value="3650">10 Año(s)</option>
				<option value="4380">12 Año(s)</option>		<option value="5475">15 Año(s)</option>		<option value="7300">20 Año(s)</option>
				<option value="9125">25 Año(s)</option>		<option value="10950">30 Año(s)</option>	<option value="12775">35 Año(s)</option>
				<option value="14600">40 Año(s)</option>	<option value="16425">45 Año(s)</option>	<option value="18250">50 Año(s)</option>
				<option value="21900">60 Año(s)</option>	<option value="25550">70 Año(s)</option>	<option value="29200">80 Año(s)</option>
			</select>
		</div>
		
		<div class="col-md-4">
			<select class="form-control" style="width:90%;" name="soporte" id="soporte">
				<option value="0">Soporte.</option>
				<option value="0">Papel. </option>
				<option value="1">Electrónico.</option>
				<option value="2">Papel y Electrónico.</option>
				<option value="3">XML</option>
				<option value="4">Papel, Electrónico O XML</option>
			</select>
		</div>
		<div class="col-md-4">
			<select class="form-control" style="width:90%;" name="selectobservacion" id="selectobservacion" onChange="sendseelctobservacion('selectobservacion', 'formdependencias_tipologias')">
				<option value="">Seleccione una Observacion</option>
				<option value="Eliminación y conservación digital. ">Eliminación y conservación digital. </option>
				<option value="Digitalización y conservación del físico hasta cumplir el periodo de gestión.">Digitalización y conservación del físico hasta cumplir el periodo de gestión.</option>
				<option value="Digitalizacion y preservación del físico en el archivo histórico. ">Digitalizacion y preservación del físico en el archivo histórico. </option>
				<option value="Otras">Otras.</option>
			</select>
			<textarea id="observacion" name="observacion" style="width: 90%; height: 80px; display:none" placeholder="Observacion"></textarea>
			<script type="text/javascript">
				function sendseelctobservacion(id, formulario){
					if ($("#"+id).val() != "Otras") {
						$("#"+formulario+" #observacion").html($("#"+id).val());
					}else{
						$("#"+formulario+" #observacion").html("");
						$("#"+formulario+" #observacion").css("display", "block")
					}
				}
			</script>
		</div>
	</div>
	<div class="row m-t-20">
		<div class="col-md-4">
			<input type='button' value='Crear Tipo Documental' class="btn btn-info" onClick="InsertarTipologia()"/>
		</div>
	</div>
	
	<hr>
	
</form>
<script language='javascript' type='text/javascript' src='<?=HOMEDIR.DS?>/app/plugins/ajaxupload.3.5.js'></script>
<script type="text/javascript" >
$(function(){
	var btnUpload=$('#uploadbtn');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: '/dependencias_tipologias/cargarformato/',
		name: 'uploadfile',
		onSubmit: function(file, ext){
			 if (! (ext && /^(pdf|doc|docx|xls|xlsx)$/.test(ext))){ 
                // extension is not allowed 
				status.text('Solo se permiten Archivos PDF, Word o Excel');
				return false;
			}
			status.text('Uploading...');
		},
		onComplete: function(file, response){
			//On completion clear the status
			status.text('Formato Cargado');
			//Add uploaded file to list
			$("#formato").val(response);
			
		}
	});
	
});
</script>