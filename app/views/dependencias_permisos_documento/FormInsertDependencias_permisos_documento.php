<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'dependencias_permisos_documento'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formdependencias_permisos_documento' action='/dependencias_permisos_documento/registrar/' method='POST'> 
		<div class='title right'>Agregar Permiso de Documento</div>
		<br>
		<input type='hidden' class='form-control' value="<?= $doc ?>" placeholder='Id_documento' name='id_documento' id='id_documento' maxlength='10' />
		<input type='hidden' class='form-control' value="<?= $dep ?>" placeholder='Id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='10' />
		<input type='hidden' class='form-control' value="<?= date("Y-m-d") ?>" placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<select class='form-control' placeholder='Usuario_permiso' name='usuario_permiso' id='usuario_permiso' >
			<option value="">Seleccione un Usuario</option>
			<option value="areaboss">Jefe de <?= CAMPOAREADETRABAJO; ?></option>
		<?
			$usuarios = new MUsuarios;
			$list = $usuarios->ListarUsuarios();

			while ($row = $con->FetchAssoc($list)) {
				$us = new MUsuarios;
				$us->CreateUsuarios("user_id", $row['user_id']);

				echo "<option value='".$us->GetUser_id()."'>".ucwords(strtolower($us->GetP_nombre()." ".$us->GetP_apellido()))." (".$us->GetAlt_text().")</option>";
			}
		?>			
		</select>
		<input type='button' value='Insertar'  style='margin:10px;' onClick="InsertDependenciaPermisoDocumento()"/>
	</form>