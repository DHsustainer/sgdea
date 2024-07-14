<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'memoriales'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formmemoriales' action='<?= HOMEDIR.DS.'memoriales'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='memoriales' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariomemoriales}</td>
			</tr>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Proceso_id:</strong></td>
				<td><input type='text' name='proceso_id' id='proceso_id' maxlength='9' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nombre:</strong></td>
				<td><input type='text' name='nombre' id='nombre' maxlength='200' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>F_creacion:</strong></td>
				<td><input type='text' name='f_creacion' id='f_creacion' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>F_actualizacion:</strong></td>
				<td><input type='text' name='f_actualizacion' id='f_actualizacion' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Contenido:</strong></td>
				<td><input type='text' name='contenido' id='contenido' maxlength='' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>