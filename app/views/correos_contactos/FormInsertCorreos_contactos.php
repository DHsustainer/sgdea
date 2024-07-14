<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'correos_contactos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formcorreos_contactos' action='<?= HOMEDIR.DS.'correos_contactos'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='correos_contactos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariocorreos_contactos}</td>
			</tr>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='200' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Mail:</strong></td>
				<td><input type='text' name='mail' id='mail' maxlength='200' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nombre:</strong></td>
				<td><input type='text' name='nombre' id='nombre' maxlength='400' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>