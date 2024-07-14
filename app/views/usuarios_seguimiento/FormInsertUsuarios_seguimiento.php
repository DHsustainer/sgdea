<?
	$u = new Musuarios;
	$u->CreateUSuarios("user_id", $userid);
?>
<div class="row">
	<div class="col-md-5">
		<form id='formusuarios_seguimiento' action='/usuarios_seguimiento/registrar/' method='POST'> 
			<h4 style="margin-left:10px; margin-bottom: 30px;">Ingrese el seguimiento</h4>
			<textarea class='form-control' style="height: 100px" placeholder='Observacion' name='observacion' id='observacion' ></textarea>
			<input type='hidden' class='form-control' name='usuario_seguimiento' id='usuario_seguimiento' value="<?= $userid ?>" />
			<input type='hidden' class='form-control' name='username' id='username' value='<?= $_SESSION['usuario'] ?>' />
			<input type='hidden' class='form-control' name='fecha' id='fecha' maxlength='' />
			<input type='hidden' class='form-control' name='tipo_seguimiento' id='tipo_seguimiento' value='1' />
			<input type='button' class="btn btn-lg btn-primary" style="margin-top:20px" value='Guardar Seguimiento' onclick="GuardarSeguimento();" />
		</form>
	</div>
	<div class="col-md-7">
		<h4 style="margin-bottom: 30px;">Seguimiento Del usuario</h4>
	<?
		$object = new MUsuarios_seguimiento;
		$query = $object->ListarUsuarios_seguimiento('WHERE usuario_seguimiento = "'.$userid.'"');	    

		if($con->NumRows($query) <= 0 || $query !=''){
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
			include_once(VIEWS.DS.'usuarios_seguimiento/Listar.php');	   			
		}else{
			echo "<div class='alert alert-info'>No se han creado seguimientos al usuario</div>";
		}
	?>
	</div>
</div>