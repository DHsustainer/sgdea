<form id='FormUpdategestion_suscriptores<?= $object -> GetId() ?>' action='/gestion_suscriptores/actualizar/' method='POST'> 
	<input type='hidden' name='id' id='id' value='<?= $object -> GetId() ?>' />
<!--
-->
<?
	global $con;
	global $f;
	global $c;
	$sus = new MSuscriptores_contactos;
	$sus->CreateSuscriptores_contactos("id", $object -> GetId_suscriptor());

	$u = new MUsuarios;
	$u->CreateUsuarios("user_id", $object -> GetUsuario_id());

	$date = $con->Result($con->Query("Select fecha from logins where username = '".$object->GetId_suscriptor()."'"), 0, "fecha");

	if ($date != "") {
		$date = $f->ObtenerFecha4($date);
	}else{
		$date = "El suscriptor aún no ha iniciado sesión";
	}
?>
	<h4 style="text-transform: uppercase"><b>Estado del Suscriptor</b></h4>
	<div class="row">
		<div class="col-md-6">
			<label for="estado">Estado de Cuenta:</label>
			<select style="margin-bottom: 5px" class="form-control" name='estado' id='estado'><?= ($object -> GetEstado() == "1")?"<option value='1'>Activa</option><option value='0'>Inactiva</option>":"<option value='0'>Inactiva</option><option value='1'>Activa</option>"; ?></select>
		</div>
		<div class="col-md-6">
			<label for="type">Tipo de Cuenta:</label>
			<select name='type'  class="form-control"id='type'><?= ($object->GetType() == "1")?"<option value='1'>El suscriptor puede interactuar</option><option value='0'>El suscriptor solo puede consultar</option>":"<option value='0'>El suscriptor solo puede consultar</option><option value='1'>El suscriptor puede interactuar</option>"; ?></select>
		</div>
	</div>
</form>
	<h4 style="text-transform: uppercase"><b>Información del Suscriptor</b></h4>
<?
	$object = new MSuscriptores_contactos;
	$object->CreateSuscriptores_contactos("id", $sus->GetId());
	include(VIEWS.DS.'suscriptores_contactos/FormUpdateSuscriptores_contactosProceso.php');
?>