
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateplantilla_dependencia' action='<?= HOMEDIR.'plantilla_dependencia'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar plantilla_dependencia</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nombre:</strong></td>
				<td><input type='text' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>F_creacion:</strong></td>
				<td><input type='text' name='f_creacion' id='f_creacion' maxlength='' value='<? echo $object -> Getf_creacion(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>F_actualizacion:</strong></td>
				<td><input type='text' name='f_actualizacion' id='f_actualizacion' maxlength='' value='<? echo $object -> Getf_actualizacion(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Contenido:</strong></td>
				<td><input type='text' name='contenido' id='contenido' maxlength='' value='<? echo $object -> Getcontenido(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Dependencia_id:</strong></td>
				<td><input type='text' name='dependencia_id' id='dependencia_id' maxlength='' value='<? echo $object -> Getdependencia_id(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
