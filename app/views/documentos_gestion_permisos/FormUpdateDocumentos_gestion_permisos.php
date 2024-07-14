
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatedocumentos_gestion_permisos' action='/documentos_gestion_permisos/actualizar/' method='POST'> 
		<div class='title'>Editar documentos_gestion_permisos</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar documentos_gestion_permisos</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_documento' name='id_documento' id='id_documento' maxlength='' value='<? echo $object -> Getid_documento(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario_permiso' name='usuario_permiso' id='usuario_permiso' maxlength='' value='<? echo $object -> Getusuario_permiso(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_solicitud' name='fecha_solicitud' id='fecha_solicitud' maxlength='' value='<? echo $object -> Getfecha_solicitud(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_actualizacion' name='fecha_actualizacion' id='fecha_actualizacion' maxlength='' value='<? echo $object -> Getfecha_actualizacion(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
