<?
	$form=($id_dependencia == 0 )?"formdependencias":"formsubdependencias";

	if ($form == "formdependencias") {

		global $c;
		$total_activos = $c->GetTotalFromTable("dependencias", "WHERE dependencia = '0' and id_version = '".$_SESSION['id_trd']."'");
		$cupos_totales = 0;
		if ($_SESSION['MODULES']['total_series'] == "0") {
			$cupos_totales = 9999; 	
		}else{
			$cupos_totales = $_SESSION['MODULES']['total_series'];
		}
?>	
		<div class="bloq_utilizadas">Series Registradas: <?= $total_activos; ?></div>
		<div class="bloq_totales">Series Totales: <?= $cupos_totales; ?></div>
		<div class="clear"></div>
		<br>
	
<?
		if ($cupos_totales > $total_activos) {
?>
			<form id='<?= $form ?>' action='/dependencias/registrar/' method='POST'> 
				<input type='text' class="form-control important" name='nombre' id='nombre' maxlength='60' placeholder ="Nombre" style="width:300px"/>

				<input type='text' class="form-control" name='id_c' id='id_c' maxlength=''  placeholder ="Código" value="" style="width:60px;" />


				<select placeholder="A. Gestión" class="form-control" name='t_g' id='t_g' style="width:110px">
					<option value="0">A. Gestión</option>		<option value="15">15 Días</option>			<option value="30">1 Mes</option>
					<option value="90">3 Meses</option>			<option value="180">6 Meses</option>		<option value="270">9 Meses</option>
					<option value="365">1 Año(s)</option>		<option value="730">2 Año(s)</option>		<option value="1095">3 Año(s)</option>
					<option value="1460">4 Año(s)</option>		<option value="1825">5 Año(s)</option>		<option value="2190">6 Año(s)</option>
					<option value="2555">7 Año(s)</option>		<option value="2990">8 Año(s)</option>		<option value="3650">10 Año(s)</option>
					<option value="4380">12 Año(s)</option>		<option value="5475">15 Año(s)</option>		<option value="7300">20 Año(s)</option>
					<option value="9125">25 Año(s)</option>		<option value="10950">30 Año(s)</option>	<option value="12775">35 Año(s)</option>
					<option value="14600">40 Año(s)</option>	<option value="16425">45 Año(s)</option>	<option value="18250">50 Año(s)</option>
					<option value="21900">60 Año(s)</option>	<option value="25550">70 Año(s)</option>	<option value="29200">80 Año(s)</option>
				</select>

				<select placeholder="A. Central" class="form-control" name='t_c' id='t_c' style="width:110px">
					<option value="0">A. Central</option>		<option value="15">15 Días</option>			<option value="30">1 Mes</option>
					<option value="90">3 Meses</option>			<option value="180">6 Meses</option>		<option value="270">9 Meses</option>
					<option value="365">1 Año(s)</option>		<option value="730">2 Año(s)</option>		<option value="1095">3 Año(s)</option>
					<option value="1460">4 Año(s)</option>		<option value="1825">5 Año(s)</option>		<option value="2190">6 Año(s)</option>
					<option value="2555">7 Año(s)</option>		<option value="2990">8 Año(s)</option>		<option value="3650">10 Año(s)</option>
					<option value="4380">12 Año(s)</option>		<option value="5475">15 Año(s)</option>		<option value="7300">20 Año(s)</option>
					<option value="9125">25 Año(s)</option>		<option value="10950">30 Año(s)</option>	<option value="12775">35 Año(s)</option>
					<option value="14600">40 Año(s)</option>	<option value="16425">45 Año(s)</option>	<option value="18250">50 Año(s)</option>
					<option value="21900">60 Año(s)</option>	<option value="25550">70 Año(s)</option>	<option value="29200">80 Año(s)</option>
				</select>

				<select placeholder="A. Histórico" class="form-control" name='t_h' id='t_h' style="width:110px">
					<option value="0">A. Histórico</option> 	<option value="-2">Conservación Total</option>
					<option value="-1">Eliminación</option>		<option value="-3">Digitalización</option>
					<option value="-4">Selección</option>		<option value="-5">MicroFilmación</option>
					<option value="-6">Hibrido</option>

				</select>

				<textarea id="observacion" name="observacion" class="form-control" placeholder="Procedimiento" style="resize:none; height: 70px; width:450px; <?= ($id_dependencia == 0 )?"display:none":"" ?>"></textarea>

				<input type='hidden' class="form-control" name='dependencia' id='dependencia' maxlength='10'  placeholder ="Dependencia / Padre" value="<?= $id_dependencia; ?>" />
				<input type='hidden' class="form-control" name='usuario' id='usuario' maxlength='50'  placeholder ="Nombre" value="<?= $_SESSION['usuario'] ?>" />
				<input type='hidden' class="form-control" name='fecha' id='fecha' maxlength=''  placeholder ="Nombre" value="<?= date("Y-m-d") ?>" />
				<input type='hidden' class="form-control" name='estado' id='estado' maxlength='10'  placeholder ="Nombre" value="1" />

				<?
					$type=($id_dependencia == 0 )?"Crear Serie":"Crear Sub Serie";
				?>
				<input type='button' style="margin:10px;" value='<?= $type ?>' onClick="InsertDependencia('<?= $form ?>')"/>

			</form>
<?
		}else{
			echo '<div class="alert alert-info">No tienes cupos disponibles</div><br>';
		}
?>
<?
	}else{
?>
<?
		global $c;
		$total_activos = $c->GetTotalFromTable("dependencias", "WHERE dependencia != '0' and id_version = '".$_SESSION['id_trd']."'");
		$cupos_totales = 0;
		if ($_SESSION['MODULES']['total_subseries'] == "0") {
			$cupos_totales = 9999; 	
		}else{
			$cupos_totales = $_SESSION['MODULES']['total_subseries'];
		}
?>	
		<div class="bloq_utilizadas">Total de Sub-Series Registradas: <?= $total_activos; ?></div>
		<div class="bloq_totales">Sub-Series Totales: <?= $cupos_totales; ?></div>
		<div class="clear"></div>
		<br>
	
<?
		if ($cupos_totales > $total_activos) {
?>
		<form id='<?= $form ?>' action='/dependencias/registrar/' method='POST'> 
			<input type='text' class="form-control important" name='nombre' id='nombre' maxlength='60' placeholder ="Nombre" style="width:340px"/>

			<input type='text' class="form-control" name='id_c' id='id_c' maxlength=''  placeholder ="Código" value="" style="width:60px;" />


			<select placeholder="A. Gestión" class="form-control" name='t_g' id='t_g' style="width:135px">
				<option value="0">A. Gestión</option>		<option value="15">15 Días</option>			<option value="30">1 Mes</option>
				<option value="90">3 Meses</option>			<option value="180">6 Meses</option>		<option value="270">9 Meses</option>
				<option value="365">1 Año(s)</option>		<option value="730">2 Año(s)</option>		<option value="1095">3 Año(s)</option>
				<option value="1460">4 Año(s)</option>		<option value="1825">5 Año(s)</option>		<option value="2190">6 Año(s)</option>
				<option value="2555">7 Año(s)</option>		<option value="2990">8 Año(s)</option>		<option value="3650">10 Año(s)</option>
				<option value="4380">12 Año(s)</option>		<option value="5475">15 Año(s)</option>		<option value="7300">20 Año(s)</option>
				<option value="9125">25 Año(s)</option>		<option value="10950">30 Año(s)</option>	<option value="12775">35 Año(s)</option>
				<option value="14600">40 Año(s)</option>	<option value="16425">45 Año(s)</option>	<option value="18250">50 Año(s)</option>
				<option value="21900">60 Año(s)</option>	<option value="25550">70 Año(s)</option>	<option value="29200">80 Año(s)</option>
			</select>

			<select placeholder="A. Central" class="form-control" name='t_c' id='t_c' style="width:135px">
				<option value="0">A. Central</option>		<option value="15">15 Días</option>			<option value="30">1 Mes</option>
				<option value="90">3 Meses</option>			<option value="180">6 Meses</option>		<option value="270">9 Meses</option>
				<option value="365">1 Año(s)</option>		<option value="730">2 Año(s)</option>		<option value="1095">3 Año(s)</option>
				<option value="1460">4 Año(s)</option>		<option value="1825">5 Año(s)</option>		<option value="2190">6 Año(s)</option>
				<option value="2555">7 Año(s)</option>		<option value="2990">8 Año(s)</option>		<option value="3650">10 Año(s)</option>
				<option value="4380">12 Año(s)</option>		<option value="5475">15 Año(s)</option>		<option value="7300">20 Año(s)</option>
				<option value="9125">25 Año(s)</option>		<option value="10950">30 Año(s)</option>	<option value="12775">35 Año(s)</option>
				<option value="14600">40 Año(s)</option>	<option value="16425">45 Año(s)</option>	<option value="18250">50 Año(s)</option>
				<option value="21900">60 Año(s)</option>	<option value="25550">70 Año(s)</option>	<option value="29200">80 Año(s)</option>
			</select>

			<select placeholder="A. Histórico" class="form-control" name='t_h' id='t_h' style="width:135px">
				<option value="0">A. Histórico</option> 	<option value="-2">Conservación Total</option>
				<option value="-1">Eliminación</option>		<option value="-3">Digitalización</option>
				<option value="-4">Selección</option>		<option value="-5">MicroFilmación</option>
				<option value="-6">Hibrido</option>
			</select>
			<textarea id="observacion" name="observacion" class="form-control" placeholder="Procedimiento" style="resize:none; height: 70px; width:450px; <?= ($id_dependencia == 0 )?"display:none":"" ?>"></textarea>
			<br>
			<input type="checkbox" id="is_inm" name="is_inm">
			<label for="is_inm">¿Soporte 100% Electrónico?</label><br>

			<input type='hidden' class="form-control" name='dependencia' id='dependencia' maxlength='10'  placeholder ="Dependencia / Padre" value="<?= $id_dependencia; ?>" />
			<input type='hidden' class="form-control" name='usuario' id='usuario' maxlength='50'  placeholder ="Nombre" value="<?= $_SESSION['usuario'] ?>" />
			<input type='hidden' class="form-control" name='fecha' id='fecha' maxlength=''  placeholder ="Nombre" value="<?= date("Y-m-d") ?>" />
			<input type='hidden' class="form-control" name='estado' id='estado' maxlength='10'  placeholder ="Nombre" value="1" />

			<?
				$type=($id_dependencia == 0 )?"Crear Serie":"Crear Sub Serie";
			?>
			<input type='button' style="margin:10px;" value='<?= $type ?>' onClick="InsertDependencia('<?= $form ?>')"/>

		</form>
		<?
		}else{
			echo '<div class="alert alert-info">No tienes cupos disponibles</div><br>';
		}
?>
<?			
	}
?>