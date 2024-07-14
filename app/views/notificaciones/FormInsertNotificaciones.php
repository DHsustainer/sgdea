<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'notificaciones'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formnotificaciones' action='<?= HOMEDIR.DS.'notificaciones'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='notificaciones' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularionotificaciones}</td>
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
				<td width='30%'><strong>Id_demandado:</strong></td>
				<td><input type='text' name='id_demandado' id='id_demandado' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Tipo_notificacion:</strong></td>
				<td><input type='text' name='tipo_notificacion' id='tipo_notificacion' maxlength='20' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Id_postal:</strong></td>
				<td><input type='text' name='id_postal' id='id_postal' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>F_citacion:</strong></td>
				<td><input type='text' name='f_citacion' id='f_citacion' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Todos:</strong></td>
				<td><input type='text' name='todos' id='todos' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nom_archivo:</strong></td>
				<td><input type='text' name='nom_archivo' id='nom_archivo' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Direccion:</strong></td>
				<td><input type='text' name='direccion' id='direccion' maxlength='200' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Num_dias:</strong></td>
				<td><input type='text' name='num_dias' id='num_dias' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Is_certificada:</strong></td>
				<td><input type='text' name='is_certificada' id='is_certificada' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Guia_id:</strong></td>
				<td><input type='text' name='guia_id' id='guia_id' maxlength='20' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>