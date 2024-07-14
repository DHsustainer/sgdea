<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'anexos_carpeta'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formanexos_carpeta' action='<?= HOMEDIR.DS.'anexos_carpeta'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='anexos_carpeta' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioanexos_carpeta}</td>
			</tr>
			<tr>
				<td width='30%'><strong>Folder_id:</strong></td>
				<td><input type='text' name='folder_id' id='folder_id' maxlength='9' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nombre:</strong></td>
				<td><input type='text' name='nombre' id='nombre' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Url:</strong></td>
				<td><input type='text' name='url' id='url' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Fecha:</strong></td>
				<td><input type='text' name='fecha' id='fecha' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Hora:</strong></td>
				<td><input type='text' name='hora' id='hora' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Ip:</strong></td>
				<td><input type='text' name='ip' id='ip' maxlength='15' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Timest:</strong></td>
				<td><input type='text' name='timest' id='timest' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Estado:</strong></td>
				<td><input type='text' name='estado' id='estado' maxlength='1' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Folio:</strong></td>
				<td><input type='text' name='folio' id='folio' maxlength='10' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>