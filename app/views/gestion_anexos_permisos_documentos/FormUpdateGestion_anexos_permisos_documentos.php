
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdategestion_anexos_permisos_documentos' action='/gestion_anexos_permisos_documentos/actualizar/' method='POST'> 
		<div class='title'>Editar gestion_anexos_permisos_documentos</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar gestion_anexos_permisos_documentos</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_documento' name='id_documento' id='id_documento' maxlength='' value='<? echo $object -> Getid_documento(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario_permiso' name='usuario_permiso' id='usuario_permiso' maxlength='' value='<? echo $object -> Getusuario_permiso(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_solicitud' name='fecha_solicitud' id='fecha_solicitud' maxlength='' value='<? echo $object -> Getfecha_solicitud(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_actualizacion' name='fecha_actualizacion' id='fecha_actualizacion' maxlength='' value='<? echo $object -> Getfecha_actualizacion(); ?>' />
			
			<input type='text' class='form-control' placeholder='observacion' name='observacion' id='observacion' maxlength='' value='<? echo $object -> Getobservacion(); ?>' />
			
			<input type='text' class='form-control' placeholder='gestion_id' name='gestion_id' id='gestion_id' maxlength='' value='<? echo $object -> Getgestion_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_folder' name='id_folder' id='id_folder' maxlength='' value='<? echo $object -> Getid_folder(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
