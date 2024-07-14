<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<form id='FormUpdatedependencias_tipologias' action='/dependencias_tipologias/actualizar/' method='POST'> 
	<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
	<input type='hidden' class='form-control' placeholder='id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='' value='<? echo $object -> Getid_dependencia(); ?>' />
	<input type='hidden' class='form-control' placeholder='usuario' name='usuario' id='usuario' maxlength='' value='<? echo $object -> Getusuario(); ?>' />
	<input type='hidden' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
	<select class='form-control' name="requiere_firma" id="requiere_firma" style="display: none;"><option value="NO">NO</option></select>


		<div class="row" >
			<div class="col-md-9">
				<input type='text' class='form-control important' value='<? echo $object -> Gettipologia(); ?>' placeholder='Tipologia' name='tipologia' id='tipologia' maxlength='400' title="Escriba un nombre de tipología documental" /><br>
			</div>
			<div class="col-md-3">
				<a href="#" id="updateuploadbtn" class="btn btn-success">Cargar Formato de Datos</a>
				<input type="text" id="updateformato" style="display:none" name="updateformato">	
				<div id="updatestatus"></div>
			</div> 
		<!--
		-->
		</div>
		<div class="row">
			<div class="col-md-6">
				<label>Procedimiento</label>
				<textarea id="prioridad" name="prioridad" class="form-control" placeholder="Procedimiento" style="resize:none; height: 80px;"><?= $object->GetPrioridad() ?></textarea>
			</div>
			<div class="col-md-6">
				<label>Observación</label>
				<textarea id="observacion" name="observacion" class="form-control"  style="height: 80px;" placeholder="Observacion"><? echo $object -> GetObservacion(); ?></textarea>
			</div>
		</div>
		<div class="row m-t-20" >
			<div class="col-md-4">
				<label>¿Tipología de Inmaterialización?</label>
				<select class="form-control" id="is_inm" name="is_inm">
					<?= ($object->GetInmaterial() == "1")?"<option value='1'>SI</option><option value='0'>NO</option>":"<option value='0'>NO</option><option value='1'>SI</option>" ?>
				</select>
			</div>
			<div class="col-md-4">
				<label>¿Documento de Salida?</label>
				<select class="form-control" id="is_entrada" name="is_entrada">
					<?= ($object->GetInmaterial() == "1")?"<option value='1'>SI</option><option value='0'>NO</option>":"<option value='0'>NO</option><option value='1'>SI</option>" ?>
				</select>
			</div>
			<div class="col-md-4">
				<label>¿Documento Obligatorio?</label>
				<select class="form-control" id="is_obl" name="is_obl">
					<?= ($object->GetObligatorio() == "1")?"<option value='1'>SI</option><option value='0'>NO</option>":"<option value='0'>NO</option><option value='1'>SI</option>" ?>
				</select>
			</div>
		</div>
		<div class="row m-t-20" >
			<div class="col-md-4">
				<label>¿Documento Publico?</label>
				<select class="form-control" id="is_pbl" name="is_pbl">
					<?= ($object->GetEs_publico() == "1")?"<option value='1'>SI</option><option value='0'>NO</option>":"<option value='0'>NO</option><option value='1'>SI</option>" ?>
				</select>				
			</div>
			<div class="col-md-4">
				<label>Días de Vencimiento</label>
					<select class="form-control" placeholder="Días de Vencimiento"  name='dias_vencimiento' id='dias_vencimiento'>
						<option <?= ($object->GetDias_vencimiento() == "0")?"selected":"" ?>  value="0">Documento Persistente</option>
						<option <?= ($object->GetDias_vencimiento() == "15")?"selected":"" ?>  value="15">15 Días</option>
						<option <?= ($object->GetDias_vencimiento() == "30")?"selected":"" ?>  value="30">1 Mes</option>
						<option <?= ($object->GetDias_vencimiento() == "90")?"selected":"" ?>  value="90">3 Meses</option>
						<option <?= ($object->GetDias_vencimiento() == "180")?"selected":"" ?>  value="180">6 Meses</option>
						<option <?= ($object->GetDias_vencimiento() == "270")?"selected":"" ?>  value="270">9 Meses</option>
						<option <?= ($object->GetDias_vencimiento() == "365")?"selected":"" ?>  value="365">1 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "730")?"selected":"" ?>  value="730">2 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "1095")?"selected":"" ?>  value="1095">3 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "1460")?"selected":"" ?>  value="1460">4 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "1825")?"selected":"" ?>  value="1825">5 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "2555")?"selected":"" ?> value="2555">7 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "2990")?"selected":"" ?> value="2990">8 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "3650")?"selected":"" ?> value="3650">10 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "4380")?"selected":"" ?> value="4380">12 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "5475")?"selected":"" ?> value="5475">15 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "7300")?"selected":"" ?> value="7300">20 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "9125")?"selected":"" ?> value="9125">25 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "10950")?"selected":"" ?> value="10950">30 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "12775")?"selected":"" ?> value="12775">35 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "14600")?"selected":"" ?> value="14600">40 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "16425")?"selected":"" ?> value="16425">45 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "18250")?"selected":"" ?> value="18250">50 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "21900")?"selected":"" ?> value="21900">60 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "25550")?"selected":"" ?> value="25550">70 Año(s)</option>
						<option <?= ($object->GetDias_vencimiento() == "29200")?"selected":"" ?> value="29200">80 Año(s)</option>
					</select>
			</div>
			<div class="col-md-4">
				<label>Soporte</label>
				<select  class="form-control" placeholder="SOPORTE/ORIGEN"  name='soporte' id='soporte'>
					<option  <?= ($object->GetSoporte() == "0")?"selected":"" ?> value="0">Papel. </option>
					<option  <?= ($object->GetSoporte() == "1")?"selected":"" ?> value="1">Electrónico.</option>
					<option  <?= ($object->GetSoporte() == "2")?"selected":"" ?> value="2">Papel y Electrónico.</option>
					<option  <?= ($object->GetSoporte() == "3")?"selected":"" ?> value="3">XML</option>
					<option  <?= ($object->GetSoporte() == "4")?"selected":"" ?> value="4">Papel, Electrónico O XML</option>
				</select>
			</div>
		</div>
		<div class="row m-t-20" >
			<div class="col-md-4">
				<input type='button' value='Actualizar Tipo Documental' onClick="UpdateTipologia()" class="btn btn-info"/>
			</div>
		</div>
</form>

<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#updateuploadbtn');
		var status=$('#updatestatus');
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
				status.text(response);
				//Add uploaded file to list
				$("#updateformato").val(response);
				
			}
		});
		
	});
</script>
