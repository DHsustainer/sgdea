<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'contactos_emails'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formcontactos_emails' action='<?= HOMEDIR.DS.'contactos_emails'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='contactos_emails' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariocontactos_emails}</td>
			</tr>
			<tr>
				<td width='30%'><strong>Contacto_id:</strong></td>
				<td><input type='text' name='contacto_id' id='contacto_id' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Email:</strong></td>
				<td><input type='text' name='email' id='email' maxlength='200' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>