<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'mailer_logins'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formmailer_logins' action='<?= HOMEDIR.DS.'mailer_logins'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='mailer_logins' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariomailer_logins}</td>
			</tr>
			<tr>
				<td width='30%'><strong>Nick:</strong></td>
				<td><input type='text' name='nick' id='nick' maxlength='99' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Ip:</strong></td>
				<td><input type='text' name='ip' id='ip' maxlength='12' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Date:</strong></td>
				<td><input type='text' name='date' id='date' maxlength='15' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>