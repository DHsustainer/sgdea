<h4>Editar Subserie Documental</h4>

<form id='FormUpdatedependencias' method='POST'> 
		<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
		<input type='hidden' name='dependencia' id='dependencia' value='<? echo $object -> Getdependencia(); ?>' />

	<div class="row m-t-30">
		<div class="col-md-8">
			<input type='text' class='form-control' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
		</div>
		<div class="col-md-4">
			<input type='text' class="form-control" name='id_c' id='id_c' placeholder ="Código" value="<?= $f->zerofill($object->GetId_c(), 3) ?>"/>
		</div>
	</div>
	<div class="row m-t-30">
		<div class="col-md-4">
			<select placeholder="A. Gestión" class="form-control" name='t_g' id='t_g'>
				<option <?= ($object->Gett_g() == "0")?"selected":"" ?>  value="0">A. Gestión</option>
				<option <?= ($object->Gett_g() == "15")?"selected":"" ?>  value="15">15 Días</option>
				<option <?= ($object->Gett_g() == "30")?"selected":"" ?>  value="30">1 Mes</option>
				<option <?= ($object->Gett_g() == "90")?"selected":"" ?>  value="90">3 Meses</option>
				<option <?= ($object->Gett_g() == "180")?"selected":"" ?>  value="180">6 Meses</option>
				<option <?= ($object->Gett_g() == "270")?"selected":"" ?>  value="270">9 Meses</option>
				<option <?= ($object->Gett_g() == "365")?"selected":"" ?>  value="365">1 Año(s)</option>
				<option <?= ($object->Gett_g() == "730")?"selected":"" ?>  value="730">2 Año(s)</option>
				<option <?= ($object->Gett_g() == "1095")?"selected":"" ?>  value="1095">3 Año(s)</option>
				<option <?= ($object->Gett_g() == "1460")?"selected":"" ?>  value="1460">4 Año(s)</option>
				<option <?= ($object->Gett_g() == "1825")?"selected":"" ?>  value="1825">5 Año(s)</option>
				<option  <?= ($object->Gett_g() == "2555")?"selected":"" ?> value="2555">7 Año(s)</option>
				<option  <?= ($object->Gett_g() == "2990")?"selected":"" ?> value="2990">8 Año(s)</option>
				<option  <?= ($object->Gett_g() == "3650")?"selected":"" ?> value="3650">10 Año(s)</option>
				<option  <?= ($object->Gett_g() == "4380")?"selected":"" ?> value="4380">12 Año(s)</option>
				<option  <?= ($object->Gett_g() == "5475")?"selected":"" ?> value="5475">15 Año(s)</option>
				<option  <?= ($object->Gett_g() == "7300")?"selected":"" ?> value="7300">20 Año(s)</option>
				<option  <?= ($object->Gett_g() == "9125")?"selected":"" ?> value="9125">25 Año(s)</option>
				<option  <?= ($object->Gett_g() == "10950")?"selected":"" ?> value="10950">30 Año(s)</option>
				<option  <?= ($object->Gett_g() == "12775")?"selected":"" ?> value="12775">35 Año(s)</option>
				<option  <?= ($object->Gett_g() == "14600")?"selected":"" ?> value="14600">40 Año(s)</option>
				<option  <?= ($object->Gett_g() == "16425")?"selected":"" ?> value="16425">45 Año(s)</option>
				<option  <?= ($object->Gett_g() == "18250")?"selected":"" ?> value="18250">50 Año(s)</option>
				<option  <?= ($object->Gett_g() == "21900")?"selected":"" ?> value="21900">60 Año(s)</option>
				<option  <?= ($object->Gett_g() == "25550")?"selected":"" ?> value="25550">70 Año(s)</option>
				<option  <?= ($object->Gett_g() == "29200")?"selected":"" ?> value="29200">80 Año(s)</option>
			</select>
		</div>
		<div class="col-md-4">
			<select placeholder="A. Central" class="form-control" name='t_c' id='t_c'>
				<option <?= ($object->Gett_c() == "0")?"selected":"" ?>  value="0">A. Central</option>
				<option <?= ($object->Gett_c() == "15")?"selected":"" ?>  value="15">15 Días</option>
				<option <?= ($object->Gett_c() == "30")?"selected":"" ?>  value="30">1 Mes</option>
				<option <?= ($object->Gett_c() == "90")?"selected":"" ?>  value="90">3 Meses</option>
				<option <?= ($object->Gett_c() == "180")?"selected":"" ?>  value="180">6 Meses</option>
				<option <?= ($object->Gett_c() == "270")?"selected":"" ?>  value="270">9 Meses</option>
				<option <?= ($object->Gett_c() == "365")?"selected":"" ?>  value="365">1 Año(s)</option>
				<option <?= ($object->Gett_c() == "730")?"selected":"" ?>  value="730">2 Año(s)</option>
				<option <?= ($object->Gett_c() == "1095")?"selected":"" ?>  value="1095">3 Año(s)</option>
				<option <?= ($object->Gett_c() == "1460")?"selected":"" ?>  value="1460">4 Año(s)</option>
				<option <?= ($object->Gett_c() == "1825")?"selected":"" ?>  value="1825">5 Año(s)</option>
				<option  <?= ($object->Gett_c() == "2555")?"selected":"" ?> value="2555">7 Año(s)</option>
				<option  <?= ($object->Gett_c() == "2990")?"selected":"" ?> value="2990">8 Año(s)</option>
				<option  <?= ($object->Gett_c() == "3650")?"selected":"" ?> value="3650">10 Año(s)</option>
				<option  <?= ($object->Gett_c() == "4380")?"selected":"" ?> value="4380">12 Año(s)</option>
				<option  <?= ($object->Gett_c() == "5475")?"selected":"" ?> value="5475">15 Año(s)</option>
				<option  <?= ($object->Gett_c() == "7300")?"selected":"" ?> value="7300">20 Año(s)</option>
				<option  <?= ($object->Gett_c() == "9125")?"selected":"" ?> value="9125">25 Año(s)</option>
				<option  <?= ($object->Gett_c() == "10950")?"selected":"" ?> value="10950">30 Año(s)</option>
				<option  <?= ($object->Gett_c() == "12775")?"selected":"" ?> value="12775">35 Año(s)</option>
				<option  <?= ($object->Gett_c() == "14600")?"selected":"" ?> value="14600">40 Año(s)</option>
				<option  <?= ($object->Gett_c() == "16425")?"selected":"" ?> value="16425">45 Año(s)</option>
				<option  <?= ($object->Gett_c() == "18250")?"selected":"" ?> value="18250">50 Año(s)</option>
				<option  <?= ($object->Gett_c() == "21900")?"selected":"" ?> value="21900">60 Año(s)</option>
				<option  <?= ($object->Gett_c() == "25550")?"selected":"" ?> value="25550">70 Año(s)</option>
				<option  <?= ($object->Gett_c() == "29200")?"selected":"" ?> value="29200">80 Año(s)</option>
			</select>
		</div>
		<div class="col-md-4">
			<select placeholder="A. Histórico" class="form-control" name='t_h' id='t_h'>
				<option <?= ($object->Gett_h() == "0")?"selected":"" ?> value="0">Unidad de Conservacion</option>
				<option <?= ($object->Gett_h() == "-2")?"selected":"" ?> value="-2">Conservación Total</option>
				<option <?= ($object->Gett_h() == "-1")?"selected":"" ?> value="-1">Eliminación</option>
				<option <?= ($object->Gett_h() == "-3")?"selected":"" ?> value="-3">Digitalización</option>
				<option <?= ($object->Gett_h() == "-4")?"selected":"" ?> value="-4">Selección</option>
				<option <?= ($object->Gett_h() == "-5")?"selected":"" ?> value="-5">MicroFilmación</option>
				<option <?= ($object->Gett_h() == "-6")?"selected":"" ?> value="-6">Hibrido</option>
				<option <?= ($object->Gett_h() == "-7")?"selected":"" ?> value="-7">Digitalizar y Eliminar</option>
			</select>		
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-12">
			<textarea id="observacion" name="observacion" class="form-control height-100" placeholder="Procedimiento" style="<?= ($object->Getdependencia() == 0 )?"":"" ?>"><? echo $object -> Getobservacion(); ?></textarea>
		</div>
	</div>	
	<div class="row m-t-10">
		<div class="col-md-4">
			<input type='text' class="form-control" name='dias_vencimiento' id='dias_vencimiento' maxlength=''  placeholder ="Días Vencimiento" title="Escriba el numero de días para activar alerta de vencimiento" value="<?= $object->GetDias_vencimiento() ?>"/>
		</div>
		<div class="col-md-4">
			<select placeholder="¿Subserie de Inmaterialización?" title="¿Subserie de Inmaterialización?" class="form-control" name='is_inmx' id='is_inmx'>
				<option value="<?= $object->GetEs_inmaterial() ?>">¿Soporte 100% Electrónico?</option>
				<option <?= ($object->GetEs_inmaterial() == "1")?"selected":"" ?> value="1">SI</option>
				<option <?= ($object->GetEs_inmaterial() == "0")?"selected":"" ?> value="0">NO</option>
			</select>		
		</div>
		<div class="col-md-4">
			<select placeholder="¿Ventanilla de Recepción?" title="¿Ventanilla de Recepción?" class="form-control" name='es_publicox' id='es_publicox'>
				<option value="<?= $object->GetEs_publico() ?>">¿Ventanilla de Recepción?</option>
				<option <?= ($object->GetEs_publico() == "1")?"selected":"" ?> value="1">SI</option>
				<option <?= ($object->GetEs_publico() == "0")?"selected":"" ?> value="0">NO</option>
			</select>		
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-12">
			<input type='text' class="form-control" name='titulo_publicox' id='titulo_publicox' placeholder ="Título de Consulta Publica"/>
		</div>
	</div>	
	<div class="row m-t-10">
		<div class="col-md-6">
			<input type='button' class="btn btn-info" value='Actualizar' onClick="BtnActualizar()"/>
		</div>
		<div class="col-md-6">
			<input type='button' class="btn btn-default" value='Cancelar' onClick="BtnCancelarActualizar()"/>
		</div>
	</div>
</form>
