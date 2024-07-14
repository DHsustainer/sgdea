
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatedependencias_permisos_documento' action='/dependencias_permisos_documento/actualizar/' method='POST'> 
		<div class='title'>Editar dependencias_permisos_documento</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar dependencias_permisos_documento</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_documento' name='id_documento' id='id_documento' maxlength='' value='<? echo $object -> Getid_documento(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='' value='<? echo $object -> Getid_dependencia(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario_permiso' name='usuario_permiso' id='usuario_permiso' maxlength='' value='<? echo $object -> Getusuario_permiso(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
