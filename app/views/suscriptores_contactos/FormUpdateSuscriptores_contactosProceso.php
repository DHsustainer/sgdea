<form id='FormUpdatesuscriptores_contactos' action='/suscriptores_contactos/actualizar/' method='POST' method='POST'> 
	<div style='display:none;'>
		<input type='hidden' id='action' name='action' value='actualizar' />    
		<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
		<input type='hidden' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' />
		<input type='hidden' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
		<input type='hidden' name='geturl' id='geturl' value='' />
		<?	if ($_SESSION['MODULES']['acceso_suscriptores'] == "1") { ?>
			<select class="form-control" name='estado' id='estado'  >
				<? echo ($object->Getestado() == "1")?"<option value='1'>Activo</option><option value='0'>Inactivo</option>":"<option value='0'>Inactivo</option><option value='1'>Activo</option>"; ?>
			</select>
		<? }else{ ?>
			<select class="form-control" name='estado' id='estado' style="display:none" >
				<? echo ($object->Getestado() == "1")?"<option value='1'>Activo</option><option value='0'>Inactivo</option>":"<option value='0'>Inactivo</option><option value='1'>Activo</option>"; ?>
			</select>
		<? 	} ?>
			<select class="input1_0 select2_1 form-control"  style=" " name="dependencia" id="dependencia" maxlength='200'>
				<option value="">Suscriptor Principal</option>
				<?
					$lx = new MSuscriptores_contactos;
					$query_eg = $lx->ListarSuscriptores_contactos(); 
					while($row_type = $con->FetchAssoc($query_eg)){
						$s = "";
						if ($object->GetDependencia() == $row_type['id']) {
							$s = "selected = 'selected'";
						}
						echo "<option value='".$row_type['id']."' $s>".$row_type['nombre']."</option>";
					}

				?>
				<option value="OTRO">OTRO</option>
			</select>
			<span class="fa fa-question-circle-o" style="cursor:pointer" data-toggle="popover" data-trigger="hover" title="Suscriptor Principal" data-content="Seleccione un Suscriptor Principal, si el suscriptor que desea registrar está asociado con otro suscriptor"></span>	
	</div>
	


	<div class="row" >
		<div class="col-md-6"><input type='text' class="form-control" name='nombre' id='nombre' placeholder="<?= SUSCRIPTORCAMPONOMBRE; ?>" maxlength='' value='<? echo $object -> Getnombre(); ?>' /></div>
		<div class="col-md-6"><input type='text' class="form-control" name='identificacion' id='identificacion' placeholder="<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>" maxlength='' value='<? echo $object -> Getidentificacion(); ?>' /></div>
	</div>

	<div class="row m-t-10" >
		<div class="col-md-6">
			<select class="input1_0  form-control important"  placeholder="Tipo de Suscriptor"  name='type' id='type'  maxlength='200'>
				<option value="">Tipo de Suscriptor</option>
				<?
					$lx = new MSuscriptores_tipos;
					$query_eg = $lx->ListarSuscriptores_tipos(); 
					while($row_type = $con->FetchAssoc($query_eg)){
						$s = "";

						if ($object -> Gettype() == $row_type['id']) {
							$s = "selected = 'selected'";
						}
						echo "<option value='".$row_type['id']."' $s>".$row_type['nombre']."</option>";
					}

				?>
				<option value="OTRO">OTRO</option>
			</select>
		</div>
		<div class="col-md-6"><input type='submit' class="btn btn-info" value='Actualizar Información General'/></div>
	</div>
	<!--<div class="row m-t-10" >
		<div class="col-md-6">
			<div class="row" >
				<div class="col-md-6">
					<b>Cod. Ingreso:</b><br><?= $object->GetCod_ingreso() ?>
				</div>
				<div class="col-md-6">
					<b>Clave:</b><br><?= $object->GetDec_pass() ?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<input type='button' class="btn btn-info" value='Enviar Claves de Acceso' onclick="SendDataCliente('<?= $object->GetId() ?>', '0')" />
		</div>
	</div> -->
</form>
<div class="row" >
	<div class="col-md-12">
	<?
			include(VIEWS.DS."suscriptores_contactos_direccion/ListarProceso.php");
	?>
	</div>
</div>

 <style>

    .impr_box_del_menu ul, .impr_box_main_menu ul {
        background: #1579C4;
        margin-top: 7px;
    }
    
    .boton{
    	width: 100%;
    	background: #1579C4;
    	color: #FFF;
    	height: 35px;
    	line-height: 35px;
    	padding: 0px;
    	text-align: center;
    	border-radius: 4px;
    	margin-bottom: 10px;

    }
</style>
<script type="text/javascript">
	$("#geturl").val($("#geturi").val());

(function($) {
	if ($('.select2_1').length) $(".select2_1").select2();
})(jQuery);
</script>