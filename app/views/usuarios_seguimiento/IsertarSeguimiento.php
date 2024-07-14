<?
	$u = new Musuarios;
	$u->CreateUSuarios("user_id", $userid);
?>

<form id='formusuarios_seguimiento' action='/usuarios_seguimiento/registrarvencimiento/' method='POST'> 
	<input type='hidden' class='form-control' name='usuario_seguimiento' id='usuario_seguimiento' value="<?= $userid ?>" />
	<input type='hidden' class='form-control' name='username' id='username' value='<?= $_SESSION['usuario'] ?>' />
	<input type='hidden' class='form-control' name='fecha' id='fecha' maxlength='' />
	<input type='hidden' class='form-control' name='tipo_seguimiento' id='tipo_seguimiento' value='1' />

	<h4 style="margin-left:10px; margin-bottom: 30px;">Ingrese el seguimiento</h4>
	<div class="form-group">
		<label>Ingrese La Fecha de Vencimiento</label>
		<input type='date' class='form-control' name='fecha_vencimiento' id='fecha_vencimiento' maxlength='' style="height: 35px" />
	</div>
	<div class="form-group">
		<label>Valor del Pago</label>
		<input type='text' class='form-control' name='v_recarga' id='v_recarga' maxlength='' />
	</div>
	<div class="form-group">
		<textarea class='form-control' style="height: 100px" placeholder='Observacion' name='observacion' id='observacion' ></textarea>
	</div>
	<div class="form-group">
		<input type='button' class="btn btn-lg btn-primary" style="margin-top:20px" value='Guardar Seguimiento' onclick="GuardarSeguimento();" />
	</div>
</form>
